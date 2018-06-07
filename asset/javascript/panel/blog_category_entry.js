$(document).ready(function() {
	
	
	function blogCategoryEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert blog category, update blog category children method */
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
		
		
		/* Document, insert bank, update bank children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select bank status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertBlogCategory = function() {
			
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
				
				var initialize = {
					'action' : 'insertBlogCategory',
					'description' : $('textarea.description').val(),
					'metaDescription' : $('textarea.meta-description').val(),
					'metaKeyword' : $('input.meta-keyword').val(),
					'metaTitle' : $('input.meta-title').val(),
					'name' : $('input.name').val(),
					'parent' : $('select.parent').val(),
					'status' : $('select.status').val(),
					'url' : $('input.url').val()
				};				
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'blog_category_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Blog category failed added!</p>');
				
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
		this.updateBlogCategory = function() {
			
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
				
				var initialize = {
					'action' : 'updateBlogCategory',
					'description' : $('textarea.description').val(),
					'id' : $('input.id').val(),
					'metaDescription' : $('textarea.meta-description').val(),
					'metaKeyword' : $('input.meta-keyword').val(),
					'metaTitle' : $('input.meta-title').val(),
					'name' : $('input.name').val(),
					'parent' : $('select.parent').val(),
					'status' : $('select.status').val(),
					'url' : $('input.url').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'blog_category_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Blog category failed edited!</p>');
				
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
	
	
	var blogCategoryEntry = new blogCategoryEntry();
		
	$('input.name').keyup(function() {
		
		blogCategoryEntry.checkName();
		
	});
	
	
	$('select.status').change(function() {
		
		blogCategoryEntry.checkStatus();
		
	});
	
	
	$('button.insert').click(function() {
		
		blogCategoryEntry.insertBlogCategory();
		
		return false;
		
	});
	
	
	$('button.update').click(function() {
		
		blogCategoryEntry.updateBlogCategory();
		
		return false;
		
	});
	
	
});