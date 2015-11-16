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
	
	function onscroll() {
		window.clearTimeout(scrollHandler);
		window.clearInterval(countHandler);
		scrollHandler = window.setTimeout(function() {
			countdowns.length = 0;
			var wTop = $(window).scrollTop();
			var wHeight = $(window).height();
			$("time").each(function() {
				var top = this.offsetTop;
                if (top >= wTop && top < (wTop + wHeight)) {
                		if(typeof this.countdown != "number") {
	                		this.innerHTML = countdownHTML;
						this.countdown = Number(this.getAttribute("countdown"));
						this.digits = this.getElementsByTagName("d");
					}
                   	countdowns.push(this);
                }
			});
			if(countdowns.length > 0) {
				countHandler = window.setInterval(oncount, 1000);
			}
		}, 100)
	}

	function oncount() {
		var now = Math.floor(new Date().getTime() / 1000);
		$.each(countdowns, function(){
			var time = this.countdown - now;
			var hours = Math.min(Math.floor(time / 3600), 99);
			var muintes = Math.floor(time / 60) % 60;
			var seconds = time%60;
			hours = hours > 9 ? String(hours) : "0" + hours;
			muintes = muintes > 9 ? String(muintes) : "0" + muintes;
			seconds = seconds > 9 ? String(seconds) : "0" + seconds;
			this.digits[0].innerHTML = hours[0];
			this.digits[1].innerHTML = hours[1];
			this.digits[2].innerHTML = muintes[0];
			this.digits[3].innerHTML = muintes[1];
			this.digits[4].innerHTML = seconds[0];
			this.digits[5].innerHTML = seconds[1];
		});
	}
	onscroll();
	/** 倒计时JS结束 **/
	
	
});