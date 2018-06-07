<?php
$view = array(
	'author' => '',
	'css' => '',
	'description' => '',
	'javascript' => '',
	'keyword' => '',
	'ogDescription' => '',
	'ogImage' => '',
	'ogTitle' => '',
	'ogUrl' => '',
	'publisher' => '',
	'title' => '<title>'
);

if(!empty($data['name'])) {
	
	$view['title'] .= $data['name'].' | ';
	
}

$view['title'] .= $this->config->item('site_name').'</title>'."\n";

if(!empty($data['description'])) {
	
	$view['description'] = $data['description'];
	
}

else {
	
	$view['description'] = $this->config->item('site_description');
	
}

if(!empty($data['keyword'])) {
	
	$view['keyword'] = $data['keyword'];
	
}

else {
	
	$view['keyword'] = $this->config->item('site_keyword');
	
}

if(!empty($data['ogType'])) {
	
	$view['ogType'] = '<meta property="og:type" content="'.$data['ogType'].'">'."\n";
	
}

if(!empty($data['ogUrl'])) {
	
	$view['ogUrl'] = '<meta property="og:url" content="'.$data['ogUrl'].'">'."\n";
	
}

if(!empty($data['ogTitle'])) {
	
	$view['ogTitle'] = '<meta property="og:title" content="'.$data['ogTitle'].'">'."\n";
	
}

if(!empty($data['ogImage'])) {
	
	$view['ogImage'] = '<meta property="og:image" content="'.$data['ogImage'].'">'."\n";
	
}

if(!empty($data['ogDescription'])) {
	
	$view['ogDescription'] = '<meta property="og:description" content="'.$data['ogDescription'].'">'."\n";
	
}

if(!empty($data['css'])) {
	
	for ($i = 0; $i < count($data['css']); $i++) {
		
		$view['css'] .= '<link rel="stylesheet" type="text/css" href="'.base_url().'asset/css/panel/'.$data['css'][$i].'.css">'."\n";
		
	}
	
}

if(!empty($data['javascript'])) {
	
	for ($i = 0; $i < count($data['javascript']); $i++) {
		
		$view['javascript'] .= '<script type="text/javascript" src="'.base_url().'asset/javascript/panel/'.$data['javascript'][$i].'.js"></script>'."\n";
		
	}
	
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="language" content="<?php echo $this->config->item('language') ?>">
<meta name="viewport" content="width=device-width", initial-scale=1">
<?php echo $view['title'] ?>
<meta name="description" content="<?php echo $view['description'] ?>">
<meta name="keywords" content="<?php echo $view['keyword'] ?>">
<link rel="author" href="<?php echo $this->config->item('site_author_g+') ?>">
<link rel="publisher" href="<?php echo $this->config->item('site_publisher_g+') ?>">
<?php echo $view['ogTitle'].$view['ogUrl'].$view['ogImage'].$view['ogDescription'] ?>
<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>asset/image/panel/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/css/jquery_ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/css/m_custom_scrollbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/css/panel/global.css">
<?php echo $view['css'] ?>
<script type="text/javascript" src="<?php echo base_url() ?>asset/javascript/jquery_2.2.4.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/javascript/jquery_ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/javascript/jquery_mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/javascript/m_custom_scrollbar.js"></script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>asset/javascript/panel/global.js"></script>
<?php echo $view['javascript'] ?>
</head>

<body>
<div id="config" data-base-url="<?php echo base_url() ?>" data-panel-url="<?php echo $this->config->item('panel_url') ?>"></div>
<div id="loading">
	<div class="wrapper">
        <div class="circle"></div>
        <div class="circle-1"></div>
    </div>
</div>
<div id="popup">
	<div class="wrapper">
    	<div class="close">
        	<i class="remove-white square-20 close-popup"></i>
        </div>
        <div class="popup scrollbar"></div>
    </div>
</div>
<div id="response"></div>