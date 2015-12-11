/**
 * 图片预览编辑类
 * @author Jitlee
 * @param {Object} containerId
 *
 * 接口方法：
 * edit: 编辑图片
 * clip: 保存图片
 * 
 */
function ImageEditor(containerId, aspectRatio) {
	var self = this;
	var container = document.getElementById("imageContainer");
	var viewport = document.createElement("div");
	var canvas = document.createElement("canvas");
	var context = canvas.getContext("2d");
	var mask = document.createElement("canvas");
	var maskContext = mask.getContext("2d");
	var image = null;
	var PREVIEW_SCALE = 0.9;
	var containerWidth = 0, containerHeight = 0;
	var imageWidth = 0, imageHeight = 0;
	var previewLeft = 0, previewTop = 0;
	var previewWidth = 0, previewHeight = 0;
	var adaptImageWidth = 0, adaptImageHeight = 0;
	var imageLeft = 0, imageTop = 0;
	var widthRatio = 1;
	var heightRatio = 1;
	var imageScale = 1;
	var touchData = { x1: 0, y1: 0, x2: 0, y2: 0 };
	var MAX_SCALE = 10;
	var imageLoaded = false;
	var browserEvents = null;
	var rect;
	
	init();

	function init() {
		var aspectRatioRegex = /^(\d+):(\d+)$/g;
		var matches = aspectRatioRegex.exec(aspectRatio);
		if(matches) {
			widthRatio = Number(matches[1]);
			heightRatio = Number(matches[2]);
		}
		
		container.style.padding = 0;
		
		viewport.style.position = "relative";
		viewport.style.margin = 0;
		viewport.style.overflow = "hidden";
		container.appendChild(viewport);

		canvas.style.position = "absolute";
		viewport.appendChild(canvas);

		mask.style.position = "absolute";
		mask.style.width = "100%";
		mask.style.height = "100%";
		mask.style.top = 0;
		mask.style.left = 0;
		viewport.appendChild(mask);
		
		image = document.createElement("img");
		image.style.position = "absolute";
		image.style.visibility = "hidden";
		image.onload = onimageload;
		viewport.appendChild(image);
		
		updateLayout();
		initEvents();
	}
	
	function initEvents() {
		if("ontouchstart" in document.documentElement || /Mobile/ig.test(navigator.userAgent)) {
			browserEvents = ["touchstart", "touchmove", "touchend"];
		} else {
			browserEvents = ["mousedown", "mousemove", "mouseup"];
			viewport.onmousewheel = onmousewheel;
		}
		container.addEventListener(browserEvents[0], ontouchstart);
	}
	
	function ontouchstart(evt) {
		if(!image.src) {
			return;
		}
		
		window.addEventListener(browserEvents[1], ontouchmove);
		window.addEventListener(browserEvents[2], ontouchend);
		evt.stopPropagation();
		if(evt.touches) {
			if(evt.touches.length > 1) {
				touchData.x2 = evt.touches[1].pageX;
				touchData.y2 = evt.touches[1].pageY;
			}
			touchData.x1 = evt.touches[0].pageX;
			touchData.y1 = evt.touches[0].pageY;
		} else {
			touchData.x1 = evt.pageX;
			touchData.y1 = evt.pageY;
		}
	}
	
	function ontouchmove(evt) {
		var x1 = evt.touches ? evt.touches[0].pageX : evt.pageX;
		var y1 = evt.touches ? evt.touches[0].pageY : evt.pageY;
		var offsetX = x1 - touchData.x1;
		var offsetY = y1 - touchData.y1;
		var d = 1;
		evt.stopPropagation();
		if(evt.touches && evt.touches.length > 1) {
			var x2 = evt.touches[1].pageX;
			var y2 = evt.touches[1].pageY;
			var d1 = getDistance(touchData.x1, touchData.y1, touchData.x2, touchData.y2);
			var d2 = getDistance(x1, y1, x2, y2);
			var x = (x2 + x1) / 2.0;
			var y = (y2 + y1) / 2.0;
			var dx = (x - imageLeft) / (imageWidth * imageScale);
			var dy = (y - imageTop) / (imageHeight * imageScale);
			d = d2 / d1;
			
			touchData.x2 = x2;
			touchData.y2 = y2;
			
			offsetX = (x - imageLeft) - imageWidth * imageScale * d * dx;
			offsetY = (y - imageTop) - imageHeight * imageScale * d * dy;
			if(imageScale * d < MAX_SCALE) {
				scale(d);
			}
		}
		touchData.x1 = x1;
		touchData.y1 = y1;
		move(offsetX, offsetY);
	}
	
	function ontouchend(evt) {
		window.removeEventListener(browserEvents[1], ontouchmove);
		window.removeEventListener(browserEvents[2], ontouchend);
		evt.stopPropagation();
	}
	
	function onmousewheel(evt) {
		var x = evt.pageX - rect.left;
		var y = evt.pageY - rect.top;
		var dx = (x - imageLeft) / (imageWidth * imageScale);
		var dy = (y - imageTop) / (imageHeight * imageScale);
		var d = 1;
		var delta = evt.wheelDelta || evt.detail;
		if(delta < 0) {
			d = 0.8;
		} else {
			d = 1.25;
		}
		
		var offsetX = (x - imageLeft) - imageWidth * imageScale * d * dx;
		var offsetY = (y - imageTop) - imageHeight * imageScale * d * dy;
		if(imageScale * d < MAX_SCALE) {
			scale(d);
			move(offsetX, offsetY);
		}
		evt.stopPropagation();
	}
	
	function getDistance(x1, y1, x2, y2) {
		return Math.sqrt((x1 - x2) * (x1- x2) + (y1 - y2) * (y1 - y2));
	}

	function updateLayout() {
		rect = container.getBoundingClientRect();
		containerWidth = rect.width;
		containerHeight = rect.height;
		viewport.style.width = containerWidth + "px";
		viewport.style.height = containerHeight + "px";
		previewWidth = containerWidth * PREVIEW_SCALE;
		previewHeight = containerHeight * PREVIEW_SCALE;
		
		if(widthRatio / heightRatio > containerWidth / containerHeight) {
			previewHeight = previewWidth * heightRatio / widthRatio;
		} else {
			previewWidth = previewHeight * widthRatio / heightRatio;
		}
		
		previewLeft = (containerWidth - previewWidth) * 0.5;
		previewTop = (containerHeight - previewHeight) * 0.5;
		
		updateMaskLayout();
		updateImageLayout();
	}

	function updateImageLayout() {
		if (!image.src) {
			return;
		}
		
		imageWidth = imageWidth > 0 ? imageWidth : image.offsetWidth;
		imageHeight = imageHeight > 0 ? imageHeight : image.offsetHeight;
		console.log	("图片尺寸：" + imageWidth + "*" + imageHeight);
		
		if(imageWidth / imageHeight > previewWidth / previewHeight) {
			adaptImageHeight = previewHeight;
			adaptImageWidth = adaptImageHeight * imageWidth / imageHeight;
		} else {
			adaptImageWidth = previewWidth;
			adaptImageHeight = adaptImageWidth * imageHeight / imageWidth;
		}
		imageLeft = (containerWidth - adaptImageWidth) * 0.5;
		imageTop = (containerHeight - adaptImageHeight) * 0.5;
		imageScale = adaptImageWidth / imageWidth;
		
		canvas.width = imageWidth;
		canvas.height = imageHeight;
		canvas.style.width = adaptImageWidth + "px";
		canvas.style.height = adaptImageHeight + "px";
		canvas.style.left = imageLeft + "px";
		canvas.style.top = imageTop + "px";
		
		if(image.matrix) {
			var m = image.matrix;
			context.setTransform(m[0],m[1],m[2],m[3],m[4],m[5])
		}
		renderImage();
	}

	function updateMaskLayout() {
		mask.width = containerWidth;
		mask.height = containerHeight;
		maskContext.save();
		maskContext.globalAlpha = 0.55;
		maskContext.clearRect(0, 0, mask.width, mask.height);
		maskContext.fillStyle = "#000000";
		maskContext.fillRect(0, 0, mask.width, mask.height);
		maskContext.clearRect(previewLeft, previewTop, previewWidth, previewHeight);
		maskContext.restore();
		maskContext.save();
		maskContext.globalAlpha = 1;
		maskContext.strokeStyle = "#FFFFFF";
		maskContext.lineWidth = 1;
		maskContext.strokeRect(previewLeft, previewTop, previewWidth, previewHeight);
		maskContext.restore();
	}
	
	function onimageload() {	
		if(image.orientation > 1) {
			adjustment(image.orientation);
		}
		updateImageLayout();
		imageLoaded = true;
	}
	
	function renderImage() {
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.drawImage(image, 0, 0);
	}
	
	function move(x, y) {
		imageLeft += x;
		imageTop += y;
		canvas.style.left = imageLeft + "px";
		canvas.style.top = imageTop + "px";
	}
	
	function scale(scale) {
		imageScale *= scale;
		canvas.style.width = imageWidth * imageScale + "px";
		canvas.style.height = imageHeight * imageScale + "px";
	}
	
	function getorientation(url, callback) {
		if(typeof self.getOrientation == "function") {
			// custom get orientation of image 
			self.getOrientation(url, callback);
		} else {
			var http = new XMLHttpRequest();
			var orientation = 1;
            http.onload = function() {
                if (this.status == 200 || this.status === 0) {
                    var dataview = new DataView(http.response);
                    var byte;
                    for(var i = 0; i < 200; i+=2) {
                    		byte = dataview.getInt16(i);
                    		if(byte == 0x1201) {
                    			orientation = dataview.getInt8(i + 8);
                    			break;
                    		} else if(byte == 0x0112) {
                    			orientation = dataview.getInt8(i + 9);
                    			break;
                    		}
                    }
                    callback(orientation);
                } else {
                    callback(orientation);
                }
                http = null;
            };
            http.open("GET", url, true);
            http.responseType = "arraybuffer";
            http.send(null);
		}
	}

	function adjustment(orientation) {
		var a = 0,
			b = 0,
			c = 0,
			d = 0,
			e = 0,
			f = 0;
		var w = image.offsetWidth, h = image.offsetHeight;
		switch (orientation) {
			case 1:
				a = d = 0;
				break;
			case 2:
				a = -1, d = 1, e = w;
				break;
			case 3:
				a = -1, d = -1, e = w, f = h;
				break;
			case 4:
				a = 1, d = -1, f = h;
				break;
			case 5:
				b = c = 1;
				break;
			case 6:
				b = 1, c = -1, e = h;
				break;
			case 7:
				b = c = -1, e = h, f = w;
				break;
			case 8:
				b = -1, c = 1, f = w;
				break;
			default:
				break;
		}
		if(orientation > 4) {
			imageWidth = h;
			imageHeight = w;
		}
		image.matrix = [a,b,c,d,e,f];
	}
	
	function isIOS() {
		return /(ipad)|(iphone)/ig.test(navigator.userAgent)
	}
	
	self.edit = function(url, adjust) {
		imageWidth = 0;
		imageHeight = 0;
		imageLoaded = false;
		context.setTransform(1,0,0,1,0,0);
		image.matrix = null;
		image.src = url;
		
		if(adjust && !isIOS()) {
			getorientation(url,  function(orientation) {
				console.log("图片方位：" + orientation);
				if(imageLoaded) {
					adjustment(orientation);
					updateImageLayout();
				} else {
					image.orientation = orientation;
				}
			});
		}
	}
	
	self.clip = function(width, height) {
		var width = width || imageWidth;
		var height = height || width;
		var _canvas = document.createElement("canvas");
		var _context = _canvas.getContext("2d");
		var _scale = Math.max(width / imageWidth, height / imageHeight);
		if(_scale > 1) {
			_scale = 1;
		}

		var _width = imageWidth * _scale;
		var _height = imageHeight * _scale;
		var _left = (previewLeft - imageLeft) / imageScale;
		var _top = (previewTop - imageTop) / imageScale;
		if(_width / _height > previewWidth / previewHeight) {
			_width = _height * previewWidth / previewHeight;
		} else {
			_height = _width * previewHeight / previewWidth;
		}
		_scale /= (adaptImageWidth / imageScale) / imageWidth;
		
		_canvas.width = _width;
		_canvas.height = _height;
		_canvas.style.width = _width + "px";
		_canvas.style.height = _height + "px";
		if(image.matrix) {
			var m = image.matrix;
			_context.setTransform(m[0] * _scale ,m[1] * _scale,m[2] * _scale,m[3] * _scale,(m[4]-_left) * _scale,(m[5]-_top) * _scale);
		} else {
			_context.setTransform(_scale,0,0,_scale,-_left * _scale,-_top * _scale);
		}
		_context.drawImage(image, 0, 0);
		return _canvas.toDataURL("data:image/jpg");
	}
}