<?php
$view = array(
	'filter' => array(
		'administrator' => array(
			'placeholder' => 'Administrator',
			'value' => '',
		),
		'amount' => '',
		'fromBankAccount' => array(
			'placeholder' => 'From Bank Account',
			'value' => ''
		),
		'game' => array(
			'placeholder' => 'Game',
			'value' => ''
		),
		'id' => '',
		'player' => '',
		'toBankAccount' => array(
			'placeholder' => 'To Bank Account',
			'value' => ''
		),
		'timestamp' => array(
			'',
			''
		),
		'type' => array(
			'placeholder' => 'Type',
			'value' => ''
		)
	),
	'option' => array(
		'administrator' => '',
		'bank' => '',
		'bankAccount' => '',
		'game' => '',
		'player' => ''
	),
	'transaction' => array(
		'list' => ''
	)
);

if(!empty($data['transaction']['data'])) {
	
	foreach($data['transaction']['data'] as $value) {
		
		$transferTo = '';
		$transferFrom = '';
		
		if($value['type'] == 'Deposit' || $value['type'] == 'Inject' || $value['type'] == 'Saving' || $value['type'] == 'Expense' || $value['type'] == 'Adjustment') {
			
			if($value['type'] == 'Deposit') {
				
				if(!empty($data['player']['data'])) {
					
					for($i = 0; $i < count($data['player']['data']); $i++) {
						
						if($data['player']['data'][$i]['id'] == $value['player_id']) {
							
							$transferFrom = $data['player']['data'][$i]['username'];
							
						}
						
					}
					
				}
				
			}
			
			if(!empty($data['bank']['account']['data'])) {
				
				for($i = 0; $i < count($data['bank']['account']['data']); $i++) {
					
					if(!empty($value['to_bank_account_id']) && $data['bank']['account']['data'][$i]['id'] == $value['to_bank_account_id']) {
						
						$transferTo = $data['bank']['account']['data'][$i]['name'];
						
					}
					
					else if(empty($value['to_bank_account_id'])) {
						
						$transferTo = '-';
						
					}
					
				}
				
			}
			
		}
		
		if($value['type'] == 'Withdraw' || $value['type'] == 'Inject' || $value['type'] == 'Saving' || $value['type'] == 'Expense' || $value['type'] == 'Adjustment') {
			
			if($value['type'] == 'Withdraw') {
				
				if(!empty($data['player']['data'])) {
					
					for($i = 0; $i < count($data['player']['data']); $i++) {
						
						if($data['player']['data'][$i]['id'] == $value['player_id']) {
							
							$transferTo = $data['player']['data'][$i]['username'];
							
						}
						
					}
					
				}
				
			}
			
			if(!empty($data['bank']['account']['data'])) {
				
				for($i = 0; $i < count($data['bank']['account']['data']); $i++) {
					
					if(!empty($value['from_bank_account_id']) && $data['bankAccount']['data'][$i]['id'] == $value['from_bank_account_id']) {
						
						$transferFrom = $data['bank']['account']['data'][$i]['name'];
						
					}
					
					else if(empty($value['from_bank_account_id'])) {
						
						$transferFrom = '-';
						
					}
					
				}
				
			}
			
		}
		
		$value['amount'] = number_format($value['amount']);
		$type = strtolower($value['type']);
		
		$game = '-';
		
		if($value['type'] == 'Deposit' || $value['type'] == 'Withdraw') {
			
			if(!empty($data['game']['data'])) {
				
				for($i = 0; $i < count($data['game']['data']); $i++) {
					
					if($data['game']['data'][$i]['id'] == $value['game_id']) {
						
						$game = $data['game']['data'][$i]['name'];
						
					}
					
				}
				
			}
			
		}
		
		$administrator = '';
		
		if(!empty($data['administrator']['data'])) {
			
			for($i = 0; $i < count($data['administrator']['data']); $i++) {
				
				if($data['administrator']['data'][$i]['id'] == $value['administrator_id']) {
					
					$administrator = $data['administrator']['data'][$i]['username'];
					
				}
				
			}
			
		}
		
		$value['timestamp'] = new DateTime($value['timestamp']);
		
		$view['transaction']['list'] .= '<tr>
			<td><p>'.$value['timestamp']->format('j-m-Y H:i:s').'</p></td>
			<td><p>'.$transferFrom.'</p></td>
			<td><p>'.$transferTo.'</p></td>
			<td class="load-detail" data-transaction-id="'.$value['id'].'" data-transaction-type="'.$value['type'].'"><p>'.$value['amount'].'</p></td>
			<td><p>'.$value['type'].'</p></td>
			<td><p>'.$game.'</p></td>
			<td><p>'.$administrator.'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'transaction_entry/'.$type.'/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-transaction-id="'.$value['id'].'" data-transaction-type="'.$value['type'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['administrator']['data'])) {
	
	foreach($data['administrator']['data'] as $value) {
		
		$view['option']['administrator'] .= '<option value="'.$value['id'].'">'.$value['username'].'</option>';
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['administrator'][0])) {
			
			if($value['id'] == $data['filter']['data']['administrator'][0]) {
				
				$view['filter']['administrator']['placeholder'] = $value['name'];
				
			}
			
		}
		
	}
	
}

