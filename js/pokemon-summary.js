$(document).ready(function(){
	$('.pokemon-summary > div:first-child').on("click", function(event)
	{
		var target = $(event.currentTarget).parent();
		var moves  = target.find(" > div:last-child");

		var currentlyVisible = moves.css("display") != "none";

		var parentSummary = $(event.currentTarget).parent();

		if(parentSummary.prev().length == 0)
		{
			var top = parentSummary.offset().top;
		}
		else
		{
			var visible = parentSummary.prevAll().find("> div:nth-of-type(2):visible");

			if(visible.length == 0)
				var animationAdjustment = 0;
			else var animationAdjustment = visible.height();

			console.log(animationAdjustment);

			var top = parentSummary.offset().top - animationAdjustment - 100;
		}

		$('html, body').animate({
			scrollTop: top,
		});

		$('.pokemon-summary > div:last-child').not(moves).slideUp(500);

		if(currentlyVisible)
			moves.slideUp(500);
		else moves.slideDown(500);
	});
});