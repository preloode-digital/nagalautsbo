<?php
$view = array(
	'picture' => base_url().'asset/image/panel/administrator/administrator_picture.png'
);

if(!empty($data['administrator']['account'])) {
	
	if(!empty($data['administrator']['account'][0]['picture'])) {
		
		$view['picture'] = base_url().$data['administrator']['account'][0]['picture'];
		
	}
	
}
?>


<div id="wrapper">
	<div id="header">
    	<div class="menu">
        	<i class="menu-white square-20 menu"></i>
        </div>
    	<div class="logo">
        	<h1><img class="responsive" src="<?php echo base_url() ?>asset/image/panel/logo.png" alt="<?php echo $this->config->item('site_name') ?>"></h1>
        </div>
        <div id="account">
			<img class="responsive" src="<?php echo $view['picture'] ?>" alt="<?php echo $this->config->item('site_name') ?> User Profile Picture">
        </div>
        <div class="clearfix"></div>
        <ul class="account">
        	<li>
            	<p class="notification"><i class="bell-white square-20 margin-right-10"></i>Notification<span class="notification"></span></p>
            </li>
            <li>
            	<form method="post" action="">
                	<button class="logout" name="logout" type="submit"><i class="power-white square-20 margin-right-10"></i>Logout</button>
                </form>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>