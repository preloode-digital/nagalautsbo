$(document).ready(function() {
	
	
	function register() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url')
		}
		
		
		/* Register children method */
		this.checkBank = function() {
			
			if($('select.bank').val() == '') {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan pilih bank!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Register children method */
		this.checkBankAccountNumber = function() {
			
			if(!$('input.bank-account-number').val().match(/^[0-9]+$/) || $('input.bank-account-number').val().length < 9) {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan nomor rekening yang valid!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({	
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Register children method */
		this.checkEmail = function() {
			
			if(!$('input.email').val().match(/^([0-9A-Za-z_\-\.]){1,}\@([0-9A-Za-z_\-\.]){1,}\.([A-Za-z]){2,}$/)) {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan email yang valid!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Register children method */
		this.checkGame = function() {
			
			if($('select.game').val() == '') {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan pilih game!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Register children method */
		this.checkName = function() {
			
			if($('input.name').val().length < 2) {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan minimal 2 karakter!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Register children method */
		this.checkPhone = function() {
			
			if(!$('input.phone').val().match(/^[0-9]+$/) || $('input.phone').val().length < 9 || $('input.phone').val().length > 13) {
				
				$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan nomor hp yang valid!</p>');
				$('#response').css({
					'display' : 'block'
				});
				$('#response').animate({
					'opacity' : 1
				}, 400);
				
				return false;
				
			}
			
			else {
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.register = function() {
			
			var baseUrl = this.initialize.baseUrl;
			
			var validation = {
				'bank' : this.checkBank(),
				'bankAccountNumber' : this.checkBankAccountNumber(),
				'email' : this.checkEmail(),
				'game' : this.checkGame(),
				'name' : this.checkName(),
				'phone' : this.checkPhone()
			};
			
			var valid = true;
			
			$.each(validation, function(key, value) {
				
				if(value == false) {
					
					valid = false;
					
					return false;
					
				}
				
			});
			
			if(valid == true) {
				
				var initialize = {
					'action' : 'register',
					'bank' : $('select.bank').val(),
					'bankAccountNumber' : $('input.bank-account-number').val(),
					'email' : $('input.email').val(),
					'game' : $('select.game').val(),
					'name' : $('input.name').val(),
					'phone' : $('input.phone').val(),
					'reference' : $('input.reference').val()
				}
				$.ajax({
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.baseUrl+'register_ajax/'
				}).done(function(response) {
					
					if(response.result == true) {
						
						window.location.replace(baseUrl);
						
					}
					
					else {
						
						$('#response').removeClass().addClass('error').html(response.response);
						
					}
					
				});
				
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
				
			}, 3000);
			
		}
		
		
	}
	
	
	var register = new register();
	
	$('button.register').click(function() {
		
		register.register();
		
		return false;
		
	});
	
	
});