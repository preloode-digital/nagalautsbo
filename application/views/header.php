<?php
$view = array(
	'login' => array(
		'form' => '<input class="username" name="username" type="text" placeholder="Username">
		<input class="password" name="password" type="password" placeholder="Password">
		<button class="login" name="login" type="submit">Masuk</button>'
	),
	'register' => array(
		'button' => '<div class="register">
			<p class="forget-password">Lupa Password?</p>
			<a href="'.base_url().'register/"><p class="register">Daftar</p></a>
			<div class="clear"></div>
		</div>'
	)
);

if(!empty($data['account']['detail'])) {
	
	$view['login']['form'] = '<a href="'.base_url().'profile/"><p class="m-font"><i class="account-20-white"></i>'.$data['account']['detail'][0]['username'].'</p></a>
	<p class="m-font"><i class="wallet-20-white"></i>IDR '.$data['account']['detail'][0]['credit'].'</p>
	<button class="logout" name="logout" type="submit">Keluar</button>';
	$view['register']['button'] = '';
	
}
?>


<div id="wrapper">
	<div id="contact" class="section">
    	<div class="wrapper">
        	<div class="contact">
            	<p><i class="whatsapp-yellow square-30 margin-right-10"></i></p>
                <p><span class="m-font">Whatsapp</span></br>081293660523</p>
                <div class="clearfix"></div>
            </div>
            <div class="contact">
            	<p><i class="line-yellow square-30 margin-right-10"></i></p>
                <p><span class="m-font">Line</span></br>CSNAGALAUT</p>
                <div class="clearfix"></div>
            </div>
            <div class="contact">
            	<p><i class="bbm-yellow square-30 margin-right-10"></i></p>
                <p><span class="m-font">BBM</span></br>D8D5AE14</p>
                <div class="clearfix"></div>
            </div>
            <div class="contact">
            	<p><i class="facebook-yellow square-30 margin-right-10"></i></p>
                <p><span class="m-font">Facebook</span></br>NAGALAUTCOM</p>
                <div class="clearfix"></div>
            </div>
            <div class="contact">
            	<p><i class="instagram-yellow square-30 margin-right-10"></i></p>
                <p><span class="m-font">Instagram</span></br>NAGALAUTAGEN</p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
	<div id="header" class="section">
    	<div class="wrapper">
        	<h1 class="logo">
            	<a href="<?php echo base_url() ?>"><img class="responsive" src="<?php echo base_url() ?>asset/image/logo.png" alt="Nagalaut Logo"></a>
            </h1>
        </div>
    </div>
    <div id="menu" class="section background-red-gradient">
    	<div class="wrapper">
        	<ul class="menu">
            	<li><a href="<?php echo base_url() ?>"><i class="home-white square-20"></i></a></li>
            	<li><a href="<?php echo base_url() ?>">Home</a></li>
                <li><a href="<?php echo base_url() ?>register/">Daftar</a></li>
                <li><a href="<?php echo base_url() ?>deposit/">Deposit</a></li>
                <li><a href="<?php echo base_url() ?>withdrawal/">Withdraw</a></li>
                <li><a href="<?php echo base_url() ?>game/">Produk</a></li>
                <li><a href="<?php echo base_url() ?>promotion/">Promo</a></li>
                <li><a href="<?php echo base_url() ?>live_score/">Livescore</a></li>
                <li><a href="<?php echo base_url() ?>rule/">Peraturan</a></li>
                <li><a href="<?php echo base_url() ?>about_us/">Tentang Kami</a></li>
                <li><a href="<?php echo base_url() ?>faq/">Panduan</a></li>
            </ul>
        </div>
    </div>
    <div id="announcement" class="section">
    	<div class="wrapper">
        	<marquee scrollamount="3">Selamat datang di Asia7bet, Agen Judi Terpercaya - Sebelum melakukan deposit harap menghubungi CS kami untuk nomor rekening terbaru -</marquee>
            <p>Rabu, 9 Mei 2018 | 19:26:56</p>
            <div class="clearfix"></div>
        </div>
    </div>