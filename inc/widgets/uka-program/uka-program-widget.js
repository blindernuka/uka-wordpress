

$(document).ready(function(){
	$(".widget_uka_program").each(function(i, widget){
		var days = $(widget).find(".uka-program");
		var pastDays = $(widget).find(".past").length;
		var lastPast = days[pastDays-1];
		if (days.length == pastDays){
			$(widget).scrollLeft(widget.scrollWidth - widget.offsetWidth);
		}
		else{
			$(widget).scrollLeft(days[pastDays-1].offsetLeft+days[pastDays-1].offsetWidth);
		}
	});
});