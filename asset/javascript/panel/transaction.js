$(document).ready(function() {
	
	
	function transaction() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.autoCompletePlayer = function() {
			
			var initialize = {
				'action' : 'loadPlayer'
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'player_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					player = [];
					
					$.each(response.player, function(key, value) {
						
						player.push(value.username);
						
					});
					
					$('input.playerUsername').autocomplete({
						source : player
					});
					
				}
				
			});
			
		}
		
		
		/* Document children method */
		this.deleteTransaction = function(data) {
			
			var panelUrl = this.initialize.panelUrl;
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'deleteTransaction',
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
		this.loadTransactionDetail = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadTransactionDetail',
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
	
	
	var transaction = new transaction();	
	
	transaction.autoCompletePlayer();
	
	$('td.load-detail').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-transaction-id'),
			'type' : $(this).attr('data-transaction-type')
		};
		transaction.loadTransactionDetail(initialize);
		
	});
	
	$('button.delete').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-transaction-id'),
			'element' : $(this).parent().parent(),
			'type' : $(this).attr('data-transaction-type')
		};
		transaction.deleteTransaction(initialize);
		
		return false;
		
	});
	
	
});