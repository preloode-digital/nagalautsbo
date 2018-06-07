$(document).ready(function() {
	
	
	function promotionEntry() {
		
		
		this.initialize = {
			'baseUrl' : $('#config').attr('data-base-url'),
			'panelUrl' : $('#config').attr('data-panel-url')
		};
		
		
		/* Document, insert promotion, update promotion children method */
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
		
		
		/* Document, insert promotion, update promotion children method */
		this.checkStatus = function() {
			
			if($('select.status').val() == '') {
				
				$('p.status').html('* Please select promotion status!');
				
				return false;
				
			}
			
			else {
				
				$('p.status').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document, insert promotion, update promotion children method */
		this.checkType = function() {
			
			if($('select.type').val() == '') {
				
				$('p.type').html('* Please select promotion type!');
				
				return false;
				
			}
			
			else {
				
				$('p.type').html('');
				
				return true;
				
			}
			
		}
		
		
		/* Document children method */
		this.insertPromotion = function() {
			
			var validation = {
				'name' : this.checkName(),
				'status' : this.checkStatus(),
				'type' : this.checkType()
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
				
				var game = [];
				
				$('input.game').each(function() {
					
					if($(this).prop('checked') == true) {
						
						game.push($(this).val());
						
					}
					
				});
				
				var initialize = {
					'action' : 'insertPromotion',
					'cap' : $('input.cap').val(),
					'description' : CKEDITOR.instances['ckeditor'].getData(),
					'game' : game,
					'minimumDeposit' : $('input.minimum-deposit').val(),
					'name' : $('input.name').val(),
					'percentage' : $('input.percentage').val(),
					'picture' : $('input.picture').val(),
					'rollover' : $('input.rollover').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val(),
					'type' : $('select.type').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'promotion_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Promotion failed added!</p>');
				
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
		this.numberFormat = function(data) {
			
			var number = {
				'result' : '',
				'temporary' : data.value.replace(/,/g , '')
			};
			
			number.temporary = number.temporary.split('.');
			number.temporary[0] = number.temporary[0].split('');
			var index = {
				'key' : 0,
				'loop' : number.temporary[0].length - 1
			}
			var separator = 3;
			
			for(i = index.loop; i >= 0; i--) {
				
				if(index.key == separator) {
					
					number.result = ','+number.result;
					separator = separator + 3;
					
				}
				
				number.result = number.temporary[0][i]+number.result;
				
				index.key++;
				
			}
			
			if(number.temporary[1] != null) {
				
				number.result = number.result+'.'+number.temporary[1];
				
			}
			
			return number.result;
			
		}
		
		
		/* Document children method */
		this.updatePromotion = function() {
			
			var validation = {
				'name' : this.checkName(),
				'status' : this.checkStatus(),
				'type' : this.checkType()
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
				
				var game = [];
				
				$('input.game').each(function() {
					
					if($(this).prop('checked') == true) {
						
						game.push($(this).val());
						
					}
					
				});
				
				var initialize = {
					'action' : 'updatePromotion',
					'cap' : $('input.cap').val(),
					'description' : CKEDITOR.instances['ckeditor'].getData(),
					'game' : game,
					'id' : $('input.id').val(),
					'minimumDeposit' : $('input.minimum-deposit').val(),
					'name' : $('input.name').val(),
					'picture' : $('input.picture').val(),
					'percentage' : $('input.percentage').val(),
					'rollover' : $('input.rollover').val(),
					'sequence' : $('input.sequence').val(),
					'status' : $('select.status').val(),
					'type' : $('select.type').val()
				};
				$.ajax({
					'cache' : false,
					'data' : initialize,
					'dataType' : 'json',
					'method' : 'POST',
					'url' : this.initialize.panelUrl+'promotion_entry_ajax/'
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
				
				$('#response').removeClass().addClass('error').html('<p>Promotion failed edited!</p>');
				
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
				'url' : this.initialize.panelUrl+'promotion_entry_ajax/'
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
	
	
	var promotionEntry = new promotionEntry();	
	
	CKEDITOR.replace('ckeditor');
	
	$('input.name').keyup(function() {
		
		promotionEntry.checkName();
		
	});
	
	$('input.cap').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = promotionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});
	
	$('input.minimum-deposit').keyup(function() {
		
		var initialize = {
			'value' : $(this).val()
		};
		var value = promotionEntry.numberFormat(initialize);
		$(this).val(value);
		
	});
	
	$('input.picture-file').change(function(event) {
		
		var initialize = {
			'file' : event.target.files
		};
		promotionEntry.uploadPicture(initialize);
		
	});	
	
	$('input.picture').click(function() {
		
		$('input.picture-file').click();
		
	});
	
	$('select.type').change(function() {
		
		promotionEntry.checkType();
		
	});
	
	$('select.status').change(function() {
		
		promotionEntry.checkStatus();
		
	});
	
	$('button.insert').click(function() {
		
		promotionEntry.insertPromotion();
		
		return false;
		
	});
	
	$('button.update').click(function() {
		
		promotionEntry.updatePromotion();
		
		return false;
		
	});
	
	
});