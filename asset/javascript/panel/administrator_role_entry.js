$(document).ready(function() {
	
	
	function administratorRoleEntry() {
		
		
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
				'transaction' : '',
				'website' : ''
			}
		};
		
		
		/* Document, insert administrator role, update administrator role children method */
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
		
		
		/* Document, insert administrator role, update administrator role children method */
		this.checkPrivilege = function() {
			
			var privilege = this.initialize.privilege;
			
			$('input.privilege-administrator').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.administrator += 7;
					
				}
				
				else {
					
					privilege.administrator += 0;
					
				}
				
			});
			
			$('input.privilege-bank').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.bank += 7;
					
				}
				
				else {
					
					privilege.bank += 0;
					
				}
				
			});
			
			$('input.privilege-bank-account').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.bankAccount += 7;
					
				}
				
				else {
					
					privilege.bankAccount += 0;
					
				}
				
			});
			
			$('input.privilege-blog').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.blog += 7;
					
				}
				
				else {
					
					privilege.blog += 0;
					
				}
				
			});
			
			$('input.privilege-gallery').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.gallery += 7;
					
				}
				
				else {
					
					privilege.gallery += 0;
					
				}
				
			});
			
			$('input.privilege-game').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.game += 7;
					
				}
				
				else {
					
					privilege.game += 0;
					
				}
				
			});
			
			$('input.privilege-player').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.player += 7;
					
				}
				
				else {
					
					privilege.player += 0;
					
				}
				
			});
			
			$('input.privilege-promotion').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.promotion += 7;
					
				}
				
				else {
					
					privilege.promotion += 0;
					
				}
				
			});
			
			$('input.privilege-report').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.report += 7;
					
				}
				
				else {
					
					privilege.report += 0;
					
				}
				
			});
			
			$('input.privilege-setting').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.setting += 7;
					
				}
				
				else {
					
					privilege.setting += 0;
					
				}
				
			});
			
			$('input.privilege-transaction').each(function(key, value) {
				
				if($(this).prop('checked') == true) {
					
					privilege.transaction += 7;
					
				}
				
				else {
					
					privilege.transaction += 0;
					
				}
				
			});
			
			this.initialize.privilege = privilege;
			
		}
		
		
		/* Document, insert administrator role, update administrator role children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select administrator role status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertAdministratorRole = function() {
			
			var validation = {
				'name' : this.checkName(),
				'status' : this.checkStatus()
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
					'action' : 'insertAdministratorRole',
					'name' : $('input.name').val(),
					'privilege' : this.initialize.privilege,
					'status' : $('select.status').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'administrator_role_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Administrator role failed edited!</p>');
				
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
		this.updateAdministratorRole = function() {
			
			var validation = {
				'name' : this.checkName(),
				'status' : this.checkStatus()
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
					'action' : 'updateAdministratorRole',
					'name' : $('input.name').val(),
					'id' : $('input.id').val(),
					'privilege' : this.initialize.privilege,
					'status' : $('select.status').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'administrator_role_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Administrator role failed edited!</p>');
				
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
	
	
	var administratorRoleEntry = new administratorRoleEntry();
	
	$('input.name').keyup(function() {
		
		administratorRoleEntry.checkName();
		
	});
		
	$('select.status').change(function() {
		
		administratorRoleEntry.checkStatus();
		
	});
		
	$('button.insert').click(function() {
		
		administratorRoleEntry.insertAdministratorRole();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		administratorRoleEntry.updateAdministratorRole();
		
		return false;
		
	});
	
	
});