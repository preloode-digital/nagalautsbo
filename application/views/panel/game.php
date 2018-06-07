<?php
$view = array(
	'game' => array(
		'list' => ''
	),
	'filter' => array(
		'credit' => array(
			'',
			''
		),
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		)
	)
);

if(!empty($data['game']['data'])) {
	
	foreach($data['game']['data'] as $key => $value) {
		
		if(!empty($value['credit'])) {
			
			$value['credit'] = number_format($value['credit']);
			
		}
		
		$view['game']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-game-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['credit'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'game_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-game-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['credit'] = $data['filter']['data']['credit'];
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
        	<h2 class="page-title"><i class="game-white square-30 margin-right-10"></i>Game</h2>
            <div class="pagination">
            	<?php echo $data['game']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'game_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="name" type="text" placeholder="Name" value="<?php echo $view['filter']['name'] ?>">
                <input name="start-credit" type="text" placeholder="Start Credit" value="<?php echo $view['filter']['credit'][0] ?>">
                <input name="end-credit" type="text" placeholder="End Credit" value="<?php echo $view['filter']['credit'][1] ?>">
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
                    <th><p>Credit</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['game']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['game']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>