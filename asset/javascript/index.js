$(document).ready(function() {
	
	
	function index() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url')
		};
		
		
	}
	
	
	var index = new index();
	
	$('div.owl-carousel').owlCarousel({
		'autoplay' : true,
		'items' : 1,
		'loop' : true
	});
	
	
});