<?php
$view = array(
	'url' => array(
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'url' => ''
	)
);

if(!empty($data['url']['data'])) {
	
	$view['url']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['url']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['url']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['url']['name'] = $data['url']['data'][0]['name'];
	$view['url']['status'] = array(
		'placeholder' => $data['url']['data'][0]['status'],
		'value' => $data['url']['data'][0]['status']
	);
	$view['url']['url'] = $data['url']['data'][0]['url'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="link-white square-30 margin-right-10"></i>Setting URL Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['url']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['url']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">URL</p>
                    <p class="colon">:</p>
                    <input class="url" name="url" type="text" placeholder="URL" value="<?php echo $view['url']['url'] ?>">
                    <p class="response url"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['url']['status']['value'] ?>"><?php echo $view['url']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['url']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>