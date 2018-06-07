<?php
$view = array(
	'option' => array(
		'bank' => '',
		'fromBankAccount' => '',
		'game' => '',
		'promotion' => '',
		'toBankAccount' => ''
	),
	'transaction' => array(
		'request' => array(
			'amount' => array(
				'style' => '',
				'value' => ''
			),
			'button' => '<div class="button">
				<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>
			</div>',
			'fromBank' => array(
				'placeholder' => 'From Bank',
				'style' => '',
				'value' => ''
			),
			'fromBankAccount' => array(
				'placeholder' => 'From Bank Account',
				'style' => '',
				'value' => ''
			),
			'game' => array(
				'style' => ''
			),
			'id' => '',
			'note' => array(
				'style' => '',
				'value' => ''
			),
			'player' => array(
				'style' => '',
				'value' => ''
			),
			'promotion' => array(
				'placeholder' => 'Promotion',
				'style' => '',
				'value' => ''
			),
			'status' => array(
				'placeholder' => 'Status',
				'style' => '',
				'value' => ''
			),
			'timestamp' => '',
			'toBank' => array(
				'placeholder' => 'To Bank',
				'style' => '',
				'value' => ''
			),
			'toBankAccount' => array(
				'placeholder' => 'To Bank Account',
				'style' => '',
				'value' => ''
			),
			'type' => array(
				'placeholder' => 'Type',
				'value' => ''
			)
		)
	)
);

