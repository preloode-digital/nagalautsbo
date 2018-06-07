<?php
$view = array(
	'administrator' => array(
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'id' => '',
		'firstName' => '',
		'gender' => array(
			'placeholder' => 'Gender',
			'value' => ''
		),
		'lastName' => '',
		'middleName' => '',
		'password' => '',
		'picture' => '',
		'privilege' => array(
			'administrator' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'bank' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'bankAccount' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'blog' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'gallery' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'game' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'player' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'playerTransaction' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'promotion' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'report' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'setting' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			),
			'transaction' => array(
				'delete' => '',
				'edit' => '',
				'insert' => '',
				'view' => ''
			)
		),
		'role' => array(
			'placeholder' => 'Role',
			'value' => ''
		),
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => '',
		'username' => ''
	),
	'option' => array(
		'role' => ''
	)
);

if(!empty($data['administrator']['data'])) {
	
	$role = '';
	
	if(!empty($data['administrator']['role'])) {
		
		foreach($data['administrator']['role'] as $key => $value) {
			
			if($value['id'] == $data['administrator']['data'][0]['administrator_role_id']) {
				
				$role = $value['name'];
				
			}
			
		}
		
	}
	
	$data['administrator']['data'][0]['timestamp'] = new DateTime($data['administrator']['data'][0]['timestamp']);
	
	$view['administrator']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['administrator']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['administrator']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['administrator']['firstName'] = $data['administrator']['data'][0]['first_name'];
	$view['administrator']['gender'] = array(
		'placeholder' => $data['administrator']['data'][0]['gender'],
		'value' => $data['administrator']['data'][0]['gender']
	);
	$view['administrator']['lastName'] = $data['administrator']['data'][0]['last_name'];
	$view['administrator']['middleName'] = $data['administrator']['data'][0]['middle_name'];
	$view['administrator']['password'] = $data['administrator']['data'][0]['password'];
	$view['administrator']['picture'] = $data['administrator']['data'][0]['picture'];
	$view['administrator']['role'] = array(
		'placeholder' => $role,
		'value' => $data['administrator']['data'][0]['administrator_role_id']
	);
	$view['administrator']['status'] = array(
		'placeholder' => $data['administrator']['data'][0]['status'],
		'value' => $data['administrator']['data'][0]['status']
	);
	$view['administrator']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['administrator']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['administrator']['username'] = $data['administrator']['data'][0]['username'];
	
	$privilege = array(
		'administrator' => str_split($data['administrator']['data'][0]['privilege_administrator']),
		'bank' => str_split($data['administrator']['data'][0]['privilege_bank']),
		'bankAccount' => str_split($data['administrator']['data'][0]['privilege_bank_account']),
		'blog' => str_split($data['administrator']['data'][0]['privilege_blog']),
		'gallery' => str_split($data['administrator']['data'][0]['privilege_gallery']),
		'game' => str_split($data['administrator']['data'][0]['privilege_game']),
		'player' => str_split($data['administrator']['data'][0]['privilege_player']),
		'promotion' => str_split($data['administrator']['data'][0]['privilege_promotion']),
		'report' => str_split($data['administrator']['data'][0]['privilege_report']),
		'setting' => str_split($data['administrator']['data'][0]['privilege_setting']),
		'transaction' => str_split($data['administrator']['data'][0]['privilege_transaction'])
	);
	
	if($privilege['administrator'][0] > 0) {
		
		$view['administrator']['privilege']['administrator']['view'] = 'checked';
		
	}
	
	if($privilege['administrator'][1] > 0) {
		
		$view['administrator']['privilege']['administrator']['insert'] = 'checked';
		
	}
	
	if($privilege['administrator'][2] > 0) {
		
		$view['administrator']['privilege']['administrator']['edit'] = 'checked';
		
	}
	
	if($privilege['administrator'][3] > 0) {
		
		$view['administrator']['privilege']['administrator']['delete'] = 'checked';
		
	}
	
	if($privilege['bank'][0] > 0) {
		
		$view['administrator']['privilege']['bank']['view'] = 'checked';
		
	}
	
	if($privilege['bank'][1] > 0) {
		
		$view['administrator']['privilege']['bank']['insert'] = 'checked';
		
	}
	
	if($privilege['bank'][2] > 0) {
		
		$view['administrator']['privilege']['bank']['edit'] = 'checked';
		
	}
	
	if($privilege['bank'][3] > 0) {
		
		$view['administrator']['privilege']['bank']['delete'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][0] > 0) {
		
		$view['administrator']['privilege']['bankAccount']['view'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][1] > 0) {
		
		$view['administrator']['privilege']['bankAccount']['insert'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][2] > 0) {
		
		$view['administrator']['privilege']['bankAccount']['edit'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][3] > 0) {
		
		$view['administrator']['privilege']['bankAccount']['delete'] = 'checked';
		
	}
	
	if($privilege['blog'][0] > 0) {
		
		$view['administrator']['privilege']['blog']['view'] = 'checked';
		
	}
	
	if($privilege['blog'][1] > 0) {
		
		$view['administrator']['privilege']['blog']['insert'] = 'checked';
		
	}
	
	if($privilege['blog'][2] > 0) {
		
		$view['administrator']['privilege']['blog']['edit'] = 'checked';
		
	}
	
	if($privilege['blog'][3] > 0) {
		
		$view['administrator']['privilege']['blog']['delete'] = 'checked';
		
	}
	
	if($privilege['gallery'][0] > 0) {
		
		$view['administrator']['privilege']['gallery']['view'] = 'checked';
		
	}
	
	if($privilege['gallery'][1] > 0) {
		
		$view['administrator']['privilege']['gallery']['insert'] = 'checked';
		
	}
	
	if($privilege['gallery'][2] > 0) {
		
		$view['administrator']['privilege']['gallery']['edit'] = 'checked';
		
	}
	
	if($privilege['gallery'][3] > 0) {
		
		$view['administrator']['privilege']['gallery']['delete'] = 'checked';
		
	}
	
	if($privilege['game'][0] > 0) {
		
		$view['administrator']['privilege']['game']['view'] = 'checked';
		
	}
	
	if($privilege['game'][1] > 0) {
		
		$view['administrator']['privilege']['game']['insert'] = 'checked';
		
	}
	
	if($privilege['game'][2] > 0) {
		
		$view['administrator']['privilege']['game']['edit'] = 'checked';
		
	}
	
	if($privilege['game'][3] > 0) {
		
		$view['administrator']['privilege']['game']['delete'] = 'checked';
		
	}
	
	if($privilege['player'][0] > 0) {
		
		$view['administrator']['privilege']['player']['view'] = 'checked';
		
	}
	
	if($privilege['player'][1] > 0) {
		
		$view['administrator']['privilege']['player']['insert'] = 'checked';
		
	}
	
	if($privilege['player'][2] > 0) {
		
		$view['administrator']['privilege']['player']['edit'] = 'checked';
		
	}
	
	if($privilege['player'][3] > 0) {
		
		$view['administrator']['privilege']['player']['delete'] = 'checked';
		
	}
	
	if($privilege['promotion'][0] > 0) {
		
		$view['administrator']['privilege']['promotion']['view'] = 'checked';
		
	}
	
	if($privilege['promotion'][1] > 0) {
		
		$view['administrator']['privilege']['promotion']['insert'] = 'checked';
		
	}
	
	if($privilege['promotion'][2] > 0) {
		
		$view['administrator']['privilege']['promotion']['edit'] = 'checked';
		
	}
	
	if($privilege['promotion'][3] > 0) {
		
		$view['administrator']['privilege']['promotion']['delete'] = 'checked';
		
	}
	
	if($privilege['report'][0] > 0) {
		
		$view['administrator']['privilege']['report']['view'] = 'checked';
		
	}
	
	if($privilege['report'][1] > 0) {
		
		$view['administrator']['privilege']['report']['insert'] = 'checked';
		
	}
	
	if($privilege['report'][2] > 0) {
		
		$view['administrator']['privilege']['report']['edit'] = 'checked';
		
	}
	
	if($privilege['report'][3] > 0) {
		
		$view['administrator']['privilege']['report']['delete'] = 'checked';
		
	}
	
	if($privilege['setting'][0] > 0) {
		
		$view['administrator']['privilege']['setting']['view'] = 'checked';
		
	}
	
	if($privilege['setting'][1] > 0) {
		
		$view['administrator']['privilege']['setting']['insert'] = 'checked';
		
	}
	
	if($privilege['setting'][2] > 0) {
		
		$view['administrator']['privilege']['setting']['edit'] = 'checked';
		
	}
	
	if($privilege['setting'][3] > 0) {
		
		$view['administrator']['privilege']['setting']['delete'] = 'checked';
		
	}
	
	if($privilege['transaction'][0] > 0) {
		
		$view['administrator']['privilege']['transaction']['view'] = 'checked';
		
	}
	
	if($privilege['transaction'][1] > 0) {
		
		$view['administrator']['privilege']['transaction']['insert'] = 'checked';
		
	}
	
	if($privilege['transaction'][2] > 0) {
		
		$view['administrator']['privilege']['transaction']['edit'] = 'checked';
		
	}
	
	if($privilege['transaction'][3] > 0) {
		
		$view['administrator']['privilege']['transaction']['delete'] = 'checked';
		
	}
	
}

