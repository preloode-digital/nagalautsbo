$(document).ready(function() {
	
	
	function login() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.backward = function() {
			
			baseUrl = this.initialize.baseUrl;
			
			$('p.response').html('');
			$('input.password').val('');
			
			var width = $('input.password').width();
			$('input.password').animate({
				'margin-left' : width+'px',
				'opacity' : 0
			}, 400);
			$('input.username').animate({
				'margin-left' : 0,
				'opacity' : 1
			}, 400, function() {
				
				$('img.user').attr('src', baseUrl+'asset/image/panel/administrator/administrator_picture.png');
				$('div.name').html('Guest');
				$('i.back').css({
					'display' : 'none'
				});
				
			});
			$('button.login').animate({
				'opacity' : 0
			}, 400, function() {
				
				$('button.login').css({
					'display' : 'none'
				});
				
			});
			$('button.next').animate({
				'opacity' : 1
			}, 400);
			
		}
		
		
		/* Document children method */
		this.checkPassword = function() {
			
			$('#loading').css({
				'display' : 'block'
			});
			$('#loading').animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'checkPassword',
				'username' : $('input.username').val(),
				'password' : $('input.password').val()
			}
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'login_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('form').submit();
					
				}
				
				else {
					
					$('input.password').css({
						'background' : 'rgba(255, 74, 67, 0.2)'
					});
					$('#response').removeClass().addClass('error').html(response.response);
					$('#response').css({
						'display' : 'block'
					});
					$('#response').animate({
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
				
				setTimeout(function() {
					
					$('#response').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('#response').css({
							'display' : 'none'
						});
						
					});
					
				}, 3000);
				
			});
			
		}
		
		
		/* Document children method */
		this.checkUsername = function() {
			
			$('#loading').css({
				'display' : 'block'
			});
			$('#loading').animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'checkUsername',
				'username' : $('input.username').val()
			}
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'login_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					var width = $('input.username').width();
					$('input.username').animate({
						'margin-left' : '-'+width+'px',
						'opacity' : 0
					}, 400);
					$('input.password').animate({
						'margin-left' : 0,
						'opacity' : 1
					}, 400, function() {
						
						$('img.user').attr('src', response.picture);
						$('div.name').html(response.name);
						$('i.back').css({
							'display' : 'inline-block'
						});
						
					});
					$('button.next').animate({
						'opacity' : 0
					}, 400);
					$('button.login').css({
						'display' : 'block'
					});
					$('button.login').animate({
						'opacity' : 1
					}, 400);
					
				}
				
				else if(response.result == 'Pending') {
					
					$('input.username').css({
						'background' : 'rgba(252, 75, 108, 0.2)'
					});
					$('#response').removeClass().addClass('error').html(response.response);
					$('#response').css({
						'display' : 'block'
					});
					$('#response').animate({
						'opacity' : 1
					}, 400);
					
				}
				
				else if(response.result == false) {
					
					$('input.username').css({
						'background' : 'rgba(252, 75, 108, 0.2)'
					});
					$('#response').removeClass().addClass('error').html(response.response);
					$('#response').css({
						'display' : 'block'
					});
					$('#response').animate({
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
				
				setTimeout(function() {
					
					$('#response').animate({
						'opacity' : 0
					}, 400, function() {
						
						$('#response').css({
							'display' : 'none'
						});
						
					});
					
				}, 3000);
				
			});
			
		}
		
		
		/* Document children method */
		this.setLoginLayout = function() {
			
			var height = window.innerHeight - $('#footer').outerHeight();
			
			if($('div.login').outerHeight() < height) {
				
				var margin = (height - $('div.login').outerHeight()) / 2;
				$('div.login').css({
					'margin' : margin+'px auto 20px auto'
				});
				var height = $('div.login').outerHeight() + $('#footer').outerHeight() + margin + 20;
				
				if(window.innerHeight > height) {
					
					margin = window.innerHeight - height + 20;
					$('div.login').css({
						'margin-bottom' : margin+'px'
					});
					
				}
				
			}
			
			else {
				
				$('div.login').removeAttr('style');
				
			}
			
		}
		
		
	}
	
	
	var login = new login();
	
	login.setLoginLayout();
		
	$('input.username').keyup(function(event) {
		
		if(event.key != 'Enter') {
			
			$(this).css({
				'background' : 'none'
			});
			
		}
		
	});
	
	$('input.username').keypress(function(event) {
		
		if(event.key == 'Enter') {
			
			login.checkUsername();
			
			return false;
			
		}
		
	});
	
	$('button.next').click(function() {
		
		login.checkUsername();
		
		return false;
		
	});
	
	$('input.password').keyup(function(event) {
		
		if(event.key != 'Enter') {
			
			$(this).css({
				'background' : 'none'
			});
			
		}
		
	});
	
	$('input.password').keypress(function(event) {
		
		if(event.key == 'Enter') {
			
			login.checkPassword();
			
			return false;
			
		}
		
	});
	
	$('button.login').click(function() {
		
		login.checkPassword();
		
		return false;
		
	});
	
	$('i.back').click(function() {
		
		login.backward();
		
	});
	
	$(window).resize(function() {
		
		login.setLoginLayout();
		
	});
	
	
});