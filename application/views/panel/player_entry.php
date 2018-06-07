<?php
$view = array(
	'player' => array(
		'bankAccountName' => '',
		'bankAccountNumber' => '',
		'bank' => array(
			'placeholder' => 'Bank',
			'value' => ''
		),
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'email' => '',
		'firstName' => '',
		'gender' => array(
			'placeholder' => 'Gender',
			'value' => ''
		),
		'game' => '',
		'id' => '',
		'lastName' => '',
		'middleName' => '',
		'password' => '',
		'phone' => '',
		'picture' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => '',
		'username' => ''
	),
	'option' => array(
		'bank' => ''
	)
);

if(!empty($data['player']['data'])) {
	
	if(!empty($data['player']['index'])) {
		
		foreach($data['player']['index'] as $key => $value) {
			
			if(!empty($value['credit'])) {
				
				$value['credit'] = number_format($value['credit']);
				
			}
			
			$view['player']['game'] .= '<p class="title">'.$value['game_name'].' ID</p>
			<p class="colon">:</p>
			<input class="game-id" name="game-id" type="text" placeholder="'.$value['game_name'].' ID" value="'.$value['username'].'">
			<input class="game-credit" name="game-credit" type="text" placeholder="'.$value['game_name'].' Credit" value="'.$value['credit'].'">
			<div class="clearfix"></div>';
			
		}
		
	}
	
	if(!empty($data['bank']['data'])) {
		
		foreach($data['bank']['data'] as $key => $value) {
			
			if($value['id'] == $data['player']['data'][0]['bank_id']) {
				
				$view['player']['bank'] = array(
					'placeholder' => $value['name'],
					'value' => $value['id']
				);
				
			}
			
		}
		
	}
	
	$data['player']['data'][0]['timestamp'] = new DateTime($data['player']['data'][0]['timestamp']);
	
	$view['player']['bankAccountName'] = $data['player']['data'][0]['bank_account_name'];
	$view['player']['bankAccountNumber'] = $data['player']['data'][0]['bank_account_number'];
	$view['player']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['player']['email'] = $data['player']['data'][0]['email'];
	$view['player']['firstName'] = $data['player']['data'][0]['first_name'];
	$view['player']['gender'] = array(
		'placeholder' => $data['player']['data'][0]['gender'],
		'value' => $data['player']['data'][0]['gender']
	);
	$view['player']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['player']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['player']['lastName'] = $data['player']['data'][0]['last_name'];
	$view['player']['middleName'] = $data['player']['data'][0]['middle_name'];
	$view['player']['phone'] = $data['player']['data'][0]['phone'];
	$view['player']['password'] = $data['player']['data'][0]['password'];
	$view['player']['picture'] = $data['player']['data'][0]['picture'];
	$view['player']['status'] = array(
		'placeholder' => $data['player']['data'][0]['status'],
		'value' => $data['player']['data'][0]['status']
	);
	$view['player']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['player']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['player']['username'] = $data['player']['data'][0]['username'];
	
}

else {
	
	if(!empty($data['game']['data'])) {
		
		foreach($data['game']['data'] as $key => $value) {
			
			$view['player']['game'] .= '<p class="title">'.$value['name'].' ID</p>
			<p class="colon">:</p>
			<input class="game-id" name="game-id" type="text" placeholder="'.$value['name'].' ID" value="">
			<input class="game-credit" name="game-credit" type="text" placeholder="'.$value['name'].' Credit" value="">
			<div class="clearfix"></div>';
			
		}
		
	}
	
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
        	<h2 class="page-title"><i class="player-white square-30 margin-right-10"></i>Player Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['player']['id'] ?>
                    <p class="title">Username</p>
                    <p class="colon">:</p>
                    <input class="username" name="username" type="text" placeholder="Username" value="<?php echo $view['player']['username'] ?>">
                    <p class="response username"></p>
                    <div class="clearfix"></div>
                    <p class="title">Password</p>
                    <p class="colon">:</p>
                    <input class="password" name="password" type="password" placeholder="Password" value="<?php echo $view['player']['password'] ?>">
                    <p class="response password"></p>
                    <div class="clearfix"></div>
                    <p class="title">Confirm Password</p>
                    <p class="colon">:</p>
                    <input class="confirm-password" name="confirm-password" type="password" placeholder="Confirm Password" value="<?php echo $view['player']['password'] ?>">
                    <p class="response confirm-password"></p>
                    <div class="clearfix"></div>
                    <p class="title">First Name</p>
                    <p class="colon">:</p>
                    <input class="first-name" name="first-name" type="text" placeholder="First Name" value="<?php echo $view['player']['firstName'] ?>">
                    <p class="response first-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Middle Name</p>
                    <p class="colon">:</p>
                    <input class="middle-name" name="middle-name" type="text" placeholder="Middle Name" value="<?php echo $view['player']['middleName'] ?>">
                    <p class="response middle-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Last Name</p>
                    <p class="colon">:</p>
                    <input class="last-name" name="last-name" type="text" placeholder="Last Name" value="<?php echo $view['player']['lastName'] ?>">
                    <p class="response last-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Gender</p>
                    <p class="colon">:</p>
                    <select class="gender" name="gender">
                    	<option value="<?php echo $view['player']['gender']['value'] ?>"><?php echo $view['player']['gender']['placeholder'] ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <p class="response gender"></p>
                    <div class="clearfix"></div>
                    <p class="title">Email</p>
                    <p class="colon">:</p>
                    <input class="email" name="email" type="text" placeholder="Email" value="<?php echo $view['player']['email'] ?>">
                    <p class="response email"></p>
                    <div class="clearfix"></div>
                    <p class="title">Phone</p>
                    <p class="colon">:</p>
                    <input class="phone" name="phone" type="text" placeholder="Phone" value="<?php echo $view['player']['phone'] ?>">
                    <p class="response phone"></p>
                    <div class="clearfix"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['player']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['player']['game'] ?>
                    <p class="title">Bank</p>
                    <p class="colon">:</p>
                    <select class="bank" name="bank">
                    	<option value="<?php echo $view['player']['bank']['value'] ?>"><?php echo $view['player']['bank']['placeholder'] ?></option>
                        <?php echo $view['option']['bank'] ?>
                    </select>
                    <p class="response bank"></p>
                    <div class="clearfix"></div>
                    <p class="title">Bank Account Name</p>
                    <p class="colon">:</p>
                    <input class="bank-account-name" name="bank-account-name" type="text" placeholder="Bank Account Name" value="<?php echo $view['player']['bankAccountName'] ?>">
                    <p class="response bank-account-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Bank Account Number</p>
                    <p class="colon">:</p>
                    <input class="bank-account-number" name="bank-account-number" type="text" placeholder="Bank Account Number" value="<?php echo $view['player']['bankAccountNumber'] ?>">
                    <p class="response bank-account-number"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['player']['status']['value'] ?>"><?php echo $view['player']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['player']['timestamp'] ?>
                    <div class="button">
                    	<?php echo $view['player']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>