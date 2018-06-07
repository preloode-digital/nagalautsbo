$(document).ready(function() {
	
	
	function galleryEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url'),
			'source' : '',
			'video' : ''
		};
		
		
		/* Document, insert gallery, update gallery children method */
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
		
		
		/* Document, insert gallery, update gallery children method */
		this.checkPicture = function() {
			
			var video = $('input.video').val().split('.com');
			
			if(video.length < 2) {
				
				video = $('input.video').val().split('.co');
				
			}
			
			if(video[0] != 'http://www.mp4upload' && video[0] != 'https://openload' && video[0] != 'https://www.rapidvideo' && video[0] != 'https://streamcherry' && video[0] != 'https://streamango.com/' && video[0] != 'https://www.youtube' && video[0] != 'https://m.youtube') {
				
				$('p.video').html('* Please enter a valid video!');
				
				return false;
				
			}
			
			else {
				
				if(video[0] == 'http://www.mp4upload') {
					
					this.video = video[1].replace('/', '');
					this.source = 'Mp4upload';
					
				}
				
				else if(video[0] == 'https://openload') {
					
					this.video = video[1].split('/');
					this.video = this.video[2];
					this.source = 'Openload';
					
				}
				
				else if(video[0] == 'https://www.rapidvideo') {
					
					this.video = video[1].split('/');
					this.video = this.video[2];
					this.source = 'Rapidvideo';
					
				}
				
				else if(video[0] == 'https://streamcherry' || video[0] == 'https://streamango.com/') {
					
					this.video = video[1].split('/');
					this.video = id[2];
					
					if(video[0] == 'https://streamcherry') {
						
						this.source = 'Streamcherry';
						
					}
					
					else {
						
						this.source = 'Streamango';
						
					}
					
				}
				
				else if(video[0] == 'https://www.youtube' || video[0] == 'https://m.youtube') {
					
					this.video = video[1].replace('/watch?v=', '');
					this.source = 'Youtube';
					
				}
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert gallery, update gallery children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select gallery status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertGallery = function() {
			
			var validation = {
				'name' : checkName(),
				'picture' : checkPicture(),
				'status' : checkStatus()
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
					'action' : 'insertGallery',
					'name' : $('input.name').val(),
					'picture' : $('input.picture').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val(),
					'video' : $('input.video').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'gallery_entry_ajax/'
				}).done(function(response) {
					
					if(response.result == true) {
						
						$('#response').removeClass().addClass('success').html(response.response);
						$('input[type=text]').val('');
						
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
				
				$('#response').removeClass().addClass('error').html('Gallery failed added!');
				
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
		this.updateGallery = function() {
			
			var validation = {
				'name' : checkName(),
				'picture' : checkPicture(),
				'status' : checkStatus()
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
					'action' : 'updateGallery',
					'id' : $('input.id').val(),
					'name' : $('input.name').val(),
					'picture' : $('input.picture').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val(),
					'video' : $('input.video').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'gallery_entry_ajax/'
				}).done(function(response) {
					
					if(response.result == true) {
						
						$('#response').removeClass().addClass('success').html(response.response);
						
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
				
				$('#response').removeClass().addClass('error').html('Gallery failed edited!');
				
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
				'url' : this.initialize.panelUrl+'gallery_entry_ajax/'
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
	
	
	var galleryEntry = new galleryEntry();
	
	$('input.name').keyup(function() {
		
		galleryEntry.checkName();
		
	});
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		galleryEntry.uploadPicture(initialize);
		
	});
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.status').change(function() {
		
		galleryEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		galleryEntry.insertGallery();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		galleryEntry.updateGallery();
		
		return false;
		
	});
	
	
});