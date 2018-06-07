$(document).ready(function() {
	
	
	baseUrl = $('#config').attr('base-url');
	
	
});


/* Input amount, insert withdrawal children function */
function checkAmount() {
	
	if($('input.amount').val().length < 1) {
		
		$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan jumlah withdrawal!</p>');
		
		return false;
		
	}
	
	else {
		
		return true;
		
	}
	
}


/* Button withdraw children function */
function insertWithdrawal() {
	
	var validation = {
		'amount' : checkAmount()
	};
	
	var result = false;
	
	$.each(validation, function(key, value) {
		
		if(value == false) {
			
			result = false;
			
			return false;
			
		}
		
		else {
			
			result = true;
			
		}
		
	});
	
	if(result == true) {
		
		$('#loading').css({
			'display' : 'block'
		}).animate({
			'opacity' : 1
		}, 400);
		
		var initialize = {
			'action' : 'insertWithdrawal',
			'amount' : $('input.amount').val(),
			'bankAccountName' : $('input.bank-account-name').val(),
			'bankAccountNumber' : $('input.bank-account-number').val(),
		};
		
		$.ajax({
			'cache' : false,
			'data' : initialize,
			'dataType' : 'json',
			'method' : 'POST',
			'url' : baseUrl+'withdrawal_ajax/'
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
		
		$('#response').removeClass().addClass('error').html('<p>Permintaan withdrawal gagal!</p>');
		
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


$(document).ready(function() {
	
	
	$('div.tabs').tabs();
	
	
	$('input.amount').change(function() {
		
		checkAmount();
		
	});
	
	
	$('button.withdraw').click(function() {
		
		insertWithdrawal();
		
		return false;
		
	});
	
	
});