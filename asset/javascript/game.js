$(document).ready(function() {
	
	
	function game() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url')
		};
		
		
		this.toggleGame = function(data) {
			
			$('div.game-list').each(function() {
				
				if($(this).attr('data-index') == data.index) {
					
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
				
			});
			
			$('img.game-navigation').each(function() {
				
				if($(this).attr('data-index') == data.index) {
					
					$(this).animate({
						'height' : '110px',
						'margin-top' : 0
					}, 400);
					
				}
				
				else {
					
					$(this).animate({
						'height' : '90px',
						'margin-top' : '10px'
					}, 400);
					
				}
				
			});
			
		}
		
		
	}
	
	
	var game = new game();
	
	$('img.game-navigation').click(function() {
		
		var initialize = {
			'index' : $(this).attr('data-index')
		};
		game.toggleGame(initialize);
		
	});
	
	
});