if(!empty($data['transaction']['request']['data'])) {
	
	$view['transaction']['request']['amount']['style'] = 'style="display : block; opacity : 1;"';
	$view['transaction']['request']['note']['style'] = 'style="display : block; opacity : 1;"';
	$view['transaction']['request']['status']['style'] = 'style="display : block; opacity : 1;"';
	$view['transaction']['request']['game']['style'] = 'style="display : block; opacity : 1;"';
	$view['transaction']['request']['player']['style'] = 'style="display : block; opacity : 1;"';
	
	if($data['transaction']['request']['type'] == 'Deposit') {
		
		$view['transaction']['promotion']['style'] = 'style="display : block; opacity : 1;"';
		$view['transaction']['toBank']['style'] = 'style="display : block; opacity : 1;"';
		$view['transaction']['toBankAccount']['style'] = 'style="display : block; opacity : 1;"';
		
		$bankId = '';
		
		if(!empty($data['bank']['account']['data'])) {
			
			for($i = 0; $i < count($data['bank']['account']['data']); $i++) {
				
				if($data['bank']['account']['data'][$i]['id'] == $data['transaction']['request']['data'][0]['to_bank_account_id']) {
					
					$view['transaction']['toBankAccount']['placeholder'] = $data['bank']['account']['data'][$i]['name'];
					$view['transaction']['toBankAccount']['value'] = $data['bank']['account']['data'][$i]['id'];
					$bankId = $data['bank']['account']['data'][$i]['bank_id'];
					
				}
				
			}
			
			for($i = 0; $i < count($data['bank']['account']['data']); $i++) {
				
				if($data['bank']['account']['data'][$i]['bank_id'] == $bankId) {
					
					if($data['transaction']['type'] == 'Deposit') {
						
						if($data['bank']['account']['data'][$i]['type'] == 'Deposit') {
							
							$view['option']['toBankAccount'] .= '<option value="'.$data['bank']['account']['data'][$i]['id'].'">'.$data['bank']['account']['data'][$i]['name'].'</option>';
							
						}
						
					}
					
					else {
						
						$view['option']['toBankAccount'] .= '<option value="'.$data['bank']['account']['data'][$i]['id'].'">'.$data['bank']['account']['data'][$i]['name'].'</option>';
						
					}
					
				}
				
			}
			
		}
		
		if(!empty($data['bank']['data'])) {
			
			for($i = 0; $i < count($data['bank']['data']); $i++) {
				
				if($data['bank']['data'][$i]['id'] == $bankId) {
					
					$view['transaction']['toBank']['placeholder'] = $data['bank']['data'][$i]['name'];
					$view['transaction']['toBank']['value'] = $data['bank']['data'][$i]['id'];
					
				}
				
			}
			
		}
		
		if(!empty($data['promotion']['data'])) {
			
			for($i = 0; $i < count($data['promotion']['data']); $i++) {
				
				$view['promotion']['option'] .= '<option value="'.$data['promotion']['data'][$i]['id'].'">'.$data['promotion']['data'][$i]['name'].'</option>';
				
				if($data['promotion']['data'][$i]['id'] == $data['transaction']['request']['data'][0]['promotion_id']) {
					
					$view['transaction']['promotion']['placeholder'] = $data['promotion']['data'][$i]['name'];
					$view['transaction']['promotion']['value'] = $data['promotion']['data'][$i]['id'];
					
				}
				
			}
			
		}
		
	}
	
	else {
		
		$view['transaction']['fromBank']['style'] = 'style="display : block; opacity : 1;"';
		$view['transaction']['fromBankAccount']['style'] = 'style="display : block; opacity : 1;"';
		
		$bankId = '';
		
		if(!empty($data['bankAccount']['data'])) {
			
			for($i = 0; $i < count($data['bankAccount']['data']); $i++) {
				
				if($data['bank']['account']['data'][$i]['id'] == $data['transaction']['request']['data'][0]['from_bank_account_id']) {
					
					$view['transaction']['fromBankAccount']['placeholder'] = $data['bank']['account']['data'][$i]['name'];
					$view['transaction']['fromBankAccount']['value'] = $data['bank']['account']['data'][$i]['id'];
					$bankId = $data['bank']['account']['data'][$i]['bank_id'];
					
				}
				
			}
			
			for($i = 0; $i < count($data['bank']['account']['data']); $i++) {
				
				if($data['bank']['account']['data'][$i]['bank_id'] == $bankId) {
					
					if($data['transaction']['request']['type'] == 'Withdrawal') {
						
						if($data['bank']['account']['data'][$i]['type'] == 'Withdrawal') {
							
							$view['option']['fromBankAccount'] .= '<option value="'.$data['bank']['account']['data'][$i]['id'].'">'.$data['bank']['account']['data'][$i]['name'].'</option>';
							
						}
						
					}
					
					else {
						
						$view['option']['fromBankAccount'] .= '<option value="'.$data['bank']['account']['data'][$i]['id'].'">'.$data['bank']['account']['data'][$i]['name'].'</option>';
						
					}
					
				}
				
			}
			
		}
		
		if(!empty($data['bank'])) {
			
			for($i = 0; $i < count($data['bank']); $i++) {
				
				if($data['bank'][$i]['id'] == $bankId) {
					
					$view['transaction']['fromBank']['placeholder'] = $data['bank'][$i]['name'];
					$view['transaction']['fromBank']['value'] = $data['bank'][$i]['id'];
					
				}
				
			}
			
		}
		
	}
	
	if(!empty($data['game']['data'])) {
		
		for($i = 0; $i < count($data['game']['data']); $i++) {
			
			if($data['game']['data'][$i]['id'] == $data['transaction']['request']['data'][0]['game_id']) {
				
				$view['option']['game'] .= '<div class="item" '.$view['transaction']['game']['style'].'>
					<input class="game" '.$view['transaction']['game']['style'].' name="game" type="radio" value="'.$data['game']['data'][$i]['id'].'" checked>
					<p class="checkbox">'.$data['game']['data'][$i]['name'].'</p>
				</div>';
				
			}
			
			else {
				
				$view['option']['game'] .= '<div class="item" '.$view['transaction']['game']['style'].'>
					<input class="game" '.$view['transaction']['game']['style'].' name="game" type="radio" value="'.$data['game']['data'][$i]['id'].'">
					<p class="checkbox">'.$data['game']['data'][$i]['name'].'</p>
				</div>';
				
			}
			
		}
		
	}
	
	if(!empty($data['player']['data'])) {
		
		for($i = 0; $i < count($data['player']['data']); $i++) {
			
			if($data['player']['data'][$i]['id'] == $data['transaction']['request']['data'][0]['player_id']) {
				
				$view['transaction']['player']['value'] = $data['player']['data'][$i]['username'];
				
			}
			
		}
		
	}
	
	$data['transaction']['request']['data'][0]['timestamp'] = new DateTime($data['transaction']['request']['data'][0]['timestamp']);
	
	$view['transaction']['amount']['value'] = number_format($data['transaction']['request']['data'][0]['amount']);
	$view['transaction']['button'] = '<div class="button" style="display : block; opacity : 1;">
		<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
	</div>';
	$view['transaction']['note']['value'] = $data['transaction']['request']['data'][0]['note'];
	$view['transaction']['status']['value'] = $data['transaction']['request']['data'][0]['status'];
	$view['transaction']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input class="timestamp" name="timestamp" type="text" placeholder="Created Date" value="'.$data['transaction']['request']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	
}

