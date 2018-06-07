<?php
$view = array(
	'game' => array(
		'credit' => '',
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'id' => '',
		'name' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => ''
	)
);

if(!empty($data['game']['data'])) {
	
	$data['game']['data'][0]['credit'] = number_format($data['game']['data'][0]['credit']);
	$data['game']['data'][0]['timestamp'] = new DateTime($data['game']['data'][0]['timestamp']);
	
	$view['game']['credit'] = $data['game']['data'][0]['credit'];
	$view['game']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['game']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['game']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['game']['name'] = $data['game']['data'][0]['name'];
	$view['game']['status'] = array(
		'placeholder' => $data['game']['data'][0]['status'],
		'value' => $data['game']['data'][0]['status']
	);
	$view['game']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['game']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="game-white square-30 margin-right-10"></i>Game Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['game']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['game']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Credit</p>
                    <p class="colon">:</p>
                    <input class="credit" name="credit" type="text" placeholder="Credit" value="<?php echo $view['game']['credit'] ?>">
                    <p class="response credit"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['game']['status']['value'] ?>"><?php echo $view['game']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['game']['timestamp'] ?>
                    <div class="button">
                    	<?php echo $view['game']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>