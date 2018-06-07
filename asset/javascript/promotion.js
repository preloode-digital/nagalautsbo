$(document).ready(function() {
	
	
	function promotion() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url')
		};
		
		
		this.descriptionToggle = function(data) {
			
			$('div.promotion-description').each(function() {
				
				if($(this).attr('data-index') == data.index) {
					
					if($(this).css('display') == 'none') {
						
						$(this).css({
							'display' : 'block'
						});
						$(this).animate({
							'opacity' : 1
						}, 400);
						
					}
					
					else {
						
						$(this).animate({
							'opacity' : 0
						}, 400, function() {
							
							$(this).css({
								'display' : 'none'
							});
							
						});
						
					}
					
				}
				
				else {
					
					$(this).animate({
						'opacity' : 0
					}, 400, function() {
						
						$(this).css({
							'display' : 'none'
						});
						
					});
					
				}
				
			});
			
		}
		
		
	}
	
	
	var promotion = new promotion();
	
	$('div.promotion-banner').click(function() {
		
		var initialize = {
			'index' : $(this).attr('data-index')
		};
		promotion.descriptionToggle(initialize);
		
	});
	
	
});