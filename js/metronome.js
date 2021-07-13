$(document).ready(function(){
	$('#metronome-button-container button').on("click", function(event)
	{
		var numberToGet = $(event.target).data("rolls");

		$('#metronome-results').css("display", "inherit");

		var rows = $('#metronome-results tr:not(:first-child)');

		if(rows.length < numberToGet)
			return;

		var rowsToDisplay = [];

		while(rowsToDisplay.length < numberToGet)
		{
			var selected = Math.round(Math.random() * rows.length);

			if(!rowsToDisplay.includes(selected))
				rowsToDisplay.push(selected);
		}

		$(rows).css("display", "none");

		rowsToDisplay.forEach(element => {
			$(rows[element]).css("display", "inherit");
		});
	})
});