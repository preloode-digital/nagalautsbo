$(document).ready(function() {
	
	
	function transactionRequest() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Load transaction request detail children method */
		this.acceptTransactionRequest = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'acceptTransactionRequest',
				'bankAccountId' : $('select.bank-account').val(),
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					data.element.html(response.response);
					
				}
				
				else {
					
					$('#response').removeClass().addClass('error').html(response.response);
					
				}
				
				$('#popup').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('#popup').css({
						'display' : 'none'
					});
					
				});
				$('#popup').find('div.wrapper').animate({
					'opacity' : 0
				}, 400);
				
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
		this.loadTransactionRequestDetail = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadTransactionRequestDetail',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_ajax/'
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
		
		
		/* Load transaction request detail children method */
		this.rejectTransactionRequest = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'rejectTransactionRequest',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					data.element.html(response.response);
					
				}
				
				$('#popup').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('#popup').css({
						'display' : 'none'
					});
					
				});
				$('#popup').find('div.wrapper').animate({
					'opacity' : 0
				}, 400);
				
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
		
		
	}
	
	
	var transactionRequest = new transactionRequest();
	
	$('button.load-detail').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-transaction-request-id'),
			'element' : $(this).parent().parent()
		};
		transactionRequest.loadTransactionRequestDetail(initialize);
		
		return false;
		
	});
	
	$(document).ajaxComplete(function() {
		
		$('button.accept').click(function() {
			
			var id = $(this).attr('data-transaction-request-id');
			var element = '';
			
			$('button.load-detail').each(function() {
				
				if($(this).attr('data-transaction-request-id') == id) {
					
					element = $(this).parent().parent();
					
				}
				
			});
			
			var initialize = {
				'element' : element,
				'id' : id
			};
			transactionRequest.acceptTransactionRequest(initialize);
			
		});
		
		$('button.reject').click(function() {
			
			var id = $(this).attr('data-transaction-request-id');
			var element = '';
			
			$('button.load-detail').each(function() {
				
				if($(this).attr('data-transaction-request-id') == id) {
					
					element = $(this).parent().parent();
					
				}
				
			});
			
			var initialize = {
				'element' : element,
				'id' : id
			};
			transactionRequest.rejectTransactionRequest(initialize);
			
		});
		
	});
	
	
});


