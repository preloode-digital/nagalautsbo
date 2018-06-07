$(document).ready(function() {
	
	
	function player() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.deletePlayer = function(data) {
			
			var panelUrl = this.initialize.panelUrl;
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'deletePlayer',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'player_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					data.element.remove();
					
				}
				
				else {
					
					window.location.replace(panelUrl+'restricted_access/');
					
				}
				
				$('#loading').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('#loading').css({
						'display' : 'none'
					});
					
				});
				
			});
			
			$('#response').css({
				'display' : 'block'
			});
			$('#response').animate({
				'opacity' : 1
			}, 400);
			
			setTimeout(function() {
				
				$('#response').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('#response').css({
						'display' : 'none'
					});
					
				});
				
			}, 3000);
			
		}
		
		
		/* Document children method */
		this.loadPlayerDetail = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadPlayerDetail',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'player_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#mCSB_1_container').html(response.response);
					$('#popup').css({
						'display' : 'block'
					});
					$('#popup').animate({
						'opacity' : 1
					}, 400);
					$('#popup').find('div.wrapper').animate({
						'opacity' : 1
					}, 400);
					
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
		
		
	}
	
	
	var player = new player();	
	
	$('td.load-detail').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-player-id')
		};
		player.loadPlayerDetail(initialize);
		
	});
	
	$('button.delete').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-player-id'),
			'element' : $(this).parent().parent()
		};
		player.deletePlayer(initialize);
		
		return false;
		
	});
	
	
});