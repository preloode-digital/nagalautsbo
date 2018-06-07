<?php
$view = array(
	'blog' => array(
		'category' => array(
			'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
			'description' => '',
			'id' => '',
			'metaDescription' => '',
			'metaKeyword' => '',
			'metaTitle' => '',
			'name' => '',
			'parent' => array(
				'placeholder' => 'Parent',
				'value' => ''
			),
			'status' => array(
				'placeholder' => 'Status',
				'value' => ''
			),
			'timestamp' => '',
			'url' => ''
		)
	),
	'option' => array(
		'category' => ''
	)
);

if(!empty($data['blog']['category']['data'])) {
	
	$data['blog']['category']['data'][0]['timestamp'] = new DateTime($data['blog']['category']['data'][0]['timestamp']);
	
	$view['blog']['category']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['blog']['category']['description'] = $data['blog']['category']['data'][0]['description'];
	$view['blog']['category']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['blog']['category']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['blog']['category']['metaDescription'] = $data['blog']['category']['data'][0]['meta_description'];
	$view['blog']['category']['metaKeyword'] = $data['blog']['category']['data'][0]['meta_keyword'];
	$view['blog']['category']['metaTitle'] = $data['blog']['category']['data'][0]['meta_title'];
	$view['blog']['category']['name'] = $data['blog']['category']['data'][0]['name'];
	$view['blog']['category']['status'] = array(
		'placeholder' => $data['blog']['category']['data'][0]['status'],
		'value' => $data['blog']['category']['data'][0]['status']
	);
	$view['blog']['category']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['blog']['category']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['blog']['category']['url'] = $data['blog']['category']['data'][0]['url'];
	
}

if(!empty($data['blog']['category']['parent']['data'])) {
	
	$GLOBALS['parent'] = array(
		'placeholder' => 'Parent',
		'value' => ''
	);
	
	function loop($currentParentId, $list, $parentId, $level = 0, $prefix = '') {
		
		$child = false;
		$result = '';
		
		foreach($list as $key => $value) {
			
			if($value['parent_id'] == $parentId) {
				
				if($level > 0) {
					
					$prefix .= ' --- ';
					
				}
				
				if($value['id'] == $currentParentId) {
					
					$GLOBALS['parent'] = array(
						'placeholder' => $prefix.$value['name'],
						'value' => $value['id']
					);
					
				}
				
				$child = true;
				$result .= '<option value="'.$value['id'].'">'.$prefix.$value['name'].'</option>';
				
				$level++;
				$result .= loop($currentParentId, $list, $value['id'], $level, $prefix);
				$level = $level - 1;
				$prefix = preg_replace('#[ -]#', '', $prefix, 1);
				
			}
			
		}
		
		if($child == false) {
			
			$result = '';
			
		}
		
		return $result;
		
	}
	
	$parent = '';
	
	if(!empty($data['blog']['category']['data'])) {
		
		$parent = $data['blog']['category']['data'][0]['parent_id'];
		
	}
	
	$view['option']['category'] = loop($parent, $data['blog']['category']['parent']['data'], 0, 0, '');
	
	$view['blog']['category']['parent'] = $GLOBALS['parent'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="category-white square-30 margin-right-10"></i>Blog Category Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['blog']['category']['id'] ?>
                    <p class="title">Name</p>
                    <p class="colon">:</p>
                    <input class="name" name="name" type="text" placeholder="Name" value="<?php echo $view['blog']['category']['name'] ?>">
                    <p class="response name"></p>
                    <div class="clearfix"></div>
                    <p class="title">Description</p>
                    <p class="colon">:</p>
                    <textarea class="description" name="description"><?php echo $view['blog']['category']['description'] ?></textarea>
                    <p class="response description"></p>
                    <div class="clearfix"></div>
                    <p class="title">URL</p>
                    <p class="colon">:</p>
                    <input class="url" name="url" type="text" placeholder="URL" value="<?php echo $view['blog']['category']['url'] ?>">
                    <p class="response url"></p>
                    <div class="clearfix"></div>
                    <p class="title">Parent</p>
                    <p class="colon">:</p>
                    <select class="parent" name="parent">
                    	<option value="<?php echo $view['blog']['category']['parent']['value'] ?>"><?php echo $view['blog']['category']['parent']['placeholder'] ?></option>
                        <option value="">Parent</option>
                        <?php echo $view['option']['category'] ?>
                    </select>
                    <p class="response parent"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Title</p>
                    <p class="colon">:</p>
                    <input class="meta-title" name="meta-title" type="text" placeholder="Meta Title" value="<?php echo $view['blog']['category']['metaTitle'] ?>">
                    <p class="response meta-title"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Description</p>
                    <p class="colon">:</p>
                    <textarea class="meta-description" name="meta-description"><?php echo $view['blog']['category']['metaDescription'] ?></textarea>
                    <p class="response meta-description"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Keyword</p>
                    <p class="colon">:</p>
                    <input class="meta-keyword" name="meta-keyword" type="text" placeholder="Meta Keyword" value="<?php echo $view['blog']['category']['metaKeyword'] ?>">
                    <p class="response meta-keyword"></p>
                    <div class="clearfix"></div>
                    
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['blog']['category']['status']['value'] ?>"><?php echo $view['blog']['category']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['blog']['category']['timestamp'] ?>
                    <div class="button">
                    	<?php echo $view['blog']['category']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>