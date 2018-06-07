$(document).ready(function() {
	
	
	function settingSliderEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert slider, update slider children method */
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
		
		
		/* Document, insert slider, update slider children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select slider status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertSlider = function() {
			
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
					'action' : 'insertSlider',
					'alternativeText' : $('input.alternative-text').val(),
					'name' : $('input.name').val(),
					'picture' : $('input.picture').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'setting_slider_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Slider failed added!</p>');
				
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
		this.updateSlider = function() {
			
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
					'action' : 'updateSlider',
					'alternativeText' : $('input.alternative-text').val(),
					'id' : $('input.id').val(),
					'name' : $('input.name').val(),
					'picture' : $('input.picture').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'setting_slider_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Slider failed edited!</p>');
				
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
				'url' : this.initialize.panelUrl+'setting_slider_entry_ajax/'
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
	
	
	var settingSliderEntry = new settingSliderEntry();	
	
	$('input.name').keyup(function() {
		
		settingSliderEntry.checkName();
		
	});
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		settingSliderEntry.uploadPicture(initialize);
		
	});	
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.status').change(function() {
		
		settingSliderEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		settingSliderEntry.insertSlider();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		settingSliderEntry.updateSlider();
		
		return false;
		
	});
	
	
});