<?php
$view = array(
	'filter' => array(
		'id' => '',
		'name' => '',
		'minimumDeposit' => '',
		'sequence' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'type' => array(
			'placeholder' => 'Type',
			'value' => ''
		)
	),
	'promotion' => array(
		'list' => ''
	)
);

if(!empty($data['promotion']['data'])) {
	
	foreach($data['promotion']['data'] as $key => $value) {
		
		$view['promotion']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-promotion-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['percentage'].'</p></td>
			<td><p>'.$value['minimum_deposit'].'</p></td>
			<td><p>'.$value['sequence'].'</p></td>
			<td><p>'.$value['type'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'promotion_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-promotion-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['minimumDeposit'] = $data['filter']['data']['minimumDeposit'][0];
	$view['filter']['name'] = $data['filter']['data']['name'][0];
	$view['filter']['sequence'] = $data['filter']['data']['sequence'][0];
	
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
        	<h2 class="page-title"><i class="promotion-white square-30 margin-right-10"></i>Promotion</h2>
            <div class="pagination">
            	<?php echo $data['promotion']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'promotion_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="name" type="text" placeholder="Name" value="<?php echo $view['filter']['name'] ?>">
                <input name="minimum-deposit" type="text" placeholder="Minimum Deposit" value="<?php echo $view['filter']['minimumDeposit'] ?>">
                <input name="sequence" type="text" placeholder="Sequence" value="<?php echo $view['filter']['sequence'] ?>">
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <select name="type">
                	<option value="<?php echo $view['filter']['type']['value'] ?>"><?php echo $view['filter']['type']['placeholder'] ?></option>
                    <option value="">Type</option>
                    <option value="One Time">One Time</option>
                    <option value="First Deposit">First Deposit</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
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
                    <th><p>Percentage</p></th>
                    <th><p>Minimum Deposit</p></th>
                    <th><p>Sequence</p></th>
                    <th><p>Type</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['promotion']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['promotion']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>