else {
	
	if(!empty($data['game']['data'])) {
		
		foreach($data['game']['data'] as $key => $value) {
			
			$view['option']['game'] .= '<div class="item" '.$view['transaction']['request']['game']['style'].'>
				<input class="game" '.$view['transaction']['request']['game']['style'].' name="game" type="radio" value="'.$value['id'].'">
				<p class="checkbox">'.$value['name'].'</p>
			</div>';
			
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
        	<h2 class="page-title"><i class="flow-white square-30 margin-right-10"></i>Transaction Request Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<p class="title type">Type</p>
                    <p class="colon type">:</p>
                    <select class="type" name="type">
                    	<option value="<?php echo $view['transaction']['request']['type']['value'] ?>"><?php echo $view['transaction']['request']['type']['placeholder'] ?></option>
                        <option value="Deposit">Deposit</option>
                        <option value="Withdrawal">Withdrawal</option>
                    </select>
                    <p class="response type"></p>
                    <div class="clearfix type"></div>
                    <p class="title game" <?php echo $view['transaction']['request']['game']['style'] ?>>Game</p>
                    <p class="colon game" <?php echo $view['transaction']['request']['game']['style'] ?>>:</p>
                    <div class="checkbox" <?php echo $view['transaction']['request']['game']['style'] ?>>
                    	<?php echo $view['option']['game'] ?>
                    </div>
                    <p class="response game" <?php echo $view['transaction']['request']['game']['style'] ?>></p>
                    <div class="clearfix game" <?php echo $view['transaction']['request']['game']['style'] ?>></div>
                    <p class="title player" <?php echo $view['transaction']['request']['player']['style'] ?>>Player Username</p>
                    <p class="colon player" <?php echo $view['transaction']['request']['player']['style'] ?>>:</p>
                    <input class="player" <?php echo $view['transaction']['request']['player']['style'] ?> name="player" type="text" placeholder="Player" value="<?php echo $view['transaction']['request']['player']['value'] ?>">
                    <p class="response player" <?php echo $view['transaction']['request']['player']['style'] ?>></p>
                    <div class="clearfix player" <?php echo $view['transaction']['request']['player']['style'] ?>></div>
                    <p class="title amount" <?php echo $view['transaction']['request']['amount']['style'] ?>>Amount</p>
                    <p class="colon amount" <?php echo $view['transaction']['request']['amount']['style'] ?>>:</p>
                    <input class="amount" <?php echo $view['transaction']['request']['amount']['style'] ?> name="amount" type="text" placeholder="Amount" value="<?php echo $view['transaction']['request']['amount']['value'] ?>">
                    <p class="response amount" <?php echo $view['transaction']['request']['amount']['style'] ?>></p>
                    <div class="clearfix amount" <?php echo $view['transaction']['request']['amount']['style'] ?>></div>
                    <p class="title promotion" <?php echo $view['transaction']['request']['promotion']['style'] ?>>Promotion</p>
                    <p class="colon promotion" <?php echo $view['transaction']['request']['promotion']['style'] ?>>:</p>
                    <select class="promotion" <?php echo $view['transaction']['request']['promotion']['style'] ?> name="promotion">
                    	<option value="<?php echo $view['transaction']['request']['promotion']['value'] ?>"><?php echo $view['transaction']['request']['promotion']['placeholder'] ?></option>
                        <?php echo $view['option']['promotion'] ?>
                    </select>
                    <p class="response promotion" <?php echo $view['transaction']['request']['promotion']['style'] ?>></p>
                    <div class="clearfix promotion" <?php echo $view['transaction']['request']['promotion']['style'] ?>></div>
                    <p class="title from-bank" <?php echo $view['transaction']['request']['fromBank']['style'] ?>>From Bank</p>
                    <p class="colon from-bank" <?php echo $view['transaction']['request']['fromBank']['style'] ?>>:</p>
                    <select class="from-bank" <?php echo $view['transaction']['request']['fromBank']['style'] ?> name="from-bank">
                        <option value="<?php echo $view['transaction']['request']['fromBank']['value'] ?>"><?php echo $view['transaction']['request']['fromBank']['placeholder'] ?></option>
                        <?php echo $view['option']['bank'] ?>
                    </select>
                    <p class="response from-bank" <?php echo $view['transaction']['request']['fromBank']['style'] ?>></p>
                    <div class="clearfix from-bank" <?php echo $view['transaction']['request']['fromBank']['style'] ?>></div>
                    <p class="title from-bank-account" <?php echo $view['transaction']['request']['fromBankAccount']['style'] ?>>From Bank Account</p>
                    <p class="colon from-bank-account" <?php echo $view['transaction']['request']['fromBankAccount']['style'] ?>>:</p>
                    <select class="from-bank-account" <?php echo $view['transaction']['request']['fromBankAccount']['style'] ?> name="from-bank-account">
                        <option value="<?php echo $view['transaction']['request']['fromBankAccount']['value'] ?>"><?php echo $view['transaction']['request']['fromBankAccount']['placeholder'] ?></option>
                        <?php echo $view['option']['fromBankAccount'] ?>
                    </select>
                    <p class="response from-bank-account" <?php echo $view['transaction']['request']['fromBankAccount']['style'] ?>></p>
                    <div class="clearfix from-bank-account" <?php echo $view['transaction']['request']['fromBankAccount']['style'] ?>></div>
                    <p class="title to-bank" <?php echo $view['transaction']['request']['toBank']['style'] ?>>To Bank</p>
                    <p class="colon to-bank" <?php echo $view['transaction']['request']['toBank']['style'] ?>>:</p>
                    <select class="to-bank" <?php echo $view['transaction']['request']['toBank']['style'] ?> name="to-bank">
                        <option value="<?php echo $view['transaction']['request']['toBank']['value'] ?>"><?php echo $view['transaction']['request']['toBank']['placeholder'] ?></option>
                        <?php echo $view['option']['bank'] ?>
                    </select>
                    <p class="response to-bank" <?php echo $view['transaction']['request']['toBank']['style'] ?>></p>
                    <div class="clearfix to-bank" <?php echo $view['transaction']['request']['toBank']['style'] ?>></div>
                    <p class="title to-bank-account" <?php echo $view['transaction']['request']['toBankAccount']['style'] ?>>To Bank Account</p>
                    <p class="colon to-bank-account" <?php echo $view['transaction']['request']['toBankAccount']['style'] ?>>:</p>
                    <select class="to-bank-account" <?php echo $view['transaction']['request']['toBankAccount']['style'] ?> name="to-bank-account">
                    	<option value="<?php echo $view['transaction']['request']['toBankAccount']['value'] ?>"><?php echo $view['transaction']['request']['toBankAccount']['placeholder'] ?></option>
                        <?php echo $view['option']['toBankAccount'] ?>
                    </select>
                    <p class="response to-bank-account" <?php echo $view['transaction']['request']['toBankAccount']['style'] ?>></p>
                    <div class="clearfix to-bank-account" <?php echo $view['transaction']['request']['toBankAccount']['style'] ?>></div>
                    <p class="title status" <?php echo $view['transaction']['request']['status']['style'] ?>>Status</p>
                    <p class="colon status" <?php echo $view['transaction']['request']['status']['style'] ?>>:</p>
                    <select class="status" <?php echo $view['transaction']['request']['status']['style'] ?> name="status">
                    	<option value="<?php echo $view['transaction']['request']['status']['value'] ?>"><?php echo $view['transaction']['request']['status']['placeholder'] ?></option>
                        <option value="Pending">Pending</option>
                        <option value="Taken">Taken</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <p class="response status" <?php echo $view['transaction']['request']['status']['style'] ?>></p>
                    <div class="clearfix status" <?php echo $view['transaction']['request']['status']['style'] ?>></div>
                    <p class="title note" <?php echo $view['transaction']['request']['note']['style'] ?>>Note</p>
                    <p class="colon note" <?php echo $view['transaction']['request']['note']['style'] ?>>:</p>
                    <textarea class="note" <?php echo $view['transaction']['request']['note']['style'] ?> name="note" rows="3"><?php echo $view['transaction']['request']['note']['value'] ?></textarea>
                    <p class="response note" <?php echo $view['transaction']['request']['note']['style'] ?>></p>
                    <div class="clearfix note" <?php echo $view['transaction']['request']['note']['style'] ?>></div>
                    <?php echo $view['transaction']['request']['timestamp'] ?>
                    <?php echo $view['transaction']['request']['button'] ?>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>