if(!empty($data['bank']['data'])) {
	
	foreach($data['bank']['data'] as $value) {
		
		$view['option']['bank'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}

if(!empty($data['bankAccount']['data'])) {
	
	foreach($data['bankAccount']['data'] as $value) {
		
		$view['option']['bankAccount'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['fromBankAccount'][0])) {
			
			if($value['id'] == $data['filter']['data']['fromBankAccount'][0]) {
				
				$view['filter']['fromBankAccount']['placeholder'] = $value['name'];
				
			}
			
		}
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['toBankAccount'][0])) {
			
			if($value['id'] == $data['filter']['data']['toBankAccount'][0]) {
				
				$view['filter']['toBankAccount']['placeholder'] = $value['name'];
				
			}
			
		}
		
	}
	
}

if(!empty($data['game']['data'])) {
	
	foreach($data['game']['data'] as $value) {
		
		$view['option']['game'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['game'][0])) {
			
			if($value['id'] == $data['filter']['data']['game'][0]) {
				
				$view['filter']['game']['placeholder'] = $value['name'];
				
			}
			
		}
		
	}
	
}

if(!empty($data['player']['data'])) {
	
	foreach($data['player']['data'] as $value) {
		
		if(!empty($data['filter']['data']) && !empty($data['filter']['data']['player'][0])) {
			
			if($value['id'] == $data['filter']['data']['player'][0]) {
				
				$view['filter']['player'] = $value['username'];
				
			}
			
		}
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['administrator']['value'] = $data['filter']['data']['administrator'][0];
	$view['filter']['fromBankAccount']['value'] = $data['filter']['data']['fromBankAccount'][0];
	$view['filter']['game']['value'] = $data['filter']['data']['game'][0];
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	
	if(!empty($data['filter']['data']['status'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['status'][0],
			'value' => $data['filter']['data']['status'][0]
		);
		
	}
	
	if(!empty($data['filter']['data']['type'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['type'][0],
			'value' => $data['filter']['data']['type'][0]
		);
		
	}
	
	$view['filter']['toBankAccount']['value'] = $data['filter']['data']['toBankAccount'][0];
	$view['filter']['timestamp'] = $data['filter']['data']['timestamp'];
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="transaction-white square-30 margin-right-10"></i>Transaction</h2>
            <div class="pagination">
            	<?php echo $data['transaction']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'transaction_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
               	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input class="player" name="player" type="text" placeholder="Player" value="<?php echo $view['filter']['player'] ?>">
                <select name="from-bank-account">
                	<option value="<?php echo $view['filter']['fromBankAccount']['value'] ?>"><?php echo $view['filter']['fromBankAccount']['placeholder'] ?></option>
                    <option value="">From Bank Account</option>
                    <?php echo $view['option']['bankAccount'] ?>
                </select>
                <select name="to-bank-account">
                	<option value="<?php echo $view['filter']['toBankAccount']['value'] ?>"><?php echo $view['filter']['toBankAccount']['placeholder'] ?></option>
                    <option value="">To Bank Account</option>
                    <?php echo $view['option']['bankAccount'] ?>
                </select>
                <input name="amount" type="text" placeholder="Amount" value="<?php echo $view['filter']['amount'] ?>">
                <select name="administrator">
                	<option value="<?php echo $view['filter']['administrator']['value'] ?>"><?php echo $view['filter']['administrator']['placeholder'] ?></option>
                    <option value="">Administrator</option>
                    <?php echo $view['option']['administrator'] ?>
                </select>
                <select name="game">
                	<option value="<?php echo $view['filter']['game']['value'] ?>"><?php echo $view['filter']['game']['placeholder'] ?></option>
                    <option value="">Game</option>
                    <?php echo $view['option']['game'] ?>
                </select>
                <select name="type">
                	<option value="<?php echo $view['filter']['type']['value'] ?>"><?php echo $view['filter']['type']['placeholder'] ?></option>
                    <option value="">Type</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdraw">Withdraw</option>
                    <option value="Inject">Inject</option>
                    <option value="Saving">Saving</option>
                    <option value="Expense">Expense</option>
                    <option value="Adjustment">Adjustment</option>
                </select>
                <input class="date" name="start-date" type="date" placeholder="Start Date" value="<?php echo $view['filter']['timestamp'][0] ?>">
                <input class="date" name="end-date" type="date" placeholder="End Date" value="<?php echo $view['filter']['timestamp'][1] ?>">
                <button class="filter" name="filter" type="submit"><i class="filter-white square-15 margin-right-10"></i>Filter</button>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>Created Date</p></th>
                    <th><p>Transfer From</p></th>
                    <th><p>Transfer To</p></th>
                    <th><p>Amount</p></th>
                    <th><p>Type</p></th>
                    <th><p>Game</p></th>
                    <th><p>Administrator</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['transaction']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['transaction']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>