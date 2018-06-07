<?php
$view = array(
	'bank' => array(
		'account' => array(
			'balance' => '',
			'bank' => array(
				'placeholder' => 'Bank',
				'value' => ''
			),
			'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
			'id' => '',
			'name' => '',
			'number' => '',
			'status' => array(
				'placeholder' => 'Status',
				'value' => ''
			),
			'timestamp' => '',
			'type' => array(
				'placeholder' => 'Type',
				'value' => ''
			)
		)
	),
	'option' => array(
		'bank' => ''
	)
);

if(!empty($data['bank']['account']['data'])) {
	
	if(!empty($data['bank']['data'])) {
		
		foreach($data['bank']['data'] as $key => $value) {
			
			if($value['id'] == $data['bank']['account']['data'][0]['bank_id']) {
				
				$view['bank']['account']['bank'] = array(
					'placeholder' => $value['name'],
					'value' => $value['id']
				);
				
			}
			
		}
		
	}
	
	if(!empty($data['bank']['account']['data'][0]['balance'])) {
		
		$data['bank']['account']['data'][0]['balance'] = number_format($data['bank']['account']['data'][0]['balance']);
		
	}
	
	$data['bank']['account']['data'][0]['timestamp'] = new DateTime($data['bank']['account']['data'][0]['timestamp']);
	
	$view['bank']['account']['balance'] = $data['bank']['account']['data'][0]['balance'];
	$view['bank']['account']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['bank']['account']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['bank']['account']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['bank']['account']['name'] = $data['bank']['account']['data'][0]['name'];
	$view['bank']['account']['number'] = $data['bank']['account']['data'][0]['number'];
	$view['bank']['account']['status'] = array(
		'placeholder' => $data['bank']['account']['data'][0]['status'],
		'value' => $data['bank']['account']['data'][0]['status']
	);
	$view['bank']['account']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['bank']['account']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['bank']['account']['type'] = array(
		'placeholder' => $data['bank']['account']['data'][0]['type'],
		'value' => $data['bank']['account']['data'][0]['type']
	);
	
}

if(!empty($data['bank']['data'])) {
	
	foreach($data['bank']['data'] as $key => $value) {
		
		$view['option']['bank'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="bank-account-white square-30 margin-right-10"></i>Bank Account Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['bank']['account']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['bank']['account']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Number</p>
                    <p class="colon">:</p>
                    <input class="number" name="number" type="text" placeholder="Number" value="<?php echo $view['bank']['account']['number'] ?>">
                    <p class="response number"></p>
                    <div class="clearfix"></div>
                    <p class="title">Bank</p>
                    <p class="colon">:</p>
                    <select class="bank" name="bank">
                    	<option value="<?php echo $view['bank']['account']['bank']['value'] ?>"><?php echo $view['bank']['account']['bank']['placeholder'] ?></option>
                        <?php echo $view['option']['bank'] ?>
                    </select>
                    <p class="response bank"></p>
                    <div class="clearfix"></div>
                    <p class="title">Balance</p>
                    <p class="colon">:</p>
                    <input class="balance" name="balance" type="text" placeholder="Balance" value="<?php echo $view['bank']['account']['balance'] ?>">
                    <p class="response balance"></p>
                    <div class="clearfix"></div>
                    <p class="title">Type</p>
                    <p class="colon">:</p>
                    <select class="type" name="type">
                    	<option value="<?php echo $view['bank']['account']['type']['value'] ?>"><?php echo $view['bank']['account']['type']['placeholder'] ?></option>
                    	<option value="Deposit">Deposit</option>
                        <option value="Withdrawal">Withdrawal</option>
                        <option value="Saving">Saving</option>
                        <option value="Expense">Expense</option>
                    </select>
                    <p class="response type"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['bank']['account']['status']['value'] ?>"><?php echo $view['bank']['account']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Blocked">Blocked</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['bank']['account']['timestamp'] ?>
                    <div class="button">
                    	<?php echo $view['bank']['account']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>