<?php
$view = array(
	'filter' => array(
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'url' => ''
	),
	'gallery' => array(
		'list' => ''
	)
);

if(!empty($data['gallery']['data'])) {
	
	foreach($data['gallery']['data'] as $key => $value) {
		
		$view['gallery']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-gallery-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['url'].'</p></td>
			<td><p>'.$value['sequence'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'gallery_entry/'.$value['id'].'/"><p class="action"><i class="pencil-15-white"></i>Edit</p></a>
				<button class="delete action" data-gallery-id="'.$value['id'].'"><i class="trash-15-white"></i>Delete</button>
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
	
	$view['filter']['url'] = $data['filter']['data']['url'][0];
	
}
?>


<div id="content">
	<div class="wrapper">
        <div class="header">
        	<h2 class="page-title"><i class="picture-30-white"></i>Gallery</h2>
            <div class="pagination">
            	<?php echo $data['gallery']['pagination'] ?>
                <div class="clear"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-15-white"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'gallery_entry/' ?>"><p><i class="add-15-white"></i>Add New</p></a>
            <div class="clear"></div>
        </div>
        <div class="filter">
        	<form method="post" action="">
            	<input name="id" type="text" placeholder="#" value="<?php echo $view['filter']['id'] ?>">
                <input name="name" type="text" placeholder="Name" value="<?php echo $view['filter']['name'] ?>">
                <input name="url" type="text" placeholder="URL" value="<?php echo $view['filter']['url'] ?>">
                <select name="status">
                	<option value="<?php echo $view['filter']['status']['value'] ?>"><?php echo $view['filter']['status']['placeholder'] ?></option>
                    <option value="">Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button class="filter" name="filter" type="submit"><i class="filter-15-white"></i>Filter</button>
                <div class="clear"></div>
            </form>
        </div>
        <div class="content">
        	<table>
            	<tr>
                	<th><p>ID</p></th>
                    <th><p>Name</p></th>
                    <th><p>URL</p></th>
                    <th><p>Sequence</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['gallery']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['gallery']['pagination'] ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>