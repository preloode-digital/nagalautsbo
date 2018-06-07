$(document).ready(function() {
	
	
	function settingRule() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document children method */
		this.updateRule = function() {
			
			$('#loading').css({
				'display' : 'block'
			}).animate({
				'opacity' : 1
			}, 400);
			
			var description = [];
			
			$('input.description').each(function() {
				
				description.push($(this).val());
				
			});
			
			var metaDescription = [];
			
			$('input.meta-description').each(function() {
				
				metaDescription.push($(this).val());
				
			});
			
			var metaKeyword = [];
			
			$('input.meta-keyword').each(function() {
				
				metaKeyword.push($(this).val());
				
			});
			
			var metaTitle = [];
			
			$('input.meta-title').each(function() {
				
				metaTitle.push($(this).val());
				
			});
			
			var ogDescription = [];
			
			$('input.og-description').each(function() {
				
				ogDescription.push($(this).val());
				
			});
			
			var ogTitle = [];
			
			$('input.og-title').each(function() {
				
				ogTitle.push($(this).val());
				
			});
			
			var title = [];
			
			$('input.title').each(function() {
				
				title.push($(this).val());
				
			});
			
			var initialize = {
				'action' : 'updateRule',
				'content' : CKEDITOR.instances['ckeditor'].getData(),
				'description' : description,
				'metaDescription' : metaDescription,
				'metaKeyword' : metaKeyword,
				'metaTitle' : metaTitle,
				'ogDescription' : ogDescription,
				'ogTitle' : ogTitle,
				'title' : title
			};
			$.ajax({
				'cache' : false,
				'data' : initialize,
				'dataType' : 'json',
				'method' : 'POST',
				'url' : this.initialize.panelUrl+'setting_rule_ajax/'
			}).done(function(response) {
				
				if(response.result == true) {
					
					$('#response').removeClass().addClass('success').html(response.response);
					
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
	
	
	var settingRule = new settingRule();
		
	CKEDITOR.replace('ckeditor');
	
	$('button.update').click(function() {
		
		settingRule.updateRule();
		
		return false;
		
	});
	
	
});