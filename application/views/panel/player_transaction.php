<?php
$view = array(
	'filter' => array(
		'bankAccountName' => '',
		'bankAccountNumber' => '',
		'firstName' => '',
		'gender' => array(
			'placeholder' => 'Gender',
			'value' => ''
		),
		'id' => '',
		'lastName' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'username' => ''
	),
	'player' => array(
		'transaction' => array(
			'list' => ''
		)
	)
);

if(!empty($data['player']['transaction']['data'])) {
	
	foreach($data['player']['transaction']['data'] as $key => $value) {
		
		if(!empty($value['stake'])) {
			
			$value['stake'] = number_format($value['stake']);
			
		}
		
		if(!empty($value['winlose'])) {
			
			$value['winlose'] = number_format($value['winlose']);
			
		}
		
		if(!empty($value['rake'])) {
			
			$value['rake'] = number_format($value['rake']);
			
		}
		
		if(!empty($value['point'])) {
			
			$value['point'] = number_format($value['point']);
			
		}
		
		$value['timestamp'] = new DateTime($value['timestamp']);
		
		$view['player']['transaction']['list'] .= '<tr>
			<td><p>'.$value['timestamp']->format('j-m-Y H:i:s').'</p></td>
			<td><p>'.$value['player_username'].'</p></td>
			<td class="load-detail" data-player-transaction-id="'.$value['id'].'"><p>'.$value['stake'].'</p></td>
			<td><p>'.$value['winlose'].'</p></td>
			<td><p>'.$value['rake'].'</p></td>
			<td><p>'.$value['point'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'player_transaction_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-player-transaction-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['bankAccountName'] = $data['filter']['data']['bankAccountName'][0];
	$view['filter']['bankAccountNumber'] = $data['filter']['data']['bankAccountNumber'][0];
	$view['filter']['firstName'] = $data['filter']['data']['firstName'][0];
	
	if(!empty($data['filter']['data']['gender'][0])) {
		
		$view['filter']['gender'] = array(
			'placeholder' => $data['filter']['data']['gender'][0],
			'value' => $data['filter']['data']['gender'][0]
		);
		
	}
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['lastName'] = $data['filter']['data']['lastName'][0];
	
	if(!empty($data['filter']['data']['status'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['status'][0],
			'value' => $data['filter']['data']['status'][0]
		);
		
	}
	
	$view['filter']['username'] = $data['filter']['data']['username'][0];
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="transaction-white square-30 margin-right-10"></i>Player Transaction</h2>
            <div class="pagination">
            	<?php echo $data['player']['transaction']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'player_transaction_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="username" type="text" placeholder="Username" value="<?php echo $view['filter']['username'] ?>">
                <input name="first-name" type="text" placeholder="First Name" value="<?php echo $view['filter']['firstName'] ?>">
                <input name="last-name" type="text" placeholder="Last Name" value="<?php echo $view['filter']['lastName'] ?>">
                <select name="gender">
                	<option value="<?php echo $view['filter']['gender']['value'] ?>"><?php echo $view['filter']['gender']['placeholder'] ?></option>
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <input name="bank-account-name" type="text" placeholder="Bank Account Name" value="<?php echo $view['filter']['bankAccountName'] ?>">
                <input name="bank-account-number" type="text" placeholder="Bank Account Number" value="<?php echo $view['filter']['bankAccountNumber'] ?>">
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button class="filter" name="filter" type="submit"><i class="filter-white square-15 margin-right-10"></i>Filter</button>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>Created Date</p></th>
                    <th><p>Username</p></th>
                    <th><p>Stake</p></th>
                    <th><p>Win/Lose</p></th>
                    <th><p>Rake</p></th>
                    <th><p>Point</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['player']['transaction']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['player']['transaction']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>