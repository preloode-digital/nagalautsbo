$(document).ready(function() {
	
	
	baseUrl = $('#config').attr('base-url');
	
	
});


function loadBlog(data) {
	
	if(send == true) {
		
		send = false;
		
		initialize = {
			'action' : 'loadBlog',
			'categoryId' : data.categoryId,
			'offset' : data.offset
		}
		$.ajax({
			'cache' : false,
			'data' : initialize,
			'dataType' : 'json',
			'method' : 'POST',
			'url' : baseUrl+'blog_ajax/'
		}).done(function(response) {
			
			if(response.result == true) {
				
				$('div.blog').append(response.response);
				$('p.load-blog').attr('offset', response.offset);
				
			}
			
			else {
				
				$('div.load').css({
					'display' : 'none'
				});
				
			}
			
		});
		
	}
	
}


function toggleCategory(data) {
	
	if(data.element.css('display') == 'none') {
		
		data.element.css({
			'display' : 'block'
		});
		data.element.animate({
			'opacity' : 1
		}, 400);
		
	}
	
	else {
		
		data.element.animate({
			'opacity' : 0
		}, 400, function() {
			
			data.element.css({
				'display' : 'none'
			});
			
		});
		
	}
	
}


$(document).ready(function() {
	
	
	send = true;
	
	
	$('p.load-category').click(function() {
		
		var initialize = {
			'element' : $(this).next()
		};
		toggleCategory(initialize);
		
	});
	
	
	$('p.load-blog').click(function() {
		
		var initialize = {
			'categoryId' : $(this).attr('data-category-id'),
			'offset' : $(this).attr('data-offset')
		};
		loadBlog(initialize);
		
	});
	
	
});