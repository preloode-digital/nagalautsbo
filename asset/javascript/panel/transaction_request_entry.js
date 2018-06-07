$(document).ready(function() {
	
	
	function transactionRequestEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkAmount = function() {
			
			if($('input.amount').val() == 0) {
				
				$('p.amount').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please enter a valid amount!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.amount').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkFromBank = function() {
			
			if($('select.from-bank').val() == '') {
				
				$('p.from-bank').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please select transaction to bank!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.from-bank').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkFromBankAccount = function() {
			
			if($('select.from-bank-account').val() == '') {
				
				$('p.from-bank-account').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please select transaction to bank account!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.from-bank-account').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkGame = function() {
			
			var game = false;
			
			$('input.game').each(function() {
				
				if($(this).prop('checked') == true) {
					
					game = true;
					
				}
				
			});
			
			if(game == false) {
				
				$('p.game').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please select transaction game!');
						
					}
					
				});
				
			}
			
			else {
				
				$('p.game').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
			}
			
			return game;
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkPlayer = function() {
			
			if($('input.player').val().length < 3) {
				
				$('p.player').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please enter at least 3 characters!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.player').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select transaction request status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkToBank = function() {
			
			if($('select.to-bank').val() == '') {
				
				$('p.to-bank').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please select transaction to bank!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.to-bank').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert transaction request, update transaction request children method */
		this.checkToBankAccount = function() {
			
			if($('select.to-bank-account').val() == '') {
				
				$('p.to-bank-account').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('* Please select transaction to bank account!');
						
					}
					
				});
				
				return false;
				
			}
			
			else {
				
				$('p.to-bank-account').each(function() {
					
					if($(this).hasClass('response') == true) {
						
						$(this).html('');
						
					}
					
				});
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.initializeInput = function(data) {
			
			if(data.type == 'Deposit') {
				
				$('.from-bank').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.from-bank').css({
						'display' : 'none'
					});
					
				});
				
				$('.from-bank-account').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.from-bank-account').css({
						'display' : 'none'
					});
					
				});
				
				$('.promotion').css({
					'display' : 'block'
				});
				$('.promotion').animate({
					'opacity' : 1
				}, 400);
				
				$('.to-bank').css({
					'display' : 'block'
				});
				$('.to-bank').animate({
					'opacity' : 1
				}, 400);
				
				$('.to-bank-account').css({
					'display' : 'block'
				});
				$('.to-bank-account').animate({
					'opacity' : 1
				}, 400);
				
			}
			
			else if(data.type == 'Withdraw') {
				
				$('.from-bank').css({
					'display' : 'block'
				});
				$('.from-bank').animate({
					'opacity' : 1
				}, 400);
				
				$('.from-bank-account').css({
					'display' : 'block'
				});
				$('.from-bank-account').animate({
					'opacity' : 1
				}, 400);
				
				$('.promotion').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.promotion').css({
						'display' : 'none'
					});
					
				});
				
				$('.to-bank').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.to-bank').css({
						'display' : 'none'
					});
					
				});
				
				$('.to-bank-account').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.to-bank-account').css({
						'display' : 'none'
					});
					
				});
				
			}
			
			if(data.type != '') {
				
				$('.amount').css({
					'display' : 'block'
				});
				$('.amount').animate({
					'opacity' : 1
				}, 400);
				
				$('div.checkbox').css({
					'display' : 'block'
				});
				$('div.checkbox').animate({
					'opacity' : 1
				}, 400);
				
				$('.button').css({
					'display' : 'block'
				});
				$('.button').animate({
					'opacity' : 1
				}, 400);
				
				$('.game').css({
					'display' : 'block'
				});
				$('.game').animate({
					'opacity' : 1
				}, 400);
				
				$('div.item').css({
					'display' : 'block'
				});
				$('div.item').animate({
					'opacity' : 1
				}, 400);
				
				$('.note').css({
					'display' : 'block'
				});
				$('.note').animate({
					'opacity' : 1
				}, 400);
				
				$('.player').css({
					'display' : 'block'
				});
				$('.player').animate({
					'opacity' : 1
				}, 400);
				
				$('.status').css({
					'display' : 'block'
				});
				$('.status').animate({
					'opacity' : 1
				}, 400);
				
			}
			
		}
		
		
		/* Document children method */
		this.insertTransactionRequest = function() {
			
			if($('select.type').val() == 'Deposit') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'status' : this.checkStatus(),
					'toBank' : this.checkToBank(),
					'toBankAccount' : this.checkToBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Withdraw') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBank' : this.checkFromBank(),
					'fromBankAccount' : this.checkFromBankAccount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'status' : this.checkStatus()
				};
				
			}
			
			var result = '';
			
			$.each(validation, function(key, value) {
				
				if(value == false) {
					
					result = false;
					
					return false;
					
				}
				
				else {
					
					result = true;
					
				}
				
			});
			
			if(result == true) {
				
				$('#loading').css({
					'display' : 'block'
				}).animate({
					'opacity' : 1
				}, 400);
				
				var game = '';
				
				$('input.game').each(function() {
					
					if($(this).prop('checked') == true) {
						
						game = $(this).val();
						
					}
					
				});
				
				var initialize = {
					'action' : 'insertTransactionRequest',
					'amount' : $('input.amount').val(),
					'fromBankAccount' : $('select.from-bank-account').val(),
					'game' : game,
					'player' : $('input.player').val(),
					'note' : $('textarea.note').val(),
					'promotion' : $('select.promotion').val(),
					'status' : $('select.status').val(),
					'toBankAccount' : $('select.to-bank-account').val(),
					'type' :$('select.type').val()
				};
				
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'transaction_request_entry_ajax/'
				}).done(function(response) {
					
					if(response.result == true) {
						
						$('#response').removeClass().addClass('success').html(response.response);
						$('input[type=text]').val('');
						
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
				
			}
			
			else {
				
				$('#response').removeClass().addClass('error').html('<p>Transaction request failed added!</p>');
				
			}
			
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
		
		
		/* Document children method */
		this.loadBankAccount = function(data) {
			
			var initialize = {
				'action' : data.action,
				'fromBankId' : $('select.from-bank').val(),
				'toBankId' : $('select.to-bank').val(),
				'type' : $('select.type').val()
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					if(data.action == 'loadToBank') {
						
						$('select.to-bank-account').html(response.response);
						
					}
					
					else if(data.action == 'loadFromBank') {
						
						$('select.from-bank-account').html(response.response);
						
					}
					
				}
				
			});
			
		}
		
		
		/* Document children method */
		this.loadPlayer = function() {
			
			var game = '';
			
			$('input.game').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					game = $(this).val();
					
				}
				
			});
			
			var initialize = {
				'action' : 'loadPlayer',
				'game' : game
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					var player = [];
					
					$.each(response.response, function(key, value) {
						
						player.push(value);
						
					});
					
					$('input.player').autocomplete({
						source : player
					});
					
				}
				
			});
			
		}
		
		
		/* Document children method */
		this.loadPromotion = function() {
			
			var game = '';
			
			$('input.game').each(function() {
				
				if($(this).prop('checked') == true) {
					
					game = $(this).val();
					
				}
				
			});
			
			var initialize = {
				'action' : 'loadPromotion',
				'amount' : $('input.amount').val(),
				'game' : game
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'transaction_request_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('select.promotion').html(response.response);
					
				}
				
			});
			
		}
		
		
		/* Document children method */
		this.numberFormat = function(data) {
			
			var number = {
				'result' : '',
				'temporary' : data.value.replace(/,/g , '')
			};
			
			number.temporary = number.temporary.split('.');
			number.temporary[0] = number.temporary[0].split('');
			var index = {
				'key' : 0,
				'loop' : number.temporary[0].length - 1
			}
			var separator = 3;
			
			for(i = index.loop; i >= 0; i--) {
				
				if(index.key == separator) {
					
					number.result = ','+number.result;
					separator = separator + 3;
					
				}
				
				number.result = number.temporary[0][i]+number.result;
				
				index.key++;
				
			}
			
			if(number.temporary[1] != null) {
				
				number.result = number.result+'.'+number.temporary[1];
				
			}
			
			return number.result;
			
		}
		
		
		/* Document children method */
		this.updateTransactionRequest = function() {
			
			if($('select.type').val() == 'Deposit') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'status' : this.checkStatus(),
					'toBank' : this.checkToBank(),
					'toBankAccount' : this.checkToBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Withdrawal') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBank' : this.checkFromBank(),
					'fromBankAccount' : this.checkFromBankAccount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'status' : this.checkStatus()
				};
				
			}
			
			var result = '';
			
			$.each(validation, function(key, value) {
				
				if(value == false) {
					
					result = false;
					
					return false;
					
				}
				
				else {
					
					result = true;
					
				}
				
			});
			
			if(result == true) {
				
				$('#loading').css({
					'display' : 'block'
				}).animate({
					'opacity' : 1
				}, 400);
				
				var game = '';
				
				$('input.game').each(function(key, value) {
					
					if($(this).prop('checked') == true) {
						
						game = $(this).val();
						
					}
					
				});
				
				var initialize = {
					'action' : 'updateTransactionRequest',
					'amount' : $('input.amount').val(),
					'fromBankAccount' : $('select.from-bank-account').val(),
					'game' : game,
					'id' : $('input.id').val(),
					'note' : $('textarea.note').val(),
					'player' : $('input.player').val(),
					'promotion' : $('select.promotion').val(),
					'status' : $('select.status').val(),
					'toBankAccount' : $('select.to-bank-account').val()
				};
				
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'transaction_request_entry_ajax/'
				}).done(function(response) {
					
					if(response.result == true) {
						
						$('#response').removeClass().addClass('success').html(response.response);
						$('input[type=text]').val('');
						
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
				
			}
			
			else {
				
				$('#response').removeClass().addClass('error').html('<p>Transaction request failed edited!</p>');
				
			}
			
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
	
	
	var transactionRequestEntry = new transactionRequestEntry();
	
	$('input.game').click(function() {
		
		transactionRequestEntry.checkGame();
		
		transactionRequestEntry.loadPlayer();
		
	});
	
	$('input.player').keyup(function() {
		
		transactionRequestEntry.checkPlayer();
		
	});
	
	$('select.type').click(function() {
		
		var initialize = {
			'type' : $(this).val()
		};
		transactionRequestEntry.initializeInput(initialize);
		
	});	
	
	$('input.amount').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = transactionRequestEntry.numberFormat(initialize);
		$(this).val(value);
		
	});	
	
	$('input.amount').keyup(function() {
		
		transactionRequestEntry.loadPromotion();
		
	});	
	
	$('select.from-bank').click(function() {
		
		var initialize = {
			'action' : 'loadFromBank'
		};
		transactionRequestEntry.loadBankAccount(initialize);
		
	});
	
	$('select.to-bank').click(function() {
		
		var initialize = {
			'action' : 'loadToBank'
		};
		transactionRequestEntry.loadBankAccount(initialize);
		
	});	
	
	$('button.insert').click(function() {
		
		transactionRequestEntry.insertTransactionRequest();
		
		return false;
		
	});	
	
	$('button.update').click(function() {
		
		transactionRequestEntry.updateTransactionRequest();
		
		return false;
		
	});
	
	
});