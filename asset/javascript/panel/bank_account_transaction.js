$(document).ready(function() {
	
	
	function bankAccountTransaction() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.deleteTransaction = function(data) {
			
			var panelUrl = this.initialize.panelUrl;
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'delete',
				'id' : data.id,
				'type' : data.type
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					data.element.remove();
					
				}
				
				else {
					
					window.location.replace(panelUrl+'restricted_access/');
					
				}
				
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				$('#loading').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('#loading').css({
						'display' : 'none'
					});
					
				});
				
				setTimeout(function() {
					
					$('#response').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('#response').css({
							'display' : 'none'
						});
						
					});
					
				}, 3000);
				
			});
			
		}
		
		
		/* Document children method */
		this.loadTransaction = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadDetail',
				'id' : data.id,
				'type' : data.type
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_ajax/'
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
	
	
	var bankAccountTransaction = new bankAccountTransaction();
	
	$('td.load-detail').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-transaction-id'),
			'type' : $(this).attr('data-transaction-type')
		};
		bankAccountTransaction.loadTransaction(initialize);
		
	});
	
	$('button.delete').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-transaction-id'),
			'element' : $(this).parent().parent(),
			'type' : $(this).attr('data-transaction-type')
		};
		bankAccountTransaction.deleteTransaction(initialize);
		
		return false;
		
	});
	
	
});