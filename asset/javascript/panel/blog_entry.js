$(document).ready(function() {
	
	
	function blogEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert blog, update blog children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select blog status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert blog, update blog children method */
		this.checkTitle = function() {
			
			if($('input.title').val().length < 2) {
				
				$('p.title').html('* Please enter at least 2 characters!');
				
				return false;
				
			}
			
			else {
				
				$('p.title').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertBlog = function() {
			
			var validation = {
				'status' : this.checkStatus(),
				'title' : this.checkTitle()
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
					'action' : 'insertBlog',
					'category' : $('select.category').val(),
					'content' : CKEDITOR.instances['ckeditor'].getData(),
					'description' : $('textarea.description').val(),
					'metaDescription' : $('textarea.meta-description').val(),
					'metaKeyword' : $('input.meta-keyword').val(),
					'metaTitle' : $('input.meta-title').val(),
					'picture' : $('input.picture').val(),
					'status' : $('select.status').val(),
					'title' : $('input.title').val(),
					'url' : $('input.url').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'blog_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Blog article failed added!</p>');
				
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
		this.updateBlog = function() {
			
			var validation = {
				'status' : this.checkStatus(),
				'title' : this.checkTitle()
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
					'action' : 'updateBlog',
					'category' : $('select.category').val(),
					'content' : CKEDITOR.instances['ckeditor'].getData(),
					'description' : $('textarea.description').val(),
					'id' : $('input.id').val(),
					'metaDescription' : $('textarea.meta-description').val(),
					'metaKeyword' : $('input.meta-keyword').val(),
					'metaTitle' : $('input.meta-title').val(),
					'picture' : $('input.picture').val(),
					'status' : $('select.status').val(),
					'title' : $('input.title').val(),
					'url' : $('input.url').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'blog_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Blog article failed edited!</p>');
				
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
				'url' : this.initialize.panelUrl+'blog_entry_ajax/'
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
	
	
	var blogEntry = new blogEntry();	
	
	CKEDITOR.replace('ckeditor');
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		blogEntry.uploadPicture(initialize);
		
	});
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.status').change(function() {
		
		blogEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		blogEntry.insertBlog();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		blogEntry.updateBlog();
		
		return false;
		
	});
	
	
});