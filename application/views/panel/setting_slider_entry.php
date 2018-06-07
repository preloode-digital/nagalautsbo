<?php
$view = array(
	'slider' => array(
		'alternativeText' => '',
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'id' => '',
		'name' => '',
		'picture' => '',
		'sequence' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		)
	)
);

if(!empty($data['slider']['data'])) {
	
	$view['slider']['alternativeText'] = $data['slider']['data'][0]['alternative_text'];
	$view['slider']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['slider']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['slider']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['slider']['name'] = $data['slider']['data'][0]['name'];
	$view['slider']['picture'] = $data['slider']['data'][0]['picture'];
	$view['slider']['sequence'] = $data['slider']['data'][0]['sequence'];
	$view['slider']['status'] = array(
		'placeholder' => $data['slider']['data'][0]['status'],
		'value' => $data['slider']['data'][0]['status']
	);
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="slide-white square-30 margin-right-10"></i>Setting Slider Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['slider']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['slider']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['slider']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clearfix"></div>
                    <p class="title">Alternative Text</p>
                    <p class="colon">:</p>
                    <input class="alternative-text" name="alternative-text" type="text" placeholder="Alternative Text" value="<?php echo $view['slider']['alternativeText'] ?>">
                    <p class="response alternative-text"></p>
                    <div class="clearfix"></div>
                    <p class="title">Sequence</p>
                    <p class="colon">:</p>
                    <input class="sequence" name="sequence" type="text" placeholder="Sequence" value="<?php echo $view['slider']['sequence'] ?>">
                    <p class="response sequence"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['slider']['status']['value'] ?>"><?php echo $view['slider']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['slider']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>