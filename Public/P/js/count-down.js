$(function() {
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
			var wTop = $(window).scrollTop();
			var wHeight = $(window).height();
			$("time").each(function() {
				var top = $(this).offset().top;
	            if (top >= wTop && top < (wTop + wHeight)) {
	            		if(typeof this.countdown != "number") {
						this.countdown = Number(this.getAttribute("countdown"));
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
			var _hours = Math.min(Math.floor(time / 1000 / 3600), 99);
			var _muintes = Math.floor(time /1000 / 60) % 60;
			var _seconds = Math.floor(time/1000)%60;
			var _milliseconds = time%1000;
			var _days = Math.floor(time / 24 / 1000 / 3600);
			var _hours = Math.floor(time / 1000 / 3600) % 24;
			if(_days > 0) {
				this.innerHTML = [_days, "<span>天</span>", _hours, "<span>小时</span>", _muintes, "<span>分</span>", _seconds, "<span>秒</span>"].join("");
			} else {
				this.innerHTML = [_hours, "<span>小时</span>", _muintes, "<span>分</span>", _seconds, "<span>秒</span>", _milliseconds].join("");
			}
		});
	}
	onscroll();
});