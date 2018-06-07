<?php
$view = array(
	'option' => array(
		'bankAccount' => '',
		'game' => ''
	),
	'history' => array(
		'list' => ''
	)
);

if(!empty($data['bankAccount']['data'])) {
	
	foreach($data['bankAccount']['data'] as $key => $value) {
		
		$bank = '';
		
		if(!empty($data['bank']['data'])) {
			
			for($i = 0; $i < count($data['bank']['data']); $i++) {
				
				if($data['bank']['data'][$i]['id'] == $value['bank_id']) {
					
					$bank = $data['bank']['data'][$i]['name'];
					
				}
				
			}
			
		}
		
		$view['option']['bankAccount'] .= '<tr>
			<td>
				<input class="bank-account" name="bank-account" type="radio" value="'.$value['id'].'"><p class="option-name">'.$bank.'</p>
			</td>
			<td>
				<p>'.$value['name'].'</p>
			</td>
			<td>
				<p>'.$value['number'].'</p>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['transaction']['request']['data'])) {
	
	foreach($data['transaction']['request']['data'] as $key => $value) {
		
		$bankAccount = array(
			'bankId' => '',
			'name' => '',
			'number' => ''
		);
		
		if(!empty($data['bankAccount']['data'])) {
			
			for($i = 0; $i < count($data['bankAccount']['data']); $i++) {
				
				if($data['bankAccount']['data'][$i]['id'] == $value['to_bank_account_id']) {
					
					$bankAccount = array(
						'bankId' => $data['bankAccount']['data'][$i]['bank_id'],
						'name' => $data['bankAccount']['data'][$i]['name'],
						'number' => $data['bankAccount']['data'][$i]['number']
					);
					
				}
				
			}
			
		}
		
		$bank = '';
		
		if(!empty($data['bank']['data'])) {
			
			for($i = 0; $i < count($data['bank']['data']); $i++) {
				
				if($data['bank']['data'][$i]['id'] == $bankAccount['bankId']) {
					
					$bank = $data['bank']['data'][$i]['name'];
					
				}
				
			}
			
		}
		
		$value['timestamp'] = new DateTime($value['timestamp']);
		
		$view['history']['list'] .= '<tr>
			<td><p>'.$value['timestamp']->format('j-m-Y').'</p></td>
			<td><p>'.$value['timestamp']->format('H.i').'</p></td>
			<td><p>'.$value['amount'].'</p></td>
			<td><p>'.$bank.' - '.$bankAccount['name'].' ('.$bankAccount['number'].')</p></td>
			<td><p>'.$value['status'].'</p></td>
		</tr>';
		
	}
	
}
?>


<div id="content" class="section">
	<div class="wrapper">
    	<h2 class="title xxxl-font">Deposit</h2>
        <p class="description">Mohon isi data anda dengan sebenarnya, untuk mempermudah proses deposit dan penarikan dengan cepat.</p>
        <form method="post" action="">
        	<div class="grid">
            	<p class="title">Nama<span>*</span></br><span>Sesuai Rekening</span></p>
                <input class="name" name="name" type="text" placeholder="Nama Sesuai Rekening">
                <div class="clearfix"></div>
                <p class="title">Nomor Rekening<span>*</span></p>
                <input class="bank-account-number" name="bank-account-number" type="text" placeholder="Nomor Rekening">
                <div class="clearfix"></div>
                <p class="title">Bank Anda<span>*</span></p>
                <select class="bank" name="bank">
                	<option value="">Pilih Bank</option>
                	<?php echo $view['option']['bank'] ?>
                </select>
                <div class="clearfix"></div>
            </div>
            <div class="grid">
            	<p class="title">Username / ID<span>*</span></p>
                <input class="username" name="username" type="text" placeholder="Username">
                <div class="clearfix"></div>
                <p class="title">Jumlah Deposit<span>*</span></p>
                <input class="amount" name="amount" type="text" placeholder="Jumlah Deposit">
                <div class="clearfix"></div>
                <p class="title">Permainan Anda<span>*</span></p>
                <select class="game" name="game">
                	<option value="">Pilih Permainan Anda</option>
                	<?php echo $view['option']['game'] ?>
                </select>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <p class="note">*Setelah mengisi data silahkan konfirmasi kembali ke CS kami. Terima Kasih.</p>
            <button class="deposit m-font" name="register" type="submit">Submit Form</button>
        </form>
    </div>
</div>