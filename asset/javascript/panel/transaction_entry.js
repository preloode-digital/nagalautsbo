$(document).ready(function() {
	
	
	function transactionEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
		
		
		/* Document, insert transaction, update transaction children method */
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
				
				$('div.checkbox').css({
					'display' : 'block'
				});
				$('div.checkbox').animate({
					'opacity' : 1
				}, 400);
				
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
				
				$('.player').css({
					'display' : 'block'
				});
				$('.player').animate({
					'opacity' : 1
				}, 400);
				
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
			
			else if(data.type == 'Expense' || data.type == 'Withdraw') {
				
				if(data.type == 'Withdraw') {
					
					$('div.checkbox').css({
						'display' : 'block'
					});
					$('div.checkbox').animate({
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
					
					$('.player').css({
						'display' : 'block'
					});
					$('.player').animate({
						'opacity' : 1
					}, 400);
					
				}
				
				else {
					
					$('div.checkbox').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('div.checkbox').css({
							'display' : 'none'
						});
						
					});
					
					$('.game').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('.game').css({
							'display' : 'none'
						});
						
					});
					
					$('div.item').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('div.item').css({
							'display' : 'none'
						});
						
					});
					
					$('.player').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('.player').css({
							'display' : 'none'
						});
						
					});
					
				}
				
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
			
			else if(data.type == 'Adjustment' || data.type == 'Inject From Deposit' || data.type == 'Inject From Saving' || data.type == 'Saving') {
				
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
				
				$('div.checkbox').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('div.checkbox').css({
						'display' : 'none'
					});
					
				});
				
				$('.game').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.game').css({
						'display' : 'none'
					});
					
				});
				
				$('div.item').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('div.item').css({
						'display' : 'none'
					});
					
				});
				
				$('.player').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.player').css({
						'display' : 'none'
					});
					
				});
				
				$('.promotion').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('.promotion').css({
						'display' : 'none'
					});
					
				});
				
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
			
			if(data.type != '') {
				
				$('.amount').css({
					'display' : 'block'
				});
				$('.amount').animate({
					'opacity' : 1
				}, 400);
				
				$('.button').css({
					'display' : 'block'
				});
				$('.button').animate({
					'opacity' : 1
				}, 400);
				
				$('.note').css({
					'display' : 'block'
				});
				$('.note').animate({
					'opacity' : 1
				}, 400);
				
			}
			
		}
		
		
		/* Document children method */
		this.insertTransaction = function() {
			
			if($('select.type').val() == 'Deposit') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'toBank' : this.checkToBank(),
					'toBankAccount' : this.checkToBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Expense') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBankAccount' : this.checkFromBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving' || $('select.type').val() == 'Saving' || $('select.type').val() == 'Adjustment') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBank' : this.checkFromBank(),
					'fromBankAccount' : this.checkFromBankAccount(),
					'toBank' : this.checkToBank(),
					'toBankAccount' : this.checkToBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Withdraw') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'fromBank' : this.checkFromBank(),
					'fromBankAccount' : this.checkFromBankAccount()
				};
				
			}
			
			var result = '';
			
			if($('select.type').val() == 'Adjustment') {
				
				if(validation.amount == true && validation.fromBank == true && validation.fromBankAccount == true && validation.website == true) {
					
					result = true;
					
				}
				
				else if(validation.amount == true && validation.toBank == true && validation.toBankAccount == true && validation.website == true) {
					
					result = true;
					
				}
				
				else {
					
					result = false;
					
				}
				
			}
			
			else {
				
				$.each(validation, function(key, value) {
					
					if(value == false) {
						
						result = false;
						
						return false;
						
					}
					
					else {
						
						result = true;
						
					}
					
				});
				
			}
			
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
				
				if($('select.type').val() == 'Adjustment') {
					
					var initialize = {
						'action' : 'insertAdjustment',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'note' : $('textarea.note').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
				}
				
				else if($('select.type').val() == 'Deposit') {
					
					var initialize = {
						'action' : 'insertDeposit',
						'amount' : $('input.amount').val(),
						'game' : game,
						'player' : $('input.player').val(),
						'note' : $('textarea.note').val(),
						'promotion' : $('select.promotion').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
				}
				
				else if($('select.type').val() == 'Expense') {
					
					var initialize = {
						'action' : 'insertExpense',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'note' : $('textarea.note').val()
					};
					
				}
				
				else if($('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving' || $('select.type').val() == 'Saving') {
					
					var initialize = {
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'note' : $('textarea.note').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
					if($('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving') {
						
						initialize.action = 'insertInject';
						
					}
					
					else {
						
						initialize.action = 'insertSaving';
						
					}
					
				}
				
				else if($('select.type').val() == 'Withdraw') {
					
					var initialize = {
						'action' : 'insertWithdraw',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'game' : game,
						'player' : $('input.player').val(),
						'note' : $('textarea.note').val()
					};
					
				}
				
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'transaction_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Transaction failed added!</p>');
				
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
				'url' : this.initialize.panelUrl+'transaction_entry_ajax/'
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
				'url' : this.initialize.panelUrl+'transaction_entry_ajax/'
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
				'url' : this.initialize.panelUrl+'transaction_entry_ajax/'
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
		this.updateTransaction = function() {
			
			if($('select.type').val() == 'Deposit') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'game' : this.checkGame(),
					'player' : this.checkPlayer(),
					'toBank' : this.checkToBank(),
					'toBankAccount' : this.checkToBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Expense') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBankAccount' : this.checkFromBankAccount()
				};
				
			}
			
			else if($('select.type').val() == 'Adjustment' || $('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving' || $('select.type').val() == 'Saving') {
				
				var validation = {
					'amount' : this.checkAmount(),
					'fromBank' : this.checkFromBank(),
					'fromBankAccount' : this.checkFromBankAccount(),
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
					'player' : this.checkPlayer()
				};
				
			}
			
			var result = '';
			
			if($('select.type').val() == 'Adjustment') {
				
				if(validation.amount == true && validation.fromBank == true && validation.fromBankAccount == true && validation.website == true) {
					
					result = true;
					
				}
				
				else if(validation.amount == true && validation.toBank == true && validation.toBankAccount == true && validation.website == true) {
					
					result = true;
					
				}
				
				else {
					
					result = false;
					
				}
				
			}
			
			else {
				
				$.each(validation, function(key, value) {
					
					if(value == false) {
						
						result = false;
						
						return false;
						
					}
					
					else {
						
						result = true;
						
					}
					
				});
				
			}
			
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
				
				if($('select.type').val() == 'Adjustment') {
					
					var initialize = {
						'action' : 'updateAdjustment',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'id' : $('input.id').val(),
						'note' : $('textarea.note').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
				}
				
				else if($('select.type').val() == 'Deposit') {
					
					var initialize = {
						'action' : 'updateDeposit',
						'amount' : $('input.amount').val(),
						'game' : game,
						'id' : $('input.id').val(),
						'note' : $('textarea.note').val(),
						'player' : $('input.player').val(),
						'promotion' : $('select.promotion').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
				}
				
				else if($('select.type').val() == 'Expense') {
					
					var initialize = {
						'action' : 'updateExpense',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'id' : $('input.id').val(),
						'note' : $('textarea.note').val()
					};
					
				}
				
				else if($('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving' || $('select.type').val() == 'Saving') {
					
					var initialize = {
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'id' : $('input.id').val(),
						'note' : $('textarea.note').val(),
						'toBankAccount' : $('select.to-bank-account').val()
					};
					
					if($('select.type').val() == 'Inject From Deposit' || $('select.type').val() == 'Inject From Saving') {
						
						initialize.action = 'updateInject';
						
					}
					
					else {
						
						initialize.action = 'updateSaving';
						
					}
					
				}
				
				else if($('select.type').val() == 'Withdraw') {
					
					var initialize = {
						'action' : 'updateWithdraw',
						'amount' : $('input.amount').val(),
						'fromBankAccount' : $('select.from-bank-account').val(),
						'game' : game,
						'id' : $('input.id').val(),
						'note' : $('textarea.note').val(),
						'player' : $('input.player').val()
					};
					
				}
				
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'transaction_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Transaction failed edited!</p>');
				
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
	
	
	var transactionEntry = new transactionEntry();
	
	$('input.game').click(function() {
		
		transactionEntry.checkGame();
		
		transactionEntry.loadPlayer();
		
	});
	
	$('input.player').keyup(function() {
		
		transactionEntry.checkPlayer();
		
	});
	
	$('select.type').click(function() {
		
		var initialize = {
			'type' : $(this).val()
		};
		transactionEntry.initializeInput(initialize);
		
	});
	
	$('input.amount').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = transactionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});
	
	$('input.amount').keyup(function() {
		
		transactionEntry.loadPromotion();
		
	});
	
	$('select.from-bank').click(function() {
		
		var initialize = {
			'action' : 'loadFromBank'
		};
		transactionEntry.loadBankAccount(initialize);
		
	});
	
	$('select.to-bank').click(function() {
		
		var initialize = {
			'action' : 'loadToBank'
		};
		transactionEntry.loadBankAccount(initialize);
		
	});
	
	$('button.insert').click(function() {
		
		transactionEntry.insertTransaction();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		transactionEntry.updateTransaction();
		
		return false;
		
	});
	
	
});