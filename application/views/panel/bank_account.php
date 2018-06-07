<?php
$view = array(
	'bank' => array(
		'account' => array(
			'list' => ''
		)
	),
	'filter' => array(
		'bank' => array(
			'placeholder' => 'Bank',
			'value' => ''
		),
		'id' => '',
		'name' => '',
		'number' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'type' => array(
			'placeholder' => 'Type',
			'value' => ''
		)
	),
	'option' => array(
		'bank' => ''
	)
);

if(!empty($data['bank']['account']['data'])) {
	
	foreach($data['bank']['account']['data'] as $key => $value) {
		
		$bank = '';
		
		if(!empty($data['bank']['data'])) {
			
			for($i = 0; $i < count($data['bank']['data']); $i++) {
				
				if($data['bank']['data'][$i]['id'] == $value['bank_id']) {
					
					$bank = $data['bank']['data'][$i]['name'];
					
				}
				
			}
			
		}
		$view['bank']['account']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-bank-account-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['number'].'</p></td>
			<td><p>'.$bank.'</p></td>
			<td><p>'.$value['type'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'bank_account_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-bank-account-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	if(!empty($data['filter']['data']['bank'][0])) {
		
		$view['filter']['bank'] = array(
			'placeholder' => $data['filter']['data']['bank'][0],
			'value' => $data['filter']['data']['bank'][0]
		);
		
	}
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['name'] = $data['filter']['data']['name'][0];
	$view['filter']['number'] = $data['filter']['data']['number'][0];
	
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
        	<h2 class="page-title"><i class="bank-account-white square-30 margin-right-10"></i>Bank Account</h2>
            <div class="pagination">
            	<?php echo $data['bank']['account']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'bank_account_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="name" type="text" placeholder="Name" value="<?php echo $view['filter']['name'] ?>">
                <input name="number" type="text" placeholder="Number" value="<?php echo $view['filter']['number'] ?>">
                <select name="bank">
                	<option value="<?php echo $view['filter']['bank']['value'] ?>"><?php echo $view['filter']['bank']['placeholder'] ?></option>
                    <option value="">Bank</option>
                    <?php echo $view['option']['bank'] ?>
                </select>
                <select name="type">
                	<option value="<?php echo $view['filter']['type']['value'] ?>"><?php echo $view['filter']['type']['placeholder'] ?></option>
                    <option value="">Type</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdraw">Withdraw</option>
                    <option value="Saving">Saving</option>
                    <option value="Expense">Expense</option>
                </select>
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
                    <th><p>Name</p></th>
                    <th><p>Number</p></th>
                    <th><p>Bank</p></th>
                    <th><p>Type</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['bank']['account']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['bank']['account']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>