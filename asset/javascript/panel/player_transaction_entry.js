$(document).ready(function() {
	
	
	function playerTransactionEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkDate = function() {
			
			if($('input.date').val() > 0) {
				
				$('p.date').html('* Please input a valid date!');
				
				return false;
				
			}
			
			else {
				
				$('p.date').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkPlayer = function() {
			
			if($('input.player-username').val().length < 3) {
				
				$('p.player-username').html('* Please enter at least 3 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.player-username').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkPoint = function() {
			
			if($('input.point').val() < 0) {
				
				$('p.point').html('* Please enter a valid point!');
				
				return false;
				
			}
			
			else {
				
				$('p.point').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkRake = function() {
			
			if($('input.rake').val() < 0) {
				
				$('p.rake').html('* Please enter a valid rake!');
				
				return false;
				
			}
			
			else {
				
				$('p.rake').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkStake = function() {
			
			if($('input.stake').val() < 0) {
				
				$('p.stake').html('* Please enter a valid stake!');
				
				return false;
				
			}
			
			else {
				
				$('p.stake').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player transaction, update player transaction children method */
		this.checkWinlose = function() {
			
			if($('input.winlose').val() < 0) {
				
				$('p.winlose').html('* Please enter a valid win/lose!');
				
				return false;
				
			}
			
			else {
				
				$('p.winlose').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertPlayerTransaction = function() {
			
			var validation = {
				'date' : this.checkDate(),
				'player' : this.checkPlayer(),
				'point' : this.checkPoint(),
				'rake' : this.checkRake(),
				'stake' : this.checkStake(),
				'winlose' : this.checkWinlose()
			};
			
			var valid = true;
			
			$.each(validation, function(key, value) {
				
				if(value == false) {
					
					valid = false;
					
					return false;
					
				}
				
			});
			
			if(valid == true) {
				
				$('#loading').css({
					'display' : 'block'
				}).animate({
					'opacity' : 1
				}, 400);
				
				var initialize = {
					'action' : 'insertPlayerTransaction',
					'date' : $('input.date').val(),
					'player' : $('input.player-username').val(),
					'point' : $('input.point').val(),
					'rake' : $('input.rake').val(),
					'stake' : $('input.stake').val(),
					'winlose' : $('input.winlose').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'player_transaction_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Player transaction failed added!</p>');
				
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
		this.loadPlayer = function() {
			
			var initialize = {
				'action' : 'loadPlayer'
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'player_transaction_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					var player = [];
					
					$.each(response.response, function(key, value) {
						
						player.push(value);
						
					});
					
					$('input.player-username').autocomplete({
						source : player
					});
					
				}
				
			});
			
		}
		
		
		/* Document children method */
		this.loadPlayerId = function() {
			
			var initialize = {
				'action' : 'loadPlayerId',
				'username' : $('input.player-username').val()
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'player_transaction_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('input.player-id').val(response.response);
					
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
		this.updatePlayerTransaction = function() {
			
			var validation = {
				'date' : this.checkDate(),
				'player' : this.checkPlayer(),
				'point' : this.checkPoint(),
				'rake' : this.checkRake(),
				'stake' : this.checkStake(),
				'winlose' : this.checkWinlose()
			};
			
			var valid = true;
			
			$.each(validation, function(key, value) {
				
				if(value == false) {
					
					valid = false;
					
					return false;
					
				}
				
			});
			
			if(valid == true) {
				
				$('#loading').css({
					'display' : 'block'
				}).animate({
					'opacity' : 1
				}, 400);
				
				var initialize = {
					'action' : 'updatePlayerTransaction',
					'date' : $('input.date').val(),
					'id' : $('input.id').val(),
					'player' : $('input.player-username').val(),
					'point' : $('input.point').val(),
					'rake' : $('input.rake').val(),
					'stake' : $('input.stake').val(),
					'winlose' : $('input.winlose').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'player_transaction_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Player transaction failed edited!</p>');
				
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
	
	
	var playerTransactionEntry = new playerTransactionEntry();
		
	playerTransactionEntry.loadPlayer();
		
	$('input.player-username').keyup(function() {
		
		playerTransactionEntry.loadPlayerId();
		
	});
		
	$('input.stake').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = playerTransactionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});	
	
	$('input.winlose').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = playerTransactionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});	
	
	$('input.rake').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = playerTransactionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});	
	
	$('input.point').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = playerTransactionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});	
	
	$('input.stake').change(function() {
		
		playerTransactionEntry.checkStake();
		
	});
		
	$('input.winlose').change(function() {
		
		playerTransactionEntry.checkWinlose();
		
	});
		
	$('input.rake').change(function() {
		
		playerTransactionEntry.checkRake();
		
	});
		
	$('input.point').change(function() {
		
		playerTransactionEntry.checkPoint();
		
	});	
	
	$('button.insert').click(function() {
		
		playerTransactionEntry.insertPlayerTransaction();
		
		return false;
		
	});	
	
	$('button.update').click(function() {
		
		playerTransactionEntry.updatePlayerTransaction();
		
		return false;
		
	});
	
	
});