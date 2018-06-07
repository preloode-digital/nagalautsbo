<?php
$view = array(
	'filter' => array(
		'administrator' => array(
			'placeholder' => 'Administrator',
			'value' => ''
		),
		'amount' => '',
		'game' => array(
			'placeholder' => 'Game',
			'value' => ''
		),
		'id' => '',
		'player' => '',
		'promotion' => array(
			'placeholder' => 'Promotion',
			'value' => ''
		),
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => array(
			'',
			''
		),
		'toBankAccount' => array(
			'placeholder' => 'To Bank Account',
			'value' => ''
		),
		'type' => array(
			'placeholder' => 'Type',
			'value' => ''
		)
	),
	'option' => array(
		'administrator' => '',
		'bankAccount' => '',
		'game' => '',
		'promotion' => ''
	),
	'transaction' => array(
		'request' => array(
			'list' => ''
		)
	)
);

if(!empty($data['transaction']['request']['data'])) {
	
	foreach($data['transaction']['request']['data'] as $key => $value) {
		
		$player = '';
		
		if(!empty($data['player']['data'])) {
			
			for($i = 0; $i < count($data['player']['data']); $i++) {
				
				if($data['player']['data'][$i]['id'] == $value['player_id']) {
					
					$player = $data['player']['data'][$i]['username'];
					
				}
				
			}
			
		}
		
		$game = '';
		
		if(!empty($data['game']['data'])) {
			
			for($i = 0; $i < count($data['game']['data']); $i++) {
				
				if($data['game']['data'][$i]['id'] == $value['game_id']) {
					
					$game = $data['game']['data'][$i]['name'];
					
				}
				
			}
			
		}
		
		$view['transaction']['request']['list'] .= '<tr>
			<td><p>'.$value['timestamp'].'</p></td>
			<td><p>'.$player.'</p></td>
			<td><p>'.$game.'</p></td>
			<td><p>'.$value['amount'].'</p></td>
			<td><p>'.$value['type'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<button class="load-detail action" data-transaction-request-id="'.$value['id'].'"><i class="view-white square-15 margin-right-10"></i>View</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['administrator']['data'])) {
	
	foreach($data['administrator']['data'] as $key => $value) {
		
		if($value['id'] > 1) {
			
			$view['option']['administrator'] .= '<option value="'.$value['id'].'">'.$value['username'].'</option>';
			
		}
		
	}
	
}

if(!empty($data['game']['data'])) {
	
	foreach($data['game']['data'] as $key => $value) {
		
		$view['option']['game'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}

if(!empty($data['promotion']['data'])) {
	
	foreach($data['promotion']['data'] as $key => $value) {
		
		$view['option']['promotion'] .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['administrator'] = $data['filter']['data']['administrator'][0];
	$view['filter']['bankAccountNumber'] = $data['filter']['data']['bankAccountNumber'][0];
	$view['filter']['firstName'] = $data['filter']['data']['firstName'][0];	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['player'] = $data['filter']['data']['player'][0];
	
	if(!empty($data['filter']['data']['status'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['status'][0],
			'value' => $data['filter']['data']['status'][0]
		);
		
	}
	
	if(!empty($data['filter']['data']['type'][0])) {
		
		$view['filter']['type'] = array(
			'placeholder' => $data['filter']['data']['type'][0],
			'value' => $data['filter']['data']['type'][0]
		);
		
	}
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="flow-white square-30 margin-right-10"></i>Transaction Request</h2>
            <div class="pagination">
            	<?php echo $data['transaction']['request']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'transaction_request_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="player" type="text" placeholder="Player" value="<?php echo $view['filter']['player'] ?>">
                <select name="game">
                	<option value="<?php echo $view['filter']['game']['value'] ?>"><?php echo $view['filter']['game']['placeholder'] ?></option>
                    <?php echo $view['option']['game'] ?>
                </select>
                <input name="amount" type="text" placeholder="Amount" value="<?php echo $view['filter']['amount'] ?>">
                <select name="type">
                	<option value="<?php echo $view['filter']['type']['value'] ?>"><?php echo $view['filter']['type']['placeholder'] ?></option>
                    <option value="">Type</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdraw">Withdrawal</option>
                </select>
                <select name="to-bank-account">
					<option value="<?php echo $view['filter']['toBankAccount']['value'] ?>"><?php echo $view['filter']['toBankAccount']['placeholder'] ?></option>
                    <?php echo $view['option']['bankAccount'] ?>
                </select>
                <select name="promotion">
					<option value="<?php echo $view['filter']['promotion']['value'] ?>"><?php echo $view['filter']['promotion']['placeholder'] ?></option>
                    <?php echo $view['option']['promotion'] ?>
                </select>
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <select name="administrator">
                	<option value="<?php echo $view['filter']['administrator']['value'] ?>"><?php echo $view['filter']['administrator']['placeholder'] ?></option>
                    <?php echo $view['option']['administrator'] ?>
                </select>
                <button class="filter" name="filter" type="submit"><i class="filter-white square-15 margin-right-10"></i>Filter</button>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                    <th><p>Created Date</p></th>
                    <th><p>Player</p></th>
                    <th><p>Game</p></th>
                    <th><p>Amount</p></th>
                    <th><p>Type</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['transaction']['request']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['transaction']['request']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>