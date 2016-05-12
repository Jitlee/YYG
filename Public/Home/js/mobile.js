$(function(){
	window.closeLoading = function() {
		$(".yyg-loading").remove();
	}
});

(function() {
	var countdowns = [];
	var scrollHandler = null;
	var countHandler = null;
	var offset = 0;
	window.addEventListener("scroll", onscroll);
	window.countdown = onscroll;
	
	function onscroll(serverTime) {
		if(serverTime > 0) {
			offset = serverTime - new Date().getTime();
		}
		window.clearTimeout(scrollHandler);
		window.clearInterval(countHandler);
		scrollHandler = window.setTimeout(function() {
			countdowns.length = 0;
//			var wTop = $(window).scrollTop();
			var wHeight = $(window).height();
			$("[countdown]").each(function() {
				var rect = this.getBoundingClientRect();
				var top = rect.top;
				var bottom = rect.bottom;
				this.innerHTML = "00:00:00";
                if (bottom > 0 && top < wHeight) {
                		if(typeof this.countdown != "number") {
						this.countdown = Number(this.getAttribute("countdown"));
					}
                   	countdowns.push(this);
                }
			});
			if(countdowns.length > 0) {
				countHandler = window.setInterval(oncount, 250);
			}
		}, 100);
	}
	
	function oncount() {
		var now = new Date().getTime() + offset;
		
		$.each(countdowns, function(){
			var time = this.countdown - now;
			if(time > 0) {
				var _days = Math.floor(time / 24 / 1000 / 3600);
				var _hours = Math.floor(time / 1000 / 3600) % 24;
				var _muintes = Math.floor(time /1000 / 60) % 60;
				var _seconds = Math.floor(time/1000)%60;
				var _milliseconds = time%1000;
				if(_days > 0) {
					this.innerHTML = [_days, "天", _hours, "小时", _muintes, "分"].join("");
				} else {
					hours = ("00" + String(_hours)).match(/\d{2}$/)[0];
					muintes = ("00" + String(_muintes)).match(/\d{2}$/)[0];
					seconds = ("00" + String(_seconds)).match(/\d{2}$/)[0];
					milliseconds = ("000" + String(_milliseconds)).match(/\d{3}$/)[0];
					if(_hours > 0) {
						this.innerHTML = [hours, ":", muintes, ":", seconds].join("");
					} else {
						this.innerHTML = [muintes, ":", seconds, ":", milliseconds].join("");
					}
				}
			} else {
				this.innerHTML = "00:00:00";
			}
		});
	}
//	onscroll();
})();


	
	/**
	 * body滚动到底部时触发 
	 * @param {Function} callback 回调函数
	 * @param {Number} threshold 阀值，默认为200
	 * @return {Object} 句柄
	 */
	window.onScrollEnd = function(callback, threshold) {
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
	}