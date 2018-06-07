$(document).ready(function() {
	
	
	function bankAccountEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert bank account, update bank account children method */
		this.checkBank = function() {
			
			if($('select.bank').val() == '') {
				
				$('p.bank').html('* Please select bank account bank!');
				
				return false;
				
			}
			
			else {
				
				$('p.bank').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert bank account, update bank account children method */
		this.checkName = function() {
			
			if($('input.name').val().length < 2) {
				
				$('p.name').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.name').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert bank account, update bank account children method */
		this.checkNumber = function() {
			
			if($('input.number').val().length < 10) {
				
				$('p.number').html('* Please enter a valid bank account number!');
				
				return false;
				
			}
			
			else {
				
				$('p.number').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert bank account, update bank account children method */
		this.checkType = function() {
			
			if($('select.type').val() == '') {
				
				$('p.type').html('* Please select bank account type!');
				
				return false;
				
			}
			
			else {
				
				$('p.type').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert bank account, update bank account children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select bank account status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertBankAccount = function() {
			
			var validation = {
				'bank' : this.checkBank(),
				'name' : this.checkName(),
				'number' : this.checkNumber(),
				'status' : this.checkStatus(),
				'type' : this.checkType(),
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
					'action' : 'insertBankAccount',
					'balance' : $('input.balance').val(),
					'bank' : $('select.bank').val(),
					'name' : $('input.name').val(),
					'number' : $('input.number').val(),
					'status' : $('select.status').val(),
					'type' : $('select.type').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'bank_account_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Bank account failed added!</p>');
				
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
		this.updateBankAccount = function() {
			
			var validation = {
				'bank' : this.checkBank(),
				'name' : this.checkName(),
				'number' : this.checkNumber(),
				'status' : this.checkStatus(),
				'type' : this.checkType(),
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
					'action' : 'updateBankAccount',
					'balance' : $('input.balance').val(),
					'bank' : $('select.bank').val(),
					'id' : $('input.id').val(),
					'name' : $('input.name').val(),
					'number' : $('input.number').val(),
					'status' : $('select.status').val(),
					'type' : $('select.type').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'bank_account_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Bank account failed edited!</p>');
				
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
	
	
	var bankAccountEntry = new bankAccountEntry();
	
	$('input.name').keyup(function() {
		
		bankAccountEntry.checkName();
		
	});
	
	$('input.number').keyup(function() {
		
		bankAccountEntry.checkNumber();
		
	});
	
	$('select.bank').change(function() {
		
		bankAccountEntry.checkBank();
		
	});
	
	$('input.balance').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = bankAccountEntry.numberFormat(initialize);
		$(this).val(value);
		
	});
	
	$('select.type').change(function() {
		
		bankAccountEntry.checkType();
		
	});
	
	$('select.status').change(function() {
		
		bankAccountEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		bankAccountEntry.insertBankAccount();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		bankAccountEntry.updateBankAccount();
		
		return false;
		
	});
	
	
});