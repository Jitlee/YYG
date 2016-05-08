$(function(){
//	// 图片懒加载
//	$("img.lazy").Lazy();
	
	/** 倒计时JS开始 **/
	var countdownHTML = "<d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d>";
//	var countdowns = $("time").each(function() {
//		$this = $(this);
//		$this.append("<d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d>");
//		this.countdown = Number($this.attr("countdown"));
//		this.digits = this.getElementsByTagName("d");
//	});
	var countdowns = [];
	var scrollHandler = null;
	var countHandler = null;
	window.addEventListener("scroll", onscroll);
	
	window.countdown = onscroll;
	
	function onscroll() {
		window.clearTimeout(scrollHandler);
		window.clearInterval(countHandler);
		scrollHandler = window.setTimeout(function() {
			countdowns.length = 0;
			var wHeight = $(window).height();
			$("time").each(function() {
				var rect = this.getBoundingClientRect();
				var top = rect.top;
				var bottom = rect.bottom;
                if (bottom > 0 && top < wHeight) {
                		if(typeof this.countdown != "number") {
						this.countdown = Number(this.getAttribute("countdown"));
						if(!(this.countdown > 0)) {
							this.countdown = Number(this.getAttribute("_countdown")) * 1000;
						}
						if(this.getAttribute("yj") != "false") {
		                		this.innerHTML = countdownHTML;
							this.digits = this.getElementsByTagName("d");
						}
					}
                   	countdowns.push(this);
                }
			});
			if(countdowns.length > 0) {
				countHandler = window.setInterval(oncount, 250);
			}
		}, 100)
	}

	function oncount() {
		var now = new Date().getTime();
		$.each(countdowns, function(){
			var time = this.countdown - now;
			if(time > 0) {
				var _hours = Math.min(Math.floor(time / 1000 / 3600), 99);
				var _muintes = Math.floor(time /1000 / 60) % 60;
				var _seconds = Math.floor(time/1000)%60;
				var _milliseconds = time%1000;
				if(this.digits && this.digits.length > 0) {
					hours = _hours > 9 ? String(_hours) : "0" + _hours;
					muintes = _muintes > 9 ? String(_muintes) : "0" + _muintes;
					seconds = _seconds > 9 ? String(_seconds) : "0" + _seconds;
					milliseconds = _milliseconds > 9 ? String(_milliseconds) : "0" + _milliseconds;
					if(_hours > 0) {
						this.digits[0].innerHTML = hours[0];
						this.digits[1].innerHTML = hours[1];
						this.digits[2].innerHTML = muintes[0];
						this.digits[3].innerHTML = muintes[1];
						this.digits[4].innerHTML = seconds[0];
						this.digits[5].innerHTML = seconds[1];
					} else {
						this.digits[0].innerHTML = muintes[0];
						this.digits[1].innerHTML = muintes[1];
						this.digits[2].innerHTML = seconds[0];
						this.digits[3].innerHTML = seconds[1];
						this.digits[4].innerHTML = milliseconds[0];
						this.digits[5].innerHTML = milliseconds[1];
					}
				} else {
					var _days = Math.floor(time / 24 / 1000 / 3600);
					var _hours = Math.floor(time / 1000 / 3600) % 24;
					this.innerHTML = [_days, "天", _hours, "小时", _muintes, "分", _seconds, "秒", _milliseconds].join("");
				}
			} else {
				if(this.digits && this.digits.length > 0) {
					this.digits[0].innerHTML = "0";
					this.digits[1].innerHTML = "0";
					this.digits[2].innerHTML = "0";
					this.digits[3].innerHTML = "0";
					this.digits[4].innerHTML = "0";
					this.digits[5].innerHTML = "0";
				} else {
					this.innerHTML = "00:00:00";
				}
			}
		});
	}
	onscroll();
	/** 倒计时JS结束 **/
	
	
});


	
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