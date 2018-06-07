$(document).ready(function() {
	
	
	function administratorEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url'),
			'privilege' : {
				'administrator' : '',
				'bank' : '',
				'bankAccount' : '',
				'blog' : '',
				'gallery' : '',
				'game' : '',
				'player' : '',
				'promotion' : '',
				'report' : '',
				'setting' : '',
				'transaction' : ''
			}
		};
		
		
		/* Document, insert administrator, update administrator children method */
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
		
		
		/* Document, insert administrator, update administrator children method */
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
		
		
		/* Document, insert administrator, update administrator children method */
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
		
		
		/* Document, insert administrator, update administrator children method */
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
		
		
		/* Document, insert administrator, update administrator children function */
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
		
		
		/* Document, insert administrator, update administrator children method */
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
		
		
		/* Document, insert administrator, update administrator children method */
		this.checkPrivilege = function() {
			
			var privilege = this.initialize.privilege;
			
			$('input.privilege-administrator').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.administrator += 7;
					
				}
				
				else {
					
					privilege.administrator += 0;
					
				}
				
			});
			
			$('input.privilege-bank').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.bank += 7;
					
				}
				
				else {
					
					privilege.bank += 0;
					
				}
				
			});
			
			$('input.privilege-bank-account').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.bankAccount += 7;
					
				}
				
				else {
					
					privilege.bankAccount += 0;
					
				}
				
			});
			
			$('input.privilege-blog').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.blog += 7;
					
				}
				
				else {
					
					privilege.blog += 0;
					
				}
				
			});
			
			$('input.privilege-gallery').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.gallery += 7;
					
				}
				
				else {
					
					privilege.gallery += 0;
					
				}
				
			});
			
			$('input.privilege-game').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.game += 7;
					
				}
				
				else {
					
					privilege.game += 0;
					
				}
				
			});
			
			$('input.privilege-player').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.player += 7;
					
				}
				
				else {
					
					privilege.player += 0;
					
				}
				
			});
			
			$('input.privilege-promotion').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.promotion += 7;
					
				}
				
				else {
					
					privilege.promotion += 0;
					
				}
				
			});
			
			$('input.privilege-report').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.report += 7;
					
				}
				
				else {
					
					privilege.report += 0;
					
				}
				
			});
			
			$('input.privilege-setting').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.setting += 7;
					
				}
				
				else {
					
					privilege.setting += 0;
					
				}
				
			});
			
			$('input.privilege-transaction').each(function() {
				
				if($(this).prop('checked') == true) {
					
					privilege.transaction += 7;
					
				}
				
				else {
					
					privilege.transaction += 0;
					
				}
				
			});
			
			this.initialize.privilege = privilege;
			
		}
		
		
		/* Document, insert administrator, update administrator children method */
		this.checkRole = function() {
			
			if($('select.role').val() == '') {
				
				$('p.role').html('* Please select administrator role!');
				
				return false;
				
			}
			
			else {
				
				$('p.role').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert administrator, update administrator children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select administrator status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert administrator, update administrator children method */
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
		this.insertAdministrator = function() {
			
			var validation = {
				'confirmPassword' : this.checkConfirmPassword(),
				'firstName' : this.checkFirstName(),
				'gender' : this.checkGender(),
				'password' : this.checkPassword(),
				'role' : this.checkRole(),
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
				
				this.checkPrivilege();
				
				var initialize = {
					'action' : 'insertAdministrator',
					'administratorRoleId' : $('select.role').val(),
					'firstName' : $('input.first-name').val(),
					'gender' : $('select.gender').val(),
					'lastName' : $('input.last-name').val(),
					'middleName' : $('input.middle-name').val(),
					'password' : $('input.password').val(),
					'picture' : $('input.picture').val(),
					'privilege' : this.initialize.privilege,
					'status' : $('select.status').val(),
					'username' : $('input.username').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'administrator_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Administrator failed added!</p>');
				
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
		this.loadSinglePrivilege = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadSinglePrivilege',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'administrator_entry_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					var privilege = {
						'administrator' : response.response.privilege_administrator.split(''),
						'bank' : response.response.privilege_bank.split(''),
						'bankAccount' : response.response.privilege_bank_account.split(''),
						'blog' : response.response.privilege_blog.split(''),
						'gallery' : response.response.privilege_gallery.split(''),
						'game' : response.response.privilege_game.split(''),
						'player' : response.response.privilege_player.split(''),
						'promotion' : response.response.privilege_promotion.split(''),
						'report' : response.response.privilege_report.split(''),
						'setting' : response.response.privilege_setting.split(''),
						'transaction' : response.response.privilege_transaction.split('')
					};
					
					$('input.privilege-administrator').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.administrator[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-bank').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.bank[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-bank-account').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.bankAccount[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-blog').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.blog[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-gallery').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.gallery[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-game').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.game[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-player').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.player[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-promotion').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.promotion[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-report').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.report[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-setting').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.setting[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
					$('input.privilege-transaction').each(function() {
						
						var index = $(this).attr('data-index') - 1;
						
						if(privilege.transaction[index] > 0) {
							
							$(this).prop('checked', 'checked');
							
						}
						
						else {
							
							$(this).removeProp('checked');
							
						}
						
					});
					
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
		
		
		/* Document children method */
		this.updateAdministrator = function() {
			
			var validation = {
				'confirmPassword' : this.checkConfirmPassword(),
				'firstName' : this.checkFirstName(),
				'gender' : this.checkGender(),
				'password' : this.checkPassword(),
				'role' : this.checkRole(),
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
				
				this.checkPrivilege();
				
				var initialize = {
					'action' : 'updateAdministrator',
					'administratorRoleId' : $('select.role').val(),
					'firstName' : $('input.first-name').val(),
					'gender' : $('select.gender').val(),
					'id' : $('input.id').val(),
					'lastName' : $('input.last-name').val(),
					'middleName' : $('input.middle-name').val(),
					'password' : $('input.password').val(),
					'picture' : $('input.picture').val(),
					'privilege' : this.initialize.privilege,
					'status' : $('select.status').val(),
					'username' : $('input.username').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'administrator_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Administrator failed edited!</p>');
				
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
				'url' : this.initialize.panelUrl+'administrator_entry_ajax/'
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
	
	
	var administratorEntry = new administratorEntry();
	
	$('input.username').keyup(function() {
		
		administratorEntry.checkUsername();
		
	});
	
	$('input.password').keyup(function() {
		
		administratorEntry.checkPassword();
		
	});
	
	$('input.confirm-password').keyup(function() {
		
		administratorEntry.checkConfirmPassword();
		
	});
		
	$('input.first-name').keyup(function() {
		
		administratorEntry.checkFirstName();
		
	});	
	
	$('input.middle-name').keyup(function() {
		
		administratorEntry.checkMiddleName();
		
	});	
	
	$('input.last-name').keyup(function() {
		
		administratorEntry.checkLastName();
		
	});	
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		administratorEntry.uploadPicture(initialize);
		
	});	
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.gender').change(function() {
		
		administratorEntry.checkGender();
		
	});
	
	$('select.role').change(function() {
		
		administratorEntry.checkRole();
		
		var initialize = {
			'id' : $(this).val()
		};
		administratorEntry.loadSinglePrivilege(initialize);
		
	});	
	
	$('select.status').change(function() {
		
		administratorEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		administratorEntry.insertAdministrator();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		administratorEntry.updateAdministrator();
		
		return false;
		
	});
	
	
});