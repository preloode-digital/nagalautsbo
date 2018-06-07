<?php
$view = array(
	'setting' => array(
		'runningText' => ''
	)
);

if(!empty($data['setting']['data'])) {
	
	foreach($data['setting']['data'] as $key => $value) {
		
		if($value['name'] == 'Running Text') {
			
			$view['setting']['runningText'] = $value['value'];
			
		}
		
	}
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="setting-white square-30 margin-right-10"></i>Setting</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                    <p class="title">Running Text</p>
                    <p class="colon">:</p>
                    <textarea class="running-text" name="running-text"><?php echo $view['setting']['runningText'] ?></textarea>
                    <p class="response running-text"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>