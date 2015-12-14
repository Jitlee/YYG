;(function(){
	
	function eventHandler(func, obj) {
		return function(evt) {
			return func.call(obj, evt||window.event);
		}
	}
	
	function easeOut(t,b,c,d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	}
	
	function getTouches(evt) {
		var touches = { single: true };
		if(evt.touches) {
			touches.x1 = evt.touches[0].pageX - document.body.scrollLeft;;
			touches.y1 = evt.touches[0].pageY - document.body.scrollTop;
			if(evt.touches.length > 1) {
				touches.x2 = evt.touches[1].pageX - document.body.scrollLeft;
				touches.y2 = evt.touches[1].pageY - document.body.scrollTop;
				touches.single = false;
			}
		} else {
			touches.x1 = evt.pageX - document.body.scrollLeft;
			touches.y1 = evt.pageY - document.body.scrollTop;
		}
		return touches;
	}
	
	var numberRegex = /-?\d+/;
	function getTranslateX(element) {
		return Number(numberRegex.exec(element.style.webkitTransform));
	}
	
	function getDistance(x1, y1, x2, y2) {
		return Math.sqrt((x1 - x2) * (x1- x2) + (y1 - y2) * (y1 - y2));
	}
	
	function ImageViewer(options) {
		this.options = options || {};
		this.options.opening = this.options.opening || function(){};
		this.options.closeing = this.options.closeing || function(){};
		
		var container = document.createElement("div");
		container.style.width = "100%";
		container.style.height = "100%";
		container.style.position = "fixed";
		container.style.left = 0;
		container.style.top = 0;
		container.style.backgroundColor = "#000000";
		container.style.visibility = "hidden";
		container.style.overflow = "hidden";
		container.style.zIndex = 9999;
		document.body.appendChild(container);
		this.container = container;
		
		var indicator = document.createElement("ul");
		indicator.style.display = "table";
		indicator.style.position = "absolute";
		indicator.style.left = 0;
		indicator.style.width = "100%";
		indicator.style.bottom = "10px";
		indicator.style.height = "30px";
		indicator.style.lineHeight = "30px";
		indicator.style.listStyle = "none";
		indicator.style.padding = 0;
		indicator.style.margin = 0;
		indicator.style.zIndex = 98;
		indicator.style.textAlign = "center";
		container.appendChild(indicator);
		this.indicator = indicator;
		
		var origin = document.createElement("a");
		origin.style.display = "block";
		origin.style.height = "30px";
		origin.style.lineHeight = "30px";
		origin.style.color = "#fff";
		origin.style.border = "solid 1px rgba(200,200,200,0.4)";
		origin.style.backgroundColor = "rgba(30,30,30,0.4)";
		origin.style.borderRadius = "5px";
		origin.style.position = "absolute";
		origin.style.right = "10px";
		origin.style.bottom = "10px";
		origin.style.padding = "0 15px";
		origin.style.zIndex = 99;
		origin.innerHTML = "查看原图";
		container.appendChild(origin);
		this._origin = origin;
		
		var header = document.createElement("div");
		header.style.position = "absolute";
		header.style.top = 0;
		header.style.left = 0;
		header.style.height = "50px";
		header.style.width = "100%";
		header.style.zIndex = 9;
		header.style.backgroundColor = "rgba(30,30,30,0.9)";
		header.style.webkitTransition = "-webkit-transform 0.2s ease-out";
		if(plus.os.name === "iOS"){
			header.style.height = "70px";
			header.style.paddingTop = "20px";
		}
		container.appendChild(header);
		this._header = header;
		this._header.isShow = true;
		
		var back = document.createElement("a");
		back.style.display = "inline-block";
		back.style.lineHeight = "50px";
		back.style.width = "50px";
		back.className = "mui-icon mui-icon-back";
		back.style.textAlign = "center";
		back.style.color = "#fff";
		header.appendChild(back);
		this.back = back;
		
		var title = document.createElement("div");
		title.style.display = "inline-block";
		title.style.borderLeft = "solid 1px rgba(0,0,0,0.2)";
		title.style.height = "25px";
		title.style.lineHeight = "25px";
		title.style.paddingLeft = "10px";
		header.appendChild(title);
		
		var numSpan = document.createElement("span");
		numSpan.style.color = "#fff";
		title.appendChild(numSpan);
		this._numSpan = numSpan;
		
		var countSpan = document.createElement("span");
		countSpan.style.color = "#fff";
		title.appendChild(countSpan);
		this._countSpan = countSpan;
		
		var remove = document.createElement("a");
		remove.style.display = "inline-block";
		remove.style.lineHeight = "50px";
		remove.style.width = "50px";
		remove.className = "mui-icon mui-icon-trash";
		remove.style.textAlign = "center";
		remove.style.color = "#fff";
		remove.style.float = "right";
		header.appendChild(remove);
		this._remove = remove;
		
		var viewport = document.createElement("div");
		viewport.style.height = "100%";
		container.appendChild(viewport);
		
		this.viewport = viewport;
		
		this.initEvents();
		this.imageObjects = [];
		this.index = -1;
		this.touches = {};
		
		this._hideEvent = eventHandler(this._onhide, this);
	}
	
	ImageViewer.prototype.initEvents = function() {
		var self = this;
		window.addEventListener("tap", function(evt) {
			var element = evt.srcElement;
			var group = element.getAttribute("iv");
			if(group) {
				var images = document.querySelectorAll("[iv='"+ group +"']");
				var edit = element.getAttribute("iv-edit") == "true";
				var index = -1;
				var imageObjects =[];
				for(var i = 0, len = images.length; i < len; i++) {
					var img = images[i];
					var small = img.getAttribute("iv-small") || img.getAttribute("src");
					var larger = img.getAttribute("iv-larger");
					var origin = img.getAttribute("iv-origin");
					var isLoadedOrigin = img.getAttribute("iv-is-loaded-origin") == "true";
					if(img == element) {
						index = i;
					}
					
					imageObjects.push({
						index: i,
						small: small,
						larger: larger,
						origin: origin,
						element: img,
						isLoadedOrigin: isLoadedOrigin
					});
				}
				self.open(imageObjects, index, edit);
			}
		});
		
		this.touchstartEventHanler = eventHandler(this.ontouchstart, this);
		this.touchmoveEventHanler = eventHandler(this.ontouchmove, this);
		this.touchendEventHanler = eventHandler(this.ontouchend, this);
		
		this.container.addEventListener("touchstart",this.touchstartEventHanler);
		
		
		this.back.addEventListener("touchstart", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = "rgba(0,0,0,0.2)";
		});
		this.back.addEventListener("touchend", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = null;
			self.close();
		});
		
		this._remove.addEventListener("touchstart", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = "rgba(0,0,0,0.2)";
		});
		this._remove.addEventListener("touchend", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = null;
			
			self.remove();
		});
		
		this._origin.addEventListener("touchstart", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = "rgba(0,0,0,0.2)";
		});
		this._origin.addEventListener("touchend", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			this.style.backgroundColor = null;
			
			self.lazyLoading(self.index, true);
		});
	}
	
	ImageViewer.prototype.ontouchstart = function(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		
		this.touches = getTouches(evt);
		
		window.addEventListener("touchmove",this.touchmoveEventHanler);
		window.addEventListener("touchend",this.touchendEventHanler);
		if(!this._paths) {
			this._paths = [];
		}
		
		this._scaling = !this.touches.single;
		var div = this.imageObjects[this.index].div;
		div._x = div._x || 0;
		div._y = div._y || 0;
		div._s = div._s || 1;
	}
	
	ImageViewer.prototype.ontouchmove = function(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		var touches = getTouches(evt);
		var div = this.imageObjects[this.index].div;
		var originX = div._x;
		var originY = div._y;
		var originScale = div._s;
		var rect = this.rect;
		var offsetX = touches.x1 - this.touches.x1;
		var offsetY = touches.y1 - this.touches.y1;
			
		if(this._scaling && !touches.single) {
			// 缩放
			var d1 = getDistance(this.touches.x1, this.touches.y1, this.touches.x2, this.touches.y2);
			var d2 = getDistance(touches.x1, touches.y1, touches.x2, touches.y2);
			var x = (touches.x2 + touches.x1) / 2.0;
			var y = (touches.y2 + touches.y1) / 2.0;
			var dx = (x - originX) / (rect.width * originScale);
			var dy = (y - originY) / (rect.height * originScale);
			d = d2 / d1;
			originScale *= d;
			originX += (x - originX) * (1- d);
			originY += (y - originY) * (1- d);
			div._x = originX;
			div._y = originY;
			div._s = originScale; 
			div.style.webkitTransform = ["matrix(", originScale , ", 0, 0,",originScale, ",",  originX, ",",  originY, ")"].join("")
		} else if(!this._scaling && touches.single) {
			var x = getTranslateX(this.viewport);
			if(div._s > 1 && Math.abs(this.index * rect.width + x) < 5
				&& !(offsetX < 0 && originX == rect.width * (1- originScale))
				&& !(offsetX > 0 && originX == 0)) {
				// 放大平移
				originX += offsetX;
				originY += offsetY;
				if(originX > 0) {
					originX = 0;
				} else if(originX < rect.width * (1 - originScale)) {
					originX = rect.width *(1 - originScale)
				}
				
				if(originY > 0) {
					originY = 0;
				} else if(originY < rect.height * (1 - originScale)) {
					originY = rect.height * (1 - originScale);
				}
				
				div._x = originX;
				div._y = originY;
				div.style.webkitTransform = ["matrix(", originScale , ", 0, 0,",originScale, ",",  originX, ",",  originY, ")"].join("");
			} else {
				this.viewport.style.webkitTransform = "translateX(" + (x + offsetX) + "px)";
			}
		}
		
		if(this._paths.length > 0) {
			if(this._paths[this._paths.length - 1] * offsetX < 0) {
				this._paths.length = 0;
			}
		}
		
		if(!this._scaling) {
			this._paths.push(offsetX);
			var self = this;
			
			window.clearTimeout(this.pathTimeout);
			var timeout = 100;
			this.pathTimeout = window.setTimeout(function() {
				self._paths.length = 0;
			}, timeout);
		}
		if(offsetX != 0 && !this._moved) {
			this._moved = true;
			this.hideHeader();
		}
		
		this.touches = touches;
	}
	
	ImageViewer.prototype.ontouchend = function(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		
		window.removeEventListener("touchmove",this.touchmoveEventHanler);
		window.removeEventListener("touchend",this.touchendEventHanler);
		
		if(this._moved) {
			var div = this.imageObjects[this.index].div;
			var img = this.imageObjects[this.index].img;
			var originX = div._x;
			var originY = div._y;
			var originScale = div._s;
			var rect = this.rect;
			var x = getTranslateX(this.viewport);
			
			if(!(div._s > 1 && Math.abs(this.index * rect.width + x) < 5
				&& originX != rect.width * (1- originScale)
				&& originX != 0) ||
				(div._s > 1 && img.width < rect.width && img.height < rect.height)) {
				var path = 0; 
				if(this._moved && !(div._s > 1)) {
					var count = 2; // 数值越小越灵敏
					if(this._paths.length >= count) {
						for(var i = this._paths.length - 1, end = Math.max(this._paths.length - count, -1); i > end; i--) {
							path += this._paths[i];
						}
					}
				}			
				
				this.swipe(path);
			}
		} else if(this.onremove) {
			this.toggleHeader();
		} else if(!this._scaling) {
			this.close();
		}
		
		this._paths.length = 0;
		this._moved = false;
	}
	
	ImageViewer.prototype.swipe = function(path) {
		var originX = getTranslateX(this.viewport);
		var rect = this.rect;
		
		var div = this.imageObjects[this.index].div;
		
		if(path == 0) { 
			// 如果划过半屏，则算滑动
			 var offset = - this.index * rect.width - originX;
			if(offset < -0.6 * rect.width) {
				path = 1;
			} else if(offset > 0.6 * rect.width) {
				path = -1;
			}
		}
		
		var changed = true;
		if(path > 0 && this.index > 0) {
			this.index--;
		} else if(path < 0 && this.index < this.imageObjects.length - 1) {
			this.index++;
		} else {
			changed = false;
		}
		
		if(changed || div._s < 1) {
			div._x = 0;
			div._y = 0;
			div._s = 1;
			div.style.webkitTransform = null;
		}
		
		if(changed) {
			this.lazyLoading(this.index);
		}
		
		var offset = - this.index * rect.width - originX;
		var times = 20;
		var step = 0;
		var self = this;
		
		if(Math.abs(offset) > 10) {
			function animation() {
				self.viewport.style.webkitTransform = "translateX(" + easeOut(step, originX, offset, times) + "px)";
				if(step < times) {
					step++;
					swipeTimeout = window.setTimeout(animation, 15);
				}
			}
			animation();
		} else if(Math.abs(offset) > 0) {
			self.viewport.style.webkitTransform = "translateX(" + (originX + offset) + "px)";
		}
	}
	
	ImageViewer.prototype.toggleHeader = function() {
		if(this._header.isShow) {
			this.hideHeader();
		} else {
			this.showHeader();
		}
	}
	
	ImageViewer.prototype.showHeader = function() {
		if(!this._header.isShow) {
			this._header.style.webkitTransform = "translateY(0)";
			this._header.isShow = true;
		}
	}
	
	ImageViewer.prototype.hideHeader = function() {
		if(this._header.isShow) {
			this._header.style.webkitTransform = "translateY(-70px)";
			this._header.isShow = false;
		}
	}
	
	ImageViewer.prototype.open = function(images, index, edit) {
		this.index = index;
		this.edit = edit === true;
		var rect = this.container.getBoundingClientRect();
		this.rect = rect;
		
		this.imageObjects.length = 0;
		this.viewport.innerHTML = "";
		
		this._countSpan.innerHTML = " / " + images.length;
		for(var i = 0, len = images.length; i < len; i++) {
			var imgObject = images[i];
			var div = document.createElement("div");
			div.style.position = "relative";
			div.style.width = rect.width + "px";
			div.style.height = rect.height + "px";
			div.style.float = "left";
			div.style.webkitTransformOrigin = "0 0";
			this.viewport.appendChild(div);
			
			var img = document.createElement("img");
			img.style.position = "absolute";
			img.src = imgObject.small;
			div.appendChild(img);
			if(img.width < rect.width && img.height < rect.height) {
				img.style.top = (rect.height - img.height) * 0.5 + "px";
				img.style.left = (rect.width - img.width) * 0.5 + "px";
				img.style.top = "50%";
				img.style.left = "50%";
				img.style.webkitTransform = "translate(-50%, -50%)";
			}else if((img.width == img.height && rect.width < rect.height) || img.width / img.height > rect.width / rect.height) {
				img.style.width = rect.width + "px";
				img.style.left = 0;
				img.style.top = (rect.height - rect.width * img.height / img.width) * 0.5 + "px";
			} else {
				img.style.height = rect.height + "px";
				img.style.top = 0;
				img.style.left = (rect.width - rect.height * img.width / img.height) * 0.5 + "px";
			}
			
			imgObject.div = div;
			imgObject.img = img;
			
			console.log("图片分辨率: " + img.width + " * " + img.height);
			
			var li = document.createElement("li");
			li.style.display = "inline-block";
			li.style.width = "4px";
			li.style.height = "4px";
			li.style.opacity = 0.2;
			li.style.backgroundColor = "#ddd";
			li.style.borderRadius = "2px";
			li.style.margin = "0 2px";
			imgObject.indicator = li;
			this.indicator.appendChild(li);
		}
			
		this.imageObjects = images;
		
		this.viewport.style.webkitTransform = "translateX(-" + index * rect.width + "px)";
		this.viewport.style.width = images.length * rect.width + "px";
		
		this.lazyLoading(index);
		
		if(this.onremove) {
			this._header.style.display = "";
		} else {
			this._header.style.display = "none";
		}
		
		this.show();
		
		// 阻止返回按钮事件，修改成隐藏，而不是关闭按钮
		if(mui && plus) {
			this._originBeforeBack = mui.options.beforeback;
			mui.options.beforeback = this._hideEvent;
			if(plus && plus.key) { // 阻止返回键
				plus.key.addEventListener("backbutton", this._hideEvent);
			}
		}
	}
	
	ImageViewer.prototype.lazyLoading = function(index, showOrigin, silent) {
		var imageObject = this.imageObjects[index];
		var self = this;
		var source = imageObject.larger;
		
		if(showOrigin && imageObject.origin && !imageObject.isLoadedOrigin) {
			imageObject.isLoaded = false;
			imageObject.isLoadedOrigin = true;
			if(imageObject.element) {
				imageObject.element.setAttribute("iv-is-loaded-origin", true);
			}
			source = imageObject.origin;
			this._origin.style.display = "none";
		} else if(imageObject.origin && !imageObject.isLoadedOrigin) {
			this._origin.style.display = "block";
		} else if(imageObject.origin && imageObject.element && imageObject.element.getAttribute("iv-is-loaded-origin") == "true") {
			this._origin.style.display = "none";
			source = imageObject.origin;
		} else {
			this._origin.style.display = "none";
		}
		
		if(silent != false) {
			if(index > 0) {
				this.indicator.children[index - 1].style.opacity = 0.2;
			}
			this.indicator.children[index].style.opacity = 0.8;
			if(index < this.imageObjects.length - 1) {
				this.indicator.children[index + 1].style.opacity = 0.2;
				this.lazyLoading(index + 1, false, false);
			}
			
			this._numSpan.innerHTML = index + 1;
		}
		if(!imageObject.isLoaded) {
			if(source) {
				var rect = this.rect;
				var img = document.createElement("img");
				img.style.position = "absolute";
				var spin = document.createElement("img");
				spin.src = plus.io.convertLocalFileSystemURL("_www/images/loading.gif");
				spin.style.position = "absolute";
				spin.style.top = "50%";
				spin.style.left = "50%";
				spin.style.webkitTransform = "translate(-50%, -50%)";
				imageObject.div.appendChild(spin);
				img.onload = function() {
					if(img.width < rect.width && img.height < rect.height) {
						img.style.top = (rect.height - img.height) * 0.5 + "px";
						img.style.left = (rect.width - img.width) * 0.5 + "px";
						img.style.width = img.width + "px";
						img.style.height = img.height + "px";
					}else if((img.width == img.height && rect.width < rect.height) || img.width / img.height > rect.width / rect.height) {
						img.style.width = "100%";
						img.style.left = 0;
						img.style.top = (rect.height - rect.width * img.height / img.width) * 0.5 + "px";
					} else {
						img.style.height = "100%";
						img.style.top = 0;
						img.style.left = (rect.width - rect.height * img.width / img.height) * 0.5 + "px";
					}
					imageObject.div.removeChild(imageObject.img);
					imageObject.img = img;
					if(self.index == index && imageObject.origin && !imageObject.isLoadedOrigin) {
						self._origin.style.display = "block";
					}
					imageObject.div.removeChild(spin);
					img.style.visibility = "visible";
				}
				img.style.visibility = "hidden";
				imageObject.div.appendChild(img);
				img.src = source;
				
			}
			imageObject.isLoaded = true;
		}
	}
	
	ImageViewer.prototype.show = function() {
		var self = this;
		window.clearTimeout(this.closeHandler);
		this.container.style.webkitTransform = "scale(0.5)";
		this.container.style.opacity = 0;
		this.container.style.visibility = "visible";
		this.closeHandler = window.setTimeout(function() {
			self.container.style.webkitTransition = "all 0.2s ease-in";
			self.container.style.webkitTransform = "scale(1)";
			self.container.style.opacity = 1;
		}, 0);
		window.setTimeout(function() {
			self.options.opening.call();
//			plus.navigator.setFullscreen(true);
		}, 0);
		
	}
	
	ImageViewer.prototype.close = function() {
		this.options.closeing.call();
//		plus.navigator.setFullscreen(false);
		
		window.clearTimeout(this.closeHandler);
		var self = this;
		this.container.style.webkitTransition = "all 0.2s ease-out";
		this.container.style.webkitTransform = "scale(0.5)";
		this.container.style.opacity = 0;
		this.closeHandler = window.setTimeout(function() {
			self.imageObjects.length = 0;
			self.viewport.innerHTML = "";
			self.indicator.innerHTML = "";
			self.container.style.visibility = "hidden";
			self.container.style.webkitTransition = null;
			self.container.style.webkitTransform = "scale(1)";
			self.container.style.opacity = 1;
		}, 200);
		this.edit = false;
		
		// 阻止返回按钮事件，修改成隐藏，而不是关闭按钮
		if(mui && plus) {
			if(this._originBeforeBack) {
				mui.options.beforeback = this._originBeforeBack;
			}
			if(plus && plus.key) { // 阻止返回键
				plus.key.removeEventListener("backbutton", this._hideEvent);
			}
		}
	}
	
	
	ImageViewer.prototype._onhide = function() {
		this.close();
		return false;
	}
	
	ImageViewer.prototype.remove = function() {
		var self = this;
		var message = '要删除这张照片吗？';
		mui.confirm(message, '提 示', ['确定', '取消'], function(e) {
			if (e.index == 0) {
				onremove.call(self);
			}
		});
	}
	
	function onremove() {
		var imageObject = this.imageObjects[this.index];
		if(typeof this.onremove == "function") {
			try {
				this.onremove({
					srcElement: imageObject.element,
					index: this.index
				});
			} catch(e) {
				
			}
		}
		
		
		if(this.imageObjects.length == 1) {
			this.close();	
		} else {
			var rect = this.rect;
			this.imageObjects.splice(this.index, 1);
			this.indicator.removeChild(this.indicator.children[this.index]);
			imageObject.div.parentElement.removeChild(imageObject.div);
			imageObject.img = null;
			imageObject.div = null;
			if(this.index < this.imageObjects.length) {
				this.lazyLoading(this.index);	
			} else {
				this.lazyLoading(--this.index);
			}
			this.viewport.style.webkitTransform = "translateX(-" + (this.index * rect.width) + "px)";
			this._countSpan.innerHTML = " / " + this.imageObjects.length;
			this._numSpan.innerHTML = this.index + 1;
		}
	}
	
	
	window.ImageViewer = ImageViewer;
})();