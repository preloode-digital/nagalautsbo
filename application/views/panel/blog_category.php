<?php
$view = array(
	'blog' => array(
		'category' => array(
			'list' => ''
		)
	),
	'filter' => array(
		'administrator' => array(
			'placeholder' => 'Administrator',
			'value' => ''
		),
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'url' => ''
	),
	'option' => array(
		'administrator' => ''
	)
);

if(!empty($data['blog']['category']['data'])) {
	
	foreach($data['blog']['category']['data'] as $key => $value) {
		
		$administrator = '';
		
		$view['blog']['category']['list'] .= '<tr>
			<td><p>'.$value['id'].'</p></td>
			<td class="load-detail" data-blog-category-id="'.$value['id'].'"><p>'.$value['name'].'</p></td>
			<td><p>'.$value['url'].'</p></td>
			<td><p>'.$value['status'].'</p></td>
			<td>
				<a href="'.$this->config->item('panel_url').'blog_category_entry/'.$value['id'].'/"><p class="action"><i class="pencil-white square-15 margin-right-10"></i>Edit</p></a>
				<button class="delete action" data-blog-category-id="'.$value['id'].'"><i class="trash-white square-15 margin-right-10"></i>Delete</button>
			</td>
		</tr>';
		
	}
	
}

if(!empty($data['filter']['data'])) {
	
	$view['filter']['firstName'] = $data['filter']['data']['firstName'][0];
	
	if(!empty($view['filter']['data']['gender'])) {
		
		$view['filter']['gender'] = array(
			'placeholder' => $data['filter']['data']['gender'][0],
			'value' => $data['filter']['data']['gender'][0]
		);
		
	}
	
	$view['filter']['id'] = $data['filter']['data']['id'][0];
	$view['filter']['lastName'] = $data['filter']['data']['lastName'][0];
	$view['filter']['role']['value'] = $data['filter']['data']['role'][0];
	
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
        	<h2 class="page-title"><i class="category-white square-30 margin-right-10"></i>Blog Category</h2>
            <div class="pagination">
            	<?php echo $data['blog']['category']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
            <form method="post" action="">
            	<button class="refresh" name="refresh" type="submit"><i class="refresh-white square-15 margin-right-10"></i>Refresh</button>
            </form>
            <a class="add-new" href="<?php echo $this->config->item('panel_url').'blog_category_entry/' ?>"><p><i class="add-white square-15 margin-right-10"></i>Add New</p></a>
            <div class="clearfix"></div>
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
                <select name="administrator">
                	<option value="<?php echo $view['filter']['administrator']['value'] ?>"><?php echo $view['filter']['administrator']['placeholder'] ?></option>
                    <option value="">Administrator</option>
                    <?php echo $view['option']['administrator'] ?>
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
                    <th><p>URL</p></th>
                    <th><p>Status</p></th>
                    <th><p>Action</p></th>
                </tr>
                <?php echo $view['blog']['category']['list'] ?>
            </table>
            <div class="pagination">
            	<?php echo $data['blog']['category']['pagination'] ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>