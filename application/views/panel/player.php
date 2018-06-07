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
		'list' => ''
	)
);

if(!empty($data['player']['data'])) {
	
	foreach($data['player']['data'] as $key => $value) {
		
		$name = $value['first_name'];
		
		if(!empty($value['middle_name'])) {
			
			$name .= ' '.$value['middle_name'];
			
		}
		
		if(!empty($value['last_name'])) {
			
			$name .= ' '.$value['last_name'];
			
		}
		
		$credit = 0;
		
		if(!empty($data['player']['index'])) {
			
			for($i = 0; $i < count($data['player']['index']); $i++) {
				
				if($data['player']['index'][$i]['player_id'] == $value['id']) {
					
					if(!empty($data['player']['index'][$i]['credit'])) {
						
						$credit += $data['player']['index'][$i]['credit'];
						
					}
					
				}
				
			}
			
		}
		
		$point = 0;
		
		if(!empty($data['player']['transaction']['data'])) {
			
			for($i = 0; $i < count($data['player']['transaction']['data']); $i++) {
				
				if($data['player']['transaction']['data'][$i]['player_id'] == $value['id']) {
					
					if(!empty($data['player']['transaction']['data'][$i]['point'])) {
						
						$point += $data['player']['transaction']['data'][$i]['point'];
						
					}
					
				}
				
			}
			
		}
		
		$credit = number_format($credit);
		$point = number_format($point);
		
		$view['player']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-player-id="'.$value['id'].'"><p>'.$value['username'].'</p></td>
			<td><p>'.$name.'</p></td>
			<td><p>'.$credit.'</p></td>
			<td><p>'.$point.'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'player_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-player-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
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
        	<h2 class="page-title"><i class="player-white square-30 margin-right-10"></i>Player</h2>
            <div class="pagination">
            	<?php echo $data['player']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'player_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
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
                	<th><p>ID</p></th>
                    <th><p>Username</p></th>
                    <th><p>Name</p></th>
                    <th><p>Credit</p></th>
                    <th><p>Point</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['player']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['player']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>