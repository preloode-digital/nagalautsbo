<?php
$view = array(
	'promotion' => array(
		'cap' => '',
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'description' => '',
		'id' => '',
		'game' => '',
		'minimumDeposit' => '',
		'name' => '',
		'percentage' => '',
		'picture' => '',
		'rollover' => '',
		'sequence' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => '',
		'type' => array(
			'placeholder' => 'Type',
			'value' => ''
		)
	),
	'option' => array(
		'game' => ''
	)
);

if(!empty($data['promotion']['data'])) {
	
	$promotionIndex = array();
	
	if(!empty($data['promotion']['index'])) {
		
		foreach($data['promotion']['index'] as $key => $value) {
			
			$promotionIndex[] = $value['game_id'];
			
		}
		
	}
	
	if(!empty($data['game']['data'])) {
		
		foreach($data['game']['data'] as $key => $value) {
			
			if(in_array($value['id'], $promotionIndex)) {
				
				$view['option']['game'] .= '<div class="item">
					<input class="game" name="game" type="checkbox" value="'.$value['id'].'" checked>
					<p class="checkbox">'.$value['name'].'</p>
				</div>';
				
			}
			
			else {
				
				$view['option']['game'] .= '<div class="item">
					<input class="website" name="website" type="checkbox" value="'.$value['id'].'">
					<p class="checkbox">'.$value['name'].'</p>
				</div>';
				
			}
			
		}
		
	}
	
	if(!empty($data['promotion']['data'][0]['cap'])) {
		
		$data['promotion']['data'][0]['cap'] = number_format($data['promotion']['data'][0]['cap']);
		
	}
	
	if(!empty($data['promotion']['data'][0]['minimum_deposit'])) {
		
		$data['promotion']['data'][0]['minimum_deposit'] = number_format($data['promotion']['data'][0]['minimum_deposit']);
		
	}
	
	$data['promotion']['data'][0]['timestamp'] = new DateTime($data['promotion']['data'][0]['timestamp']);
	
	$view['promotion']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['promotion']['cap'] = $data['promotion']['data'][0]['cap'];
	$view['promotion']['description'] = $data['promotion']['data'][0]['description'];
	$view['promotion']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['promotion']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['promotion']['minimumDeposit'] = $data['promotion']['data'][0]['minimum_deposit'];
	$view['promotion']['name'] = $data['promotion']['data'][0]['name'];
	$view['promotion']['percentage'] = $data['promotion']['data'][0]['percentage'];
	$view['promotion']['picture'] = $data['promotion']['data'][0]['picture'];
	$view['promotion']['rollover'] = $data['promotion']['data'][0]['rollover'];
	$view['promotion']['sequence'] = $data['promotion']['data'][0]['sequence'];
	$view['promotion']['status'] = array(
		'placeholder' => $data['promotion']['data'][0]['status'],
		'value' => $data['promotion']['data'][0]['status']
	);
	$view['promotion']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['promotion']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['promotion']['type'] = array(
		'placeholder' => $data['promotion']['data'][0]['type'],
		'value' => $data['promotion']['data'][0]['type']
	);
	
}

else {
	
	if(!empty($data['game']['data'])) {
		
		foreach($data['game']['data'] as $key => $value) {
			
			$view['option']['game'] .= '<div class="item">
				<input class="game" name="game" type="checkbox" value="'.$value['id'].'">
				<p class="checkbox">'.$value['name'].'</p>
			</div>';
			
		}
		
	}
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="promotion-white square-30 margin-right-10"></i>Promotion Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['promotion']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['promotion']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Percentage</p>
                    <p class="colon">:</p>
                    <input class="percentage" name="percentage" type="text" placeholder="Percentage" value="<?php echo $view['promotion']['percentage'] ?>">
                    <p class="response percentage"></p>
                    <div class="clearfix"></div>
                    <p class="title">Minimum Deposit</p>
                    <p class="colon">:</p>
                    <input class="minimum-deposit" name="minimum-deposit" type="text" placeholder="Minimum Deposit" value="<?php echo $view['promotion']['minimumDeposit'] ?>">
                    <p class="response minimum-deposit"></p>
                    <div class="clearfix"></div>
                    <p class="title">Cap</p>
                    <p class="colon">:</p>
                    <input class="cap" name="cap" type="text" placeholder="Cap" value="<?php echo $view['promotion']['cap'] ?>">
                    <p class="response cap"></p>
                    <div class="clearfix"></div>
                    <p class="title">Rollover</p>
                    <p class="colon">:</p>
                    <input class="rollover" name="rollover" type="text" placeholder="Rollover" value="<?php echo $view['promotion']['rollover'] ?>">
                    <p class="response rollover"></p>
                    <div class="clearfix"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['promotion']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clearfix"></div>
                    <p class="title">Type</p>
                    <p class="colon">:</p>
                    <select class="type" name="type">
                    	<option value="<?php echo $view['promotion']['type']['value'] ?>"><?php echo $view['promotion']['type']['placeholder'] ?></option>
                        <option value="One Time">One Time</option>
                        <option value="First Deposit">First Deposit</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                    <p class="response type"></p>
                    <div class="clearfix"></div>
                    <p class="title">Game</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<?php echo $view['option']['game'] ?>
                    </div>
                    <p class="response game"></p>
                    <div class="clearfix"></div>
                    <p class="title">Sequence</p>
                    <p class="colon">:</p>
                    <input class="sequence" name="sequence" type="text" placeholder="Sequence" value="<?php echo $view['promotion']['sequence'] ?>">
                    <p class="response sequence"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['promotion']['status']['value'] ?>"><?php echo $view['promotion']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['promotion']['timestamp'] ?>
                    <p class="title">Description</p>
                    <p class="colon">:</p>
                    <div class="description">
                    	<textarea id="ckeditor" class="description" name="description"><?php echo $view['promotion']['description'] ?></textarea>
                    </div>
                    <p class="response description"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['promotion']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>