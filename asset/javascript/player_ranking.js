$(document).ready(function() {
	
	
	baseUrl = $('#config').attr('base-url');
	
	
});


/* Select type, input start date, input end date */
function loadTopPlayer() {
	
	$('#loading').css({
		'display' : 'block'
	}).animate({
		'opacity' : 1
	}, 400);
	
	var initialize = {
		'action' : 'loadTopPlayer',
		'endDate' : $('input.end-date').val(),
		'type' : $('select.type').val(),
		'startDate' : $('input.start-date').val()
	};
	$.ajax({
		'cache' : false,
		'data' : initialize,
		'dataType' : 'json',
		'method' : 'POST',
		'url' : baseUrl+'player_ranking_ajax/'
	}).done(function(response) {
		
		if(response.result == true) {
			
			$('table.ranking').html(response.response);
			
		}
		
		$('#loading').animate({
			'opacity' : 0
		}, 400, function() {
			
			$('#loading').css({
				'display' : 'none'
			});
			
		});
		
	});
	
}


$(document).ready(function() {
	
	
	$('select.type').change(function() {
		
		loadTopPlayer();
		
	});
	
	
	$('input.start-date').change(function() {
		
		loadTopPlayer();
		
	});
	
	
	$('input.end-date').change(function() {
		
		loadTopPlayer();
		
	});
	
	
});