util = { 
	/**
	 * 格式化字符串 
	 * @param {String} str
	 */
	format: function(str) {
		for (var i = 1, len = arguments.length; i < len; i++) {       
			var reg = new RegExp("\\{" + i + "\\}", "gm");             
		    str = str.replace(reg, arguments[i]);
		}
  		return str;
	},
	
	/*
	 * 将分钟转换成时间格式
	 */
	formatMuites: function(muites) {
		var _hours = Math.floor(muites / 60);
		var _muites = Math.round(muites % 60);
		var result = [];
		if(_hours < 10) {
			result.push("0");
		}
		result.push(_hours);
		result.push(":");
		if(_muites < 10) {
			result.push("0");
		}
		result.push(_muites);
		return result.join("");
	},
	
	/**
	 * body滚动到底部时触发 
	 * @param {Function} callback 回调函数
	 * @param {Number} threshold 阀值，默认为200
	 * @return {Object} 句柄
	 */
	onScrollEnd: function(callback, threshold) {
		var threshold = threshold || 200;
		var timeHandler = null;
		var onscrollend = function() {
			if ($(window).scrollTop() + $(window).height() + threshold > $(document).height()) {
				console.info("滚动到了底部");
				window.clearTimeout(timeHandler);
       			timeHandler = window.setTimeout(callback, 300);
			}
		}
		$(document).bind("scroll", onscrollend);
		return {
			destory: function() {
				$(document).unbind("scroll", onscrollend);
			}
		};
	},
	
	/**
	 * 获取url参数
	 * @param {String} 参数名字
	 * @param {String} defaultValue 默认值
	 */
	i: function(name, defaultValue) {
		var url = window.location.href;
		var match = new RegExp("[\?&]" + name + "\=([^&]+)").exec(url);
		if(match && match.length > 1) {
			return decodeURIComponent(match[1]);
		}
		return defaultValue;
	},
	
	/**
	 * 掩码手机号码 138****8888
	 * @param {Object} phone
	 */
	maskPhone: function(phone) {
		if(phone && phone.replace) {
			return phone.replace(/^(\d{3})\d{4}(\d+)$/, "$1****$2");
		}
		return phone;
	},
	/**
	 * 消息提醒
	 * @param {Object} 提醒消息
	 */
	msg: function(msg) {
//		layer.open({
//		    content: msg,
//		    style: 'background-color:#09C1FF; color:#fff; border:none;',
//		    time: 5
//		});
		layer.msg(msg);
	}
}