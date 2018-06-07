$(document).ready(function() {
	
	
	function setting() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.updateSetting = function() {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'updateSetting',
				'runningText' : $('textarea.running-text').val()
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'setting_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					
				}
				
				else {
					
					$('#response').removeClass().addClass('error').html(response.response);
					
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
				
			}, 7000);
			
		}
		
		
	}
	
	
	var setting = new setting();
	
	$('button.update').click(function() {
		
		setting.updateSetting();
		
		return false;
		
	});
	
	
});