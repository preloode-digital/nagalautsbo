$(document).ready(function() {
	
	
	function global() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url'),
			'send' : true
		};
		
		
		/* Document children method */
		this.accountToggle = function() {
			
			if($('ul.account').css('display') == 'none') {
				
				$('ul.account').css({
					'display' : 'block'
				});
				$('ul.account').animate({
					'opacity' : 1
				}, 400);
				
			}
			
			else {
				
				$('ul.account').animate({
					'opacity' : 0
				}, 400, function() {
					
					$('ul.account').css({
						'display' : 'none'
					});
					
				});
				
			}
			
		}
		
		
		/* Document children method */
		this.closePopup = function() {
			
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
			
		}
		
		
		/* Document children function */
		this.getNotification = function() {
			
			var panelUrl = this.initialize.panelUrl;
			var send = this.initialize.send;
			var timer = 0;
			
			if($('tr.transaction-request').length > 0) {
				
				$('#notification').trigger('play');
				
			}
			
			setInterval(function() {
				
				if(send == true) {
					
					var now = $.now();
					var differenceTime = now - timer;
					var offset = 0;
					
					if(window.location.href == panelUrl) {
						
						$('tr.transaction-request').each(function(key, value) {
							
							offset = parseInt($(this).attr('data-transaction-request-id'));
							
							return false;
							
						});
						
					}
					
					var notification = {
						'action' : 'getNotification',
						'offset' : offset
					}
					$.ajax({
						'cache' : false,
						'data' : notification,
						'dataType' : 'json',
						'method' : 'POST',
						'url' : panelUrl+'notification_ajax/'
					}).done(function(response) {
						
						if(response.result == true) {
							
							$('span.notification').removeAttr('style').html(response.response);
							
							if(differenceTime > 30000) {
								
								$('#notification').trigger('play');
								
								timer = now;
								
							}
							
							if(window.location.href == panelUrl) {
								
								if(response.transactionRequest != '') {
									
									$('div.transaction-request').removeAttr('style');
									$('div.transaction-request').find('h3').remove();
									$(response.transactionRequest).insertAfter('tr.transaction-request-title');
									
								}
								
							}
							
						}
						
						else {
							
							$('span.notification').css({
								'background' : 'none'
							});
							
						}
						
						send = true;
						
					});
					
				}
				
			}, 5000);
			
			this.initialize.send = send;
			
		}
		
		
		/* Document children method */
		this.logout = function() {
			
			$('#loading').css({
				'display' : 'block'
			});
			$('#loading').animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'logout'
			}
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'login_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					window.location.replace(this.initialize.panelUrl);
					
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
		
		
		/* Document children method */
		this.menuToggle = function(data) {
			
			$('.child-menu').each(function(key, value) {
				
				if($(this).attr('data-index') == data.index) {
					
					if($(this).css('display') == 'none') {
						
						$(this).css({
							'display' : 'block'
						});
						$(this).animate({
							'opacity' : 1
						}, 400);
						
					}
					
					else {
						
						$(this).animate({
							'opacity' : 0
						}, 400, function() {
							
							$(this).css({
								'display' : 'none'
							});
							
						});
						
					}
					
				}
				
			});
			
			$('p.toggle').each(function(key, value) {
				
				if($(this).attr('data-index') == data.index) {
					
					if($(this).css('transform') == 'none') {
						
						$(this).css({
							'transform' : 'rotate(90deg)'
						});
						
					}
					
					else {
						
						$(this).css({
							'transform' : 'none'
						});
						
					}
					
				}
				
			});
			
		}
		
		
		/* Document children function */
		this.setLayout = function() {
			
			var width = {
				'content' : $('body').prop('clientWidth') - $('#sidebar').outerWidth(),
				'sidebar' : $('#sidebar').outerWidth()
			}
			
			if(window.innerWidth > 1279) {
				
				$('#sidebar').css({
					'margin' : 0
				});
				$('#content').css({
					'margin' : '60px 0 0 '+width.sidebar+'px',
					'width' : width.content+'px'
				});
				
			}
			
			else {
				
				$('#sidebar').css({
					'margin' : '0 0 0 -'+width.sidebar+'px'
				});
				$('#content').removeAttr('style');
				
			}
			
			var index = 0;
			
			$.each($('ul.menu').find('a'), function() {
				
				if($(this).attr('href') == window.location.href) {
					
					$(this).parent().find('span').css({
						'width' : '100%'
					});
					
					if($(this).parent().hasClass('child-menu') == true) {
						
						index = $(this).parent().attr('data-index');
						
					}
					
				}
				
			});
			
			if(index > 0) {
				
				$.each($('.child-menu'), function() {
					
					if($(this).attr('data-index') == index) {
						
						$(this).css({
							'display' : 'block',
							'opacity' : 1
						});
						
					}
					
				});
				
				$.each($('p.toggle'), function() {
					
					if($(this).attr('data-index') == index) {
						
						$(this).css({
							'transform' : 'rotate(90deg)'
						});
						
					}
					
				});
				
			}
			
			var position = (window.innerHeight - $('#loading').find('div.wrapper').outerHeight()) / 2;
			$('#loading').find('div.wrapper').css({
				'margin' : position+'px auto 0 auto'
			});
			
			var margin = Number($('#popup').find('div.wrapper').css('marginTop').replace('px', '')) * 2;
			var padding = Number($('#popup').find('div.wrapper').find('div.popup').css('paddingTop').replace('px', '')) * 2;
			var height = window.innerHeight - (margin + padding);
			$('#popup').find('div.wrapper').find('div.popup').css({
				'max-height' : height+'px'
			});
			
		}
		
		
		/* Document children method */
		this.slideMenu = function() {
			
			var width = {
				'content' : $('body').prop('clientWidth') - $('#sidebar').outerWidth(),
				'sidebar' : $('#sidebar').outerWidth()
			}
			
			if($('#sidebar').css('margin-left') == '0px') {
				
				$('#sidebar').animate({
					'margin' : '0 0 0 -'+width.sidebar+'px'
				}, 600);
				
				if(window.innerWidth > 1279) {
					
					$('#content').animate({
						'margin' : '61px 0 0 0',
						'width' : '100%'
					}, 600);
					
				}
				
			}
			
			else {
				
				$('#sidebar').animate({
					'margin' : 0
				}, 600);
				
				if(window.innerWidth > 1279) {
					
					$('#content').animate({
						'margin' : '61px 0 0 '+width.sidebar+'px',
						'width' : width.content+'px'
					}, 600);
					
				}
				
			}
			
		}
		
		
	}
	
	
	var global = new global();
	
	global.setLayout();
	
	$('div.scrollbar').mCustomScrollbar({
	    'theme' : 'minimal-dark'
	});
	
	$('div.tab').tabs();
	
	$('input.date').datepicker({
		'dateFormat' : 'yy-mm-dd'
	});
	
	$('i.menu').click(function() {
		
		global.slideMenu();
		
	});
	
	$('i.menu-toggle').click(function() {
		
		var initialize = {
			'index' : $(this).parent().parent().attr('data-index')
		};
		global.menuToggle(initialize);
		
	});
	
	$('#account').click(function() {
		
		global.accountToggle();
		
	});
	
	$('p.notification').click(function() {
		
		if($('span.notification').html() != '') {
			
			global.loadNotification();
			
		}
		
	});
	
	$('button.logout').click(function() {
		
		global.logout();
		
		return false;
		
	});
	
	$('i.close-popup').click(function() {
		
		global.closePopup();
		
	});
	
	global.getNotification();
	
	$(window).resize(function() {
		
		global.setLayout();
		
	});
	
	
});