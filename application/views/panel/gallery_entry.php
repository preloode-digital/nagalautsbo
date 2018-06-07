<?php
$view = array(
	'gallery' => array(
		'button' => '<button class="insert" name="insert"><i class="add-15-white"></i>Add New</button>',
		'id' => '',
		'name' => '',
		'picture' => '',
		'sequence' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => '',
		'video' => ''
	)
);

if(!empty($data['gallery']['data'])) {
	
	$data['gallery']['data'][0]['timestamp'] = new DateTime($data['gallery']['data'][0]['timestamp']);
	
	$view['gallery']['button'] = '<button class="update" name="update"><i class="pencil-15-white"></i>Edit</button>';
	$view['gallery']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['gallery']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clear"></div>';
	$view['gallery']['name'] = $data['gallery']['data'][0]['name'];
	$view['gallery']['picture'] = $data['gallery']['data'][0]['picture'];
	$view['gallery']['sequence'] = $data['gallery']['data'][0]['sequence'];
	$view['gallery']['status'] = array(
		'placeholder' => $data['gallery']['data'][0]['status'],
		'value' => $data['gallery']['data'][0]['status']
	);
	$view['gallery']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['gallery']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clear"></div>';
	$view['gallery']['url'] = $data['gallery']['data'][0]['url'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="picture-30-white"></i>Gallery Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['gallery']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['gallery']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clear"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['gallery']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clear"></div>
                    <p class="title">Video</p>
                    <p class="colon">:</p>
                    <input class="video" name="video" type="text" placeholder="Video" value="<?php echo $view['gallery']['video'] ?>">
                    <p class="response video"></p>
                    <div class="clear"></div>
                    <p class="title">Sequence</p>
                    <p class="colon">:</p>
                    <input class="sequence" name="sequence" type="text" placeholder="Sequence" value="<?php echo $view['gallery']['sequence'] ?>">
                    <p class="response sequence"></p>
                    <div class="clear"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['gallery']['status']['value'] ?>"><?php echo $view['gallery']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clear"></div>
                    <?php echo $view['gallery']['timestamp'] ?>
                    <div class="button">
                    	<?php echo $view['gallery']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>