if(!empty($data['administrator']['role'])) {
	
	foreach($data['administrator']['role'] as $key => $value) {
		
		$view['option']['role'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="user-white square-30 margin-right-10"></i>Administrator Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['administrator']['id'] ?>
                    <p class="title">Username</p>
                    <p class="colon">:</p>
                    <input class="username" name="username" type="text" placeholder="Username" value="<?php echo $view['administrator']['username'] ?>">
                    <p class="response username"></p>
                    <div class="clearfix"></div>
                    <p class="title">Password</p>
                    <p class="colon">:</p>
                    <input class="password" name="password" type="password" placeholder="Password" value="<?php echo $view['administrator']['password'] ?>">
                    <p class="response password"></p>
                    <div class="clearfix"></div>
                    <p class="title">Confirm Password</p>
                    <p class="colon">:</p>
                    <input class="confirm-password" name="confirm-password" type="password" placeholder="Confirm Password" value="<?php echo $view['administrator']['password'] ?>">
                    <p class="response confirm-password"></p>
                    <div class="clearfix"></div>
                    <p class="title">First Name</p>
                    <p class="colon">:</p>
                    <input class="first-name" name="first-name" type="text" placeholder="First Name" value="<?php echo $view['administrator']['firstName'] ?>">
                    <p class="response first-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Middle Name</p>
                    <p class="colon">:</p>
                    <input class="middle-name" name="middle-name" type="text" placeholder="Middle Name" value="<?php echo $view['administrator']['middleName'] ?>">
                    <p class="response middle-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Last Name</p>
                    <p class="colon">:</p>
                    <input class="last-name" name="last-name" type="text" placeholder="Last Name" value="<?php echo $view['administrator']['lastName'] ?>">
                    <p class="response last-name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['administrator']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clearfix"></div>
                    <p class="title">Gender</p>
                    <p class="colon">:</p>
                    <select class="gender" name="gender">
                    	<option value="<?php echo $view['administrator']['gender']['value'] ?>"><?php echo $view['administrator']['gender']['placeholder'] ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <p class="response gender"></p>
                    <div class="clearfix"></div>
                    <p class="title">Role</p>
                    <p class="colon">:</p>
                    <select class="role" name="role">
                    	<option value="<?php echo $view['administrator']['role']['value'] ?>"><?php echo $view['administrator']['role']['placeholder'] ?></option>
                        <?php echo $view['option']['role'] ?>
                    </select>
                    <p class="response role"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['administrator']['status']['value'] ?>"><?php echo $view['administrator']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['administrator']['timestamp'] ?>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="detail">
            	<h3 class="page-title">Single Privilege Setting</h3>
            	<form method="post" action="">
                	<p class="title">Administrator</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['privilege']['administrator']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['privilege']['administrator']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['privilege']['administrator']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['privilege']['administrator']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Bank</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['privilege']['bank']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['privilege']['bank']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['privilege']['bank']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['privilege']['bank']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Bank Account</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['privilege']['bankAccount']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['privilege']['bankAccount']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['privilege']['bankAccount']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['privilege']['bankAccount']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Blog</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['privilege']['blog']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['privilege']['blog']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['privilege']['blog']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['privilege']['blog']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Gallery</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['privilege']['gallery']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['privilege']['gallery']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['privilege']['gallery']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['privilege']['gallery']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Game</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['privilege']['game']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['privilege']['game']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['privilege']['game']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['privilege']['game']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Player</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['privilege']['player']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['privilege']['player']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['privilege']['player']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['privilege']['player']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Promotion</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['privilege']['promotion']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['privilege']['promotion']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['privilege']['promotion']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['privilege']['promotion']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Report</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['privilege']['report']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['privilege']['report']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['privilege']['report']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['privilege']['report']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Setting</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['privilege']['setting']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['privilege']['setting']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['privilege']['setting']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['privilege']['setting']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Transaction</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['privilege']['transaction']['view'] ?> data-index="1">
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['privilege']['transaction']['insert'] ?> data-index="2">
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['privilege']['transaction']['edit'] ?> data-index="3">
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['privilege']['transaction']['delete'] ?> data-index="4">
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['administrator']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>