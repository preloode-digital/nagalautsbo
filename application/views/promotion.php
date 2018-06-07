<?php
$view = array(
	'promotion' => array(
		'list' => ''
	)
);

if(!empty($data['promotion']['data'])) {
	
	$index = 1;
	
	foreach($data['promotion']['data'] as $key => $value) {
		
		$view['promotion']['list'] .= '<div class="banner promotion-banner" data-index="'.$index.'">
        	<img class="responsive" src="'.base_url().$value['picture'].'">
        </div>
        <div class="description promotion-description" data-index="'.$index.'">
			<h2>'.$value['name'].'</h2>
        	'.$value['description'].'
        </div>
        <div class="separator"></div>';
		
		$index++;
		
	}
	
}
?>


<div id="content" class="section">
	<div class="wrapper">
        <?php echo $view['promotion']['list'] ?>
    </div>
</div>