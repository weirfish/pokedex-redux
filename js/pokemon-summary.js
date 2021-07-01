$(document).ready(function(){
	$('.pokemon-summary > div:first-child').on("click", function(event)
	{
		var target = $(event.currentTarget).parent();
		var moves  = target.find(" > div:last-child");

		var currentDisplay = moves.css("display");

		$('.pokemon-summary > div:last-child').not(moves).slideUp(500);

		if(currentDisplay == "none")
			moves.slideDown(500);
		else moves.slideUp(500);

		$('html, body').animate({
			scrollTop: $(event.currentTarget).offset().top,
		});
	});
});