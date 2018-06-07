<?php
$view = array(
	'option' => array(
		'bank' => '',
		'game' => ''
	)
);

if(!empty($data['bank']['data'])) {
	
	foreach($data['bank']['data'] as $key => $value) {
		
		$view['option']['bank'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}

if(!empty($data['game']['data'])) {
	
	foreach($data['game']['data'] as $key => $value) {
		
		$view['option']['game'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}
?>


<div id="content" class="section">
	<div class="wrapper">
    	<h2 class="title xxxl-font">Registrasi</h2>
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
                <p class="title">Email<span>*</span></br><span>Valid Email</span></p>
                <input class="email" name="email" type="text" placeholder="Email">
                <div class="clearfix"></div>
            </div>
            <div class="grid">
            	<p class="title">Handphone<span>*</span></br><span>Nomor Telepon Anda</span></p>
                <input class="phone" name="phone" type="text" placeholder="Nomor Telepon">
                <div class="clearfix"></div>
                <p class="title">Permainan Anda<span>*</span></p>
                <select class="game" name="game">
                	<option value="">Pilih Permainan Anda</option>
                	<?php echo $view['option']['game'] ?>
                </select>
                <div class="clearfix"></div>
                <p class="title">Referensi<span></span></br><span>User ID Teman Anda</span></p>
                <input class="reference" name="reference" type="text" placeholder="Referensi">
                <div class="clearfix"></div>
                <p class="note">*Konfirmasi kembali ke CS kami untuk mendapatkan User ID permainan.</p>
            </div>
            <div class="clearfix"></div>
            <button class="register m-font" name="register" type="submit">Submit Form</button>
        </form>
    </div>
</div>