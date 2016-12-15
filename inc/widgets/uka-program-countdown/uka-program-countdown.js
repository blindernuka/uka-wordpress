
	
function startTimer(duration, display) {
	var countdown = (function(){
		var timer = duration, days, hours, minutes, seconds;
		return function(){
			days = parseInt((timer / 86400), 10);
			hours = parseInt((timer / 3600) % 24, 10);
			minutes = parseInt((timer / 60) % 60, 10);
			seconds = parseInt(timer %  60, 10);
			
			days    = days < 10 ? "0" + days : days;
			hours   = hours < 10 ? "0" + hours : hours;
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			display.textContent = days + ":" + hours + ":" + minutes + ":" + seconds;

			if (--timer < 0) {
				timer = duration;
			}
		}
	})();
	countdown();
    setInterval(countdown, 1000);
}

$(document).ready(function (){
	var countdown = document.getElementById("countdown");
	if (countdown){
		var timestamp = countdown.getAttribute("timestamp");
		var display = document.getElementById('countdown');
		startTimer(timestamp, display);
	}
});