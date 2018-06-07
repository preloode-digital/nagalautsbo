$(document).ready(function() {
	
	
	function administratorRole() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.deleteAdministratorRole = function(data) {
			
			var panelUrl = this.initialize.panelUrl;
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'deleteAdministratorRole',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'administrator_role_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					data.element.remove();
					
				}
				
				else {
					
					window.location.replace(panelUrl+'restricted_access/');
					
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
				
			}, 3000);
			
		}
		
		
		/* Document children method */
		this.loadAdministratorRoleDetail = function(data) {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var initialize = {
				'action' : 'loadAdministratorRoleDetail',
				'id' : data.id
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'administrator_role_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#mCSB_1_container').html(response.response);
					$('#popup').css({
						'display' : 'block'
					});
					$('#popup').animate({
						'opacity' : 1
					}, 400);
					$('#popup').find('div.wrapper').animate({
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
				
			});
			
		}
		
		
	}
	
	
	var administratorRole = new administratorRole();
	
	$('td.load-detail').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-administrator-role-id')
		};
		administratorRole.loadAdministratorRoleDetail(initialize);
		
	});
	
	$('button.delete').click(function() {
		
		var initialize = {
			'id' : $(this).attr('data-administrator-role-id'),
			'element' : $(this).parent().parent()
		};
		administratorRole.deleteAdministratorRole(initialize);
		
		return false;
		
	});
	
	
});