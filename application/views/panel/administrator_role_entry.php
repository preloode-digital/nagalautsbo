<?php
$view = array(
	'administrator' => array(
		'role' => array(
			'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
			'id' => '',
			'name' => '',
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
				),
			),
			'status' => array(
				'placeholder' => 'Status',
				'value' => ''
			),
			'timestamp' => ''
		)
	)
);

if(!empty($data['administrator']['role']['data'])) {
	
	$data['administrator']['role']['data'][0]['timestamp'] = new DateTime($data['administrator']['role']['data'][0]['timestamp']);
	
	$view['administrator']['role']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['administrator']['role']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['administrator']['role']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['administrator']['role']['name'] = $data['administrator']['role']['data'][0]['name'];
	$view['administrator']['role']['status'] = array(
		'placeholder' => $data['administrator']['role']['data'][0]['status'],
		'value' => $data['administrator']['role']['data'][0]['status']
	);
	$view['administrator']['role']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['administrator']['role']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	
	$privilege = array(
		'administrator' => str_split($data['administrator']['role']['data'][0]['privilege_administrator']),
		'bank' => str_split($data['administrator']['role']['data'][0]['privilege_bank']),
		'bankAccount' => str_split($data['administrator']['role']['data'][0]['privilege_bank_account']),
		'blog' => str_split($data['administrator']['role']['data'][0]['privilege_blog']),
		'gallery' => str_split($data['administrator']['role']['data'][0]['privilege_gallery']),
		'game' => str_split($data['administrator']['role']['data'][0]['privilege_game']),
		'player' => str_split($data['administrator']['role']['data'][0]['privilege_player']),
		'promotion' => str_split($data['administrator']['role']['data'][0]['privilege_promotion']),
		'report' => str_split($data['administrator']['role']['data'][0]['privilege_report']),
		'setting' => str_split($data['administrator']['role']['data'][0]['privilege_setting']),
		'transaction' => str_split($data['administrator']['role']['data'][0]['privilege_transaction']),
	);
	
	if($privilege['administrator'][0] > 0) {
		
		$view['administrator']['role']['privilege']['administrator']['view'] = 'checked';
		
	}
	
	if($privilege['administrator'][1] > 0) {
		
		$view['administrator']['role']['privilege']['administrator']['insert'] = 'checked';
		
	}
	
	if($privilege['administrator'][2] > 0) {
		
		$view['administrator']['role']['privilege']['administrator']['edit'] = 'checked';
		
	}
	
	if($privilege['administrator'][3] > 0) {
		
		$view['administrator']['role']['privilege']['administrator']['delete'] = 'checked';
		
	}
	
	if($privilege['bank'][0] > 0) {
		
		$view['administrator']['role']['privilege']['bank']['view'] = 'checked';
		
	}
	
	if($privilege['bank'][1] > 0) {
		
		$view['administrator']['role']['privilege']['bank']['insert'] = 'checked';
		
	}
	
	if($privilege['bank'][2] > 0) {
		
		$view['administrator']['role']['privilege']['bank']['edit'] = 'checked';
		
	}
	
	if($privilege['bank'][3] > 0) {
		
		$view['administrator']['role']['privilege']['bank']['delete'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][0] > 0) {
		
		$view['administrator']['role']['privilege']['bankAccount']['view'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][1] > 0) {
		
		$view['administrator']['role']['privilege']['bankAccount']['insert'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][2] > 0) {
		
		$view['administrator']['role']['privilege']['bankAccount']['edit'] = 'checked';
		
	}
	
	if($privilege['bankAccount'][3] > 0) {
		
		$view['administrator']['role']['privilege']['bankAccount']['delete'] = 'checked';
		
	}
	
	if($privilege['blog'][0] > 0) {
		
		$view['administrator']['role']['privilege']['blog']['view'] = 'checked';
		
	}
	
	if($privilege['blog'][1] > 0) {
		
		$view['administrator']['role']['privilege']['blog']['insert'] = 'checked';
		
	}
	
	if($privilege['blog'][2] > 0) {
		
		$view['administrator']['role']['privilege']['blog']['edit'] = 'checked';
		
	}
	
	if($privilege['blog'][3] > 0) {
		
		$view['administrator']['role']['privilege']['blog']['delete'] = 'checked';
		
	}
	
	if($privilege['gallery'][0] > 0) {
		
		$view['administrator']['role']['privilege']['gallery']['view'] = 'checked';
		
	}
	
	if($privilege['gallery'][1] > 0) {
		
		$view['administrator']['role']['privilege']['gallery']['insert'] = 'checked';
		
	}
	
	if($privilege['gallery'][2] > 0) {
		
		$view['administrator']['role']['privilege']['gallery']['edit'] = 'checked';
		
	}
	
	if($privilege['gallery'][3] > 0) {
		
		$view['administrator']['role']['privilege']['gallery']['delete'] = 'checked';
		
	}
	
	if($privilege['game'][0] > 0) {
		
		$view['administrator']['role']['privilege']['game']['view'] = 'checked';
		
	}
	
	if($privilege['game'][1] > 0) {
		
		$view['administrator']['role']['privilege']['game']['insert'] = 'checked';
		
	}
	
	if($privilege['game'][2] > 0) {
		
		$view['administrator']['role']['privilege']['game']['edit'] = 'checked';
		
	}
	
	if($privilege['game'][3] > 0) {
		
		$view['administrator']['role']['privilege']['game']['delete'] = 'checked';
		
	}
	
	if($privilege['player'][0] > 0) {
		
		$view['administrator']['role']['privilege']['player']['view'] = 'checked';
		
	}
	
	if($privilege['player'][1] > 0) {
		
		$view['administrator']['role']['privilege']['player']['insert'] = 'checked';
		
	}
	
	if($privilege['player'][2] > 0) {
		
		$view['administrator']['role']['privilege']['player']['edit'] = 'checked';
		
	}
	
	if($privilege['player'][3] > 0) {
		
		$view['administrator']['role']['privilege']['player']['delete'] = 'checked';
		
	}
	
	if($privilege['promotion'][0] > 0) {
		
		$view['administrator']['role']['privilege']['promotion']['view'] = 'checked';
		
	}
	
	if($privilege['promotion'][1] > 0) {
		
		$view['administrator']['role']['privilege']['promotion']['insert'] = 'checked';
		
	}
	
	if($privilege['promotion'][2] > 0) {
		
		$view['administrator']['role']['privilege']['promotion']['edit'] = 'checked';
		
	}
	
	if($privilege['promotion'][3] > 0) {
		
		$view['administrator']['role']['privilege']['promotion']['delete'] = 'checked';
		
	}
	
	if($privilege['report'][0] > 0) {
		
		$view['administrator']['role']['privilege']['report']['view'] = 'checked';
		
	}
	
	if($privilege['report'][1] > 0) {
		
		$view['administrator']['role']['privilege']['report']['insert'] = 'checked';
		
	}
	
	if($privilege['report'][2] > 0) {
		
		$view['administrator']['role']['privilege']['report']['edit'] = 'checked';
		
	}
	
	if($privilege['report'][3] > 0) {
		
		$view['administrator']['role']['privilege']['report']['delete'] = 'checked';
		
	}
	
	if($privilege['setting'][0] > 0) {
		
		$view['administrator']['role']['privilege']['setting']['view'] = 'checked';
		
	}
	
	if($privilege['setting'][1] > 0) {
		
		$view['administrator']['role']['privilege']['setting']['insert'] = 'checked';
		
	}
	
	if($privilege['setting'][2] > 0) {
		
		$view['administrator']['role']['privilege']['setting']['edit'] = 'checked';
		
	}
	
	if($privilege['setting'][3] > 0) {
		
		$view['administrator']['role']['privilege']['setting']['delete'] = 'checked';
		
	}
	
	if($privilege['transaction'][0] > 0) {
		
		$view['administrator']['role']['privilege']['transaction']['view'] = 'checked';
		
	}
	
	if($privilege['transaction'][1] > 0) {
		
		$view['administrator']['role']['privilege']['transaction']['insert'] = 'checked';
		
	}
	
	if($privilege['transaction'][2] > 0) {
		
		$view['administrator']['role']['privilege']['transaction']['edit'] = 'checked';
		
	}
	
	if($privilege['transaction'][3] > 0) {
		
		$view['administrator']['role']['privilege']['transaction']['delete'] = 'checked';
		
	}
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="user-role-white square-30 margin-right-10"></i>Administrator Role Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['administrator']['role']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['administrator']['role']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['administrator']['role']['status']['value'] ?>"><?php echo $view['administrator']['role']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['administrator']['role']['timestamp'] ?>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="detail">
            	<h3 class="page-title">Privilege</h3>
            	<form method="post" action="">
                	<p class="title">Administrator</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['role']['privilege']['administrator']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['role']['privilege']['administrator']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['role']['privilege']['administrator']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-administrator" name="privilege-administrator" type="checkbox" <?php echo $view['administrator']['role']['privilege']['administrator']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Bank</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bank']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bank']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bank']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank" name="privilege-bank" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bank']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Bank Account</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bankAccount']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bankAccount']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bankAccount']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-bank-account" name="privilege-bank-account" type="checkbox" <?php echo $view['administrator']['role']['privilege']['bankAccount']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Blog</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['role']['privilege']['blog']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['role']['privilege']['blog']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['role']['privilege']['blog']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-blog" name="privilege-blog" type="checkbox" <?php echo $view['administrator']['role']['privilege']['blog']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Gallery</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['role']['privilege']['gallery']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['role']['privilege']['gallery']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['role']['privilege']['gallery']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-gallery" name="privilege-gallery" type="checkbox" <?php echo $view['administrator']['role']['privilege']['gallery']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Game</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['role']['privilege']['game']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['role']['privilege']['game']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['role']['privilege']['game']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-game" name="privilege-game" type="checkbox" <?php echo $view['administrator']['role']['privilege']['game']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Player</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['role']['privilege']['player']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['role']['privilege']['player']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['role']['privilege']['player']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-player" name="privilege-player" type="checkbox" <?php echo $view['administrator']['role']['privilege']['player']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Promotion</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['role']['privilege']['promotion']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['role']['privilege']['promotion']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['role']['privilege']['promotion']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-promotion" name="privilege-promotion" type="checkbox" <?php echo $view['administrator']['role']['privilege']['promotion']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Report</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['role']['privilege']['report']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['role']['privilege']['report']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['role']['privilege']['report']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-report" name="privilege-report" type="checkbox" <?php echo $view['administrator']['role']['privilege']['report']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Setting</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['role']['privilege']['setting']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['role']['privilege']['setting']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['role']['privilege']['setting']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-setting" name="privilege-setting" type="checkbox" <?php echo $view['administrator']['role']['privilege']['setting']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <p class="title">Transaction</p>
                    <p class="colon">:</p>
                    <div class="checkbox">
                    	<div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['role']['privilege']['transaction']['view'] ?>>
                            <p class="checkbox">View</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['role']['privilege']['transaction']['insert'] ?>>
                            <p class="checkbox">Add</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['role']['privilege']['transaction']['edit'] ?>>
                            <p class="checkbox">Edit</p>
                        </div>
                        <div class="item">
                        	<input class="privilege-transaction" name="privilege-transaction" type="checkbox" <?php echo $view['administrator']['role']['privilege']['transaction']['delete'] ?>>
                            <p class="checkbox">Delete</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['administrator']['role']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>