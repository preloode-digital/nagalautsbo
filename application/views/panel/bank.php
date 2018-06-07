<?php
$view = array(
	'bank' => array(
		'list' => ''
	),
	'filter' => array(
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		)
	)
);

if(!empty($data['bank']['data'])) {
	
	foreach($data['bank']['data'] as $key => $value) {
		
		$view['bank']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-bank-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'bank_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-bank-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['name'] = $data['filter']['data']['name'][0];
	
	if(!empty($data['filter']['data']['status'][0])) {
		
		$view['filter']['status'] = array(
			'placeholder' => $data['filter']['data']['status'][0],
			'value' => $data['filter']['data']['status'][0]
		);
		
	}
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="bank-white square-30 margin-right-10"></i>Bank</h2>
            <div class="pagination">
            	<?php echo $data['bank']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'bank_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="name" type="text" placeholder="Name" value="<?php echo $view['filter']['name'] ?>">
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button class="filter" name="filter" type="submit"><i class="filter-white square-15 margin-right-10"></i>Filter</button>
                <div class="clear"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>ID</p></th>
                    <th><p>Name</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['bank']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['bank']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>