$(document).ready(function() {
	
	
	function global() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url')
		};
		
		
	}
	
	
	var global = new global();
	
	$('input.date').datepicker({
		'dateFormat' : 'yy-mm-dd'
	});
	
	
});


$(window).resize(function() {
	
	
	/* Not set yet */
	
	
});