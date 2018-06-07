$(document).ready(function() {
	
	
	baseUrl = $('#config').attr('base-url');
	
	
});


/* Input amount, request deposit children function */
function checkAmount() {
	
	if($('input.amount').val().length < 1) {
		
		$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan jumlah deposit!</p>');
		
		return false;
		
	}
	
	else {
		
		return true;
		
	}
	
}


/* Input date, insert deposit children function */
function checkDate() {
	
	if($('input.date-deposit').val().length < 1) {
		
		$('#response').removeClass().addClass('error').html('<p>* Silahkan masukan tanggal & waktu deposit!</p>');
		
		return false;
		
	}
	
	else {
		
		return true;
		
	}
	
}

	
/* Button deposit children function */
function insertDeposit() {
	
	var validation = {
		'amount' : checkAmount(),
		'date' : checkDate()
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
			'action' : 'insertDeposit',
			'amount' : $('input.amount').val(),
			'bankAccount' : '',
			'date' : $('input.date').val(),
			'paymentMethod' : $('p.item-selected').attr('data-value'),
			'reference' : $('input.reference').val()
		};
		
		$('input.bank-account').each(function(key, value) {
			
			if($(this).prop('checked') == true) {
				
				initialize.bankAccount = $(this).val();
				
			}
			
		});
		
		$.ajax({
			'cache' : false,
			'data' : initialize,
			'dataType' : 'json',
			'method' : 'POST',
			'url' : baseUrl+'deposit_ajax/'
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
		
		$('#response').removeClass().addClass('error').html('<p>Permintaan deposit gagal!</p>');
		
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
	
	
	$('p.payment-method').click(function() {
		
		$('p.payment-method').removeClass('item-selected');
		$(this).addClass('item-selected');
		
	});
	
	
	$('input.amount').change(function() {
		
		checkAmount();
		
	});
	
	
	$('input.date').change(function() {
		
		checkDate();
		
	});
	
	
	$('button.deposit').click(function() {
		
		insertDeposit();
		
		return false;
		
	});
	
	
});