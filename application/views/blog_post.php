<?php
$view = array(
	'blog'=> array(
		'list' => ''
	)
);

if(!empty($data['blog']['data'])) {
	
	$view['blog']['list'] = '<img class="featured responsive" src="'.base_url().$data['blog']['data'][0]['picture'].'" alt="'.$this->config->item('site_name').' Content">
	<h2>'.$data['blog']['data'][0]['title'].'</h2>
	'.$data['blog']['data'][0]['content'];
	
}
?>


<div id="content">
	<div class="wrapper">
    	<div class="content">
            <?php echo $view['blog']['list'] ?>
        </div>
    </div>
</div>