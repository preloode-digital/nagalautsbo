$(document).ready(function() {
	
	
	function playerEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert player, update player children method */
		this.checkBank = function() {
			
			if($('select.bank').val() == '') {
				
				$('p.bank').html('* Please select player bank!');
				
				return false;
				
			}
			
			else {
				
				$('p.bank').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkBankAccountName = function() {
			
			if($('input.bank-account-name').val().length < 2) {
				
				$('p.bank-account-name').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.bank-account-name').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkBankAccountNumber = function() {
			
			if($('input.bank-account-number').val().length < 10) {
				
				$('p.bank-account-number').html('* Please enter a valid bank account number!');
				
				return false;
				
			}
			
			else {
				
				$('p.bank-account-number').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkConfirmPassword = function() {
			
			if(!$('input.confirm-password').val().match($('input.password').val())) {
				
				$('p.confirm-password').html('* Your password doesn\'t match!');
				
				return false;
				
			}
			
			else {
				
				$('p.confirm-password').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkEmail = function() {
			
			if(!$('input.email').val().match(/^([0-9A-Za-z_\-\.]){1,}\@([0-9A-Za-z_\-\.]){1,}\.([A-Za-z]){2,}$/)) {
				
				$('p.email').html('* Please enter valid email!');
				
				return false;
				
			}
			
			else {
				
				$('p.email').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkFirstName = function() {
			
			if($('input.first-name').val().length < 2) {
				
				$('p.first-name').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.first-name').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkGender = function() {
			
			if($('select.gender').val() == '') {
				
				$('p.gender').html('* Please select your gender!');
				
				return false;
				
			}
			
			else {
				
				$('p.gender').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkLastName = function() {
			
			if($('input.last-name').val().length != '' && $('input.last-name').val().length < 2) {
				
				$('p.last-name').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.last-name').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children function */
		this.checkMiddleName = function() {
			
			if($('input.middle-name').val().length != '' && $('input.middle-name').val().length < 2) {
				
				$('p.middle-name').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.middle-name').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkPassword = function() {
			
			if($('input.password').val().length < 3) {
				
				$('p.password').html('<span style="color : #ff4a43">* Please enter at least 3 characters!</span>');
				
				return false;
				
			}
			
			else if($('input.password').val().match(/^[A-Z]+$/) || $('input.password').val().match(/^[a-z]+$/) || $('input.password').val().match(/^[0-9]+$/) || $('input.password').val().match(/^[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/)) {
				
				$('p.password').html('<span style="color : #ff4a43">* Low security password!</span>');
				
				return true;
				
			}
			
			else if($('input.password').val().match(/^[A-Za-z]+$/) || $('input.password').val().match(/^[0-9A-Z]+$/) || $('input.password').val().match(/^[0-9a-z]+$/) || $('input.password').val().match(/^[A-Z-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/) || $('input.password').val().match(/^[a-z-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/) || $('input.password').val().match(/^[0-9-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/)) {
				
				$('p.password').html('<span style="color : #ffc100">* Medium security password!</span>');
				
				return true;
				
			}
			
			else if($('input.password').val().match(/^[0-9A-Za-z]+$/) || $('input.password').val().match(/^[A-Za-z-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/) || $('input.password').val().match(/^[0-9A-Z-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/) || $('input.password').val().match(/^[0-9a-z-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]+$/)) {
				
				$('p.password').html('<span style="color : #a2d200">* High security password!</span>');
				
				return true;
				
			}
			
			else {
				
				$('p.password').html('<span style="color : #418bca">* Strong security password!</span>');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children function */
		this.checkPhone = function() {
			
			if(!$('input.phone').val().match(/^[0-9]+$/) || $('input.phone').val().length < 9 || $('input.phone').val().length > 11) {
				
				$('p.phone').html('* Please enter valid mobile phone number!');
				
				return false;
				
			}
			
			else {
				
				$('p.phone').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select player status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert player, update player children method */
		this.checkUsername = function() {
			
			if($('input.username').val().length < 3) {
				
				$('p.username').html('* Please enter at least 3 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.username').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertPlayer = function() {
			
			var validation = {
				'bank' : this.checkBank(),
				'bankAccountName' : this.checkBankAccountName(),
				'bankAccountNumber' : this.checkBankAccountNumber(),
				'email' : this.checkEmail(),
				'firstName' : this.checkFirstName(),
				'gender' : this.checkGender(),
				'password' : this.checkPassword(),
				'phone' : this.checkPhone(),
				'status' : this.checkStatus(),
				'username' : this.checkUsername()
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
				
				var game = {
					'credit' : [],
					'id' : []
				};
				
				$('input.game-id').each(function(key, value) {
					
					game.id.push($(this).val());
					
				});
				
				$('input.game-credit').each(function(key, value) {
					
					game.credit.push($(this).val());
					
				});
				
				var initialize = {
					'action' : 'insertPlayer',
					'bank' : $('select.bank').val(),
					'bankAccountName' : $('input.bank-account-name').val(),
					'bankAccountNumber' : $('input.bank-account-number').val(),
					'email' : $('input.email').val(),
					'firstName' : $('input.first-name').val(),
					'game' : game,
					'gender' : $('select.gender').val(),
					'lastName' : $('input.last-name').val(),
					'middleName' : $('input.middle-name').val(),
					'password' : $('input.password').val(),
					'phone' : $('input.phone').val(),
					'picture' : $('input.picture').val(),
					'status' : $('select.status').val(),
					'username' : $('input.username').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'player_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Player failed added!</p>');
				
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
		this.updatePlayer = function() {
			
			var validation = {
				'bank' : this.checkBank(),
				'bankAccountName' : this.checkBankAccountName(),
				'bankAccountNumber' : this.checkBankAccountNumber(),
				'email' : this.checkEmail(),
				'firstName' : this.checkFirstName(),
				'gender' : this.checkGender(),
				'password' : this.checkPassword(),
				'phone' : this.checkPhone(),
				'status' : this.checkStatus(),
				'username' : this.checkUsername()
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
				
				var game = {
					'credit' : [],
					'id' : []
				};
				
				$('input.game-id').each(function(key, value) {
					
					game.id.push($(this).val());
					
				});
				
				$('input.game-credit').each(function(key, value) {
					
					game.credit.push($(this).val());
					
				});
				
				var initialize = {
					'action' : 'updatePlayer',
					'bank' : $('select.bank').val(),
					'bankAccountName' : $('input.bank-account-name').val(),
					'bankAccountNumber' : $('input.bank-account-number').val(),
					'email' : $('input.email').val(),
					'firstName' : $('input.first-name').val(),
					'game' : game,
					'gender' : $('select.gender').val(),
					'id' : $('input.id').val(),
					'lastName' : $('input.last-name').val(),
					'middleName' : $('input.middle-name').val(),
					'password' : $('input.password').val(),
					'phone' : $('input.phone').val(),
					'picture' : $('input.picture').val(),
					'status' : $('select.status').val(),
					'username' : $('input.username').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'player_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Player failed edited!</p>');
				
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
		this.uploadPicture = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = new FormData();
			initialize.append('action', 'uploadPicture');
			
			$.each(data.file, function(key, value) {
				
				initialize.append('file[]', value);
				
			});
			
			$.ajax({
				xhr : function(event) {
					
					xhr = new window.XMLHttpRequest();
					
					xhr.upload.addEventListener("progress", function(event) {
						
						if(event.lengthComputable) {
							
							var percentage = (event.loaded / event.total) * 100;
							$('div.picture-progress').find('span').css({
								'width' : percentage+'%'
							});
							
						}
						
					}, false);
					
					xhr.addEventListener("progress", function(event) {
						
						if(event.lengthComputable) {
							
							var percentage = (event.loaded / event.total) * 100;
							$('div.picture-progress').find('span').css({
								'width' : percentage+'%'
							});
							
						}
						
					}, false);
					
					return xhr;
					
				},
				'cache' : false,
				'contentType' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'processData' : false,
				'url' : this.initialize.panelUrl+'player_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					$('input.picture').val(response.picture);
					
					$('#loading').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('#loading').css({
							'display' : 'none'
						});
						
					});
					
				}
				
				else {
					
					$('#response').removeClass().addClass('error').html(response.response);
					
				}
				
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
	
	
	var playerEntry = new playerEntry();
		
	$('input.username').keyup(function() {
		
		playerEntry.checkUsername();
		
	});
	
	$('input.password').keyup(function() {
		
		playerEntry.checkPassword();
		
	});
	
	$('input.confirm-password').keyup(function() {
		
		playerEntry.checkConfirmPassword();
		
	});
	
	$('input.first-name').keyup(function() {
		
		playerEntry.checkFirstName();
		
	});
	
	$('input.middle-name').keyup(function() {
		
		playerEntry.checkMiddleName();
		
	});
	
	$('input.last-name').keyup(function() {
		
		playerEntry.checkLastName();
		
	});
	
	$('select.gender').change(function() {
		
		playerEntry.checkGender();
		
	});
	
	$('input.email').keyup(function() {
		
		playerEntry.checkEmail();
		
	});
	
	$('input.phone').keyup(function() {
		
		playerEntry.checkPhone();
		
	});
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		playerEntry.uploadPicture(initialize);
		
	});
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.bank').change(function() {
		
		playerEntry.checkBank();
		
	});
	
	$('input.bank-account-name').keyup(function() {
		
		playerEntry.checkBankAccountName();
		
	});
	
	$('input.bank-account-number').keyup(function() {
		
		playerEntry.checkBankAccountNumber();
		
	});
	
	$('select.status').change(function() {
		
		playerEntry.checkStatus();
		
	});
	
	$('input.game-credit').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = playerEntry.numberFormat(initialize);
		$(this).val(value);
		
	});
	
	
	$('button.insert').click(function() {
		
		playerEntry.insertPlayer();
		
		return false;
		
	});
	
	
	$('button.update').click(function() {
		
		playerEntry.updatePlayer();
		
		return false;
		
	});
	
	
});