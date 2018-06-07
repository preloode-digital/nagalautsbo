<?php
$view = array(
	'transaction' => array(
		'request' => array(
			'empty' => '<h3>There is no transaction request in this time!</h3>',
			'list' => '',
			'style' => 'style="display : none;"'
		)
	),
	'player' => array(
		'new' => array(
			'empty' => '<h3>There is no new player in this time!</h3>',
			'list' => '',
			'style' => 'style="display : none;"'
		)
	)
);

if(!empty($data['transaction']['request']['data'])) {
	
	$view['transaction']['request']['empty'] = '';
	$view['transaction']['request']['style'] = '';
	
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
		
		$view['transaction']['request']['list'] .= '<tr class="transaction-request" data-transaction-request-id="'.$value['id'].'">
			<td class="load-transaction-request-detail" data-transaction-request-id="'.$value['id'].'"><p>'.$value['timestamp'].'</p></td>
			<td><p>'.$player.'</p></td>
			<td><p>'.$game.'</p></td>
			<td><p>'.$value['amount'].'</p></td>
			<td><p>'.$value['type'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<button class="load-transaction-request-detail action" data-transaction-request-id="'.$value['id'].'"><i class="view-15-white"></i>View</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['player']['new']['data'])) {
	
	$view['player']['new']['empty'] = '';
	$view['player']['new']['style'] = '';
	
	foreach($data['player']['new']['data'] as $key => $value) {
		
		$name = $value['first_name'];
		
		if(!empty($value['middle_name'])) {
			
			$name .= ' '.$value['middle_name'];
			
		}
		
		if(!empty($value['last_name'])) {
			
			$name .= ' '.$value['last_name'];
			
		}
		
		$value['timestamp'] = new DateTime($value['timestamp']);
		
		$view['player']['new']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-player-detail" data-player-id="'.$value['id'].'"><p>'.$value['username'].'</p></td>
			<td><p>'.$name.'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td><p>'.$value['timestamp']->format('j-m-Y H:i:s').'</p></td>
			<td>
				<button class="load-player-detail action" data-player-id="'.$value['id'].'"><i class="view-15-white"></i>View</button>
			</td>
		</tr>';
		
	}
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="dashboard-30-white"></i>Dashboard</h2>
        </div>
        <div class="content">
        	<div class="subtitle">
            	<h3>Transaction Request</h3>
            </div>
            <div class="transaction-request" <?php echo $view['transaction']['request']['style'] ?>>
            	<?php echo $view['transaction']['request']['empty'] ?>
                <table>
                	<tr class="transaction-request-title">
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
            </div>
            <div class="subtitle">
            	<h3>New Player</h3>
            </div>
            <div class="new-player" <?php echo $view['player']['new']['style'] ?>>
            	<?php echo $view['player']['new']['empty'] ?>
                <table>
                	<tr>
                    	<th><p>ID</p></th>
                        <th><p>Username</p></th>
                        <th><p>Name</p></th>
                        <th><p>Status</p></th>
                        <th><p>Created Date</p></th>
                        <th><p>Action</p></th>
                    </tr>
                    <?php echo $view['player']['new']['list'] ?>
                </table>
            </div>
        </div>
    </div>