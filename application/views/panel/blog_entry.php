<?php
$view = array(
	'blog' => array(
		'button' => '<button class="insert" name="insert"><i class="add-white square-15 margin-right-10"></i>Add New</button>',
		'category' => array(
			'placeholder' => 'Category',
			'value' => ''
		),
		'content' => '',
		'description' => '',
		'id' => '',
		'metaDescription' => '',
		'metaKeyword' => '',
		'metaTitle' => '',
		'picture' => '',
		'status' => array(
			'placeholder' => 'Status',
			'value' => ''
		),
		'timestamp' => '',
		'title' => '',
		'url' => ''
	),
	'option' => array(
		'category' => ''
	)
);

if(!empty($data['blog']['data'])) {
	
	$data['blog']['data'][0]['timestamp'] = new DateTime($data['blog']['data'][0]['timestamp']);
	
	$view['blog']['button'] = '<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>';
	$view['blog']['content'] = $data['blog']['data'][0]['content'];
	$view['blog']['description'] = $data['blog']['data'][0]['description'];
	$view['blog']['id'] = '<p class="title">ID</p>
	<p class="colon">:</p>
	<input class="id" name="id" type="text" placeholder="ID" value="'.$data['blog']['data'][0]['id'].'" readonly>
	<p class="response id"></p>
	<div class="clearfix"></div>';
	$view['blog']['metaDescription'] = $data['blog']['data'][0]['meta_description'];
	$view['blog']['metaKeyword'] = $data['blog']['data'][0]['meta_keyword'];
	$view['blog']['metaTitle'] = $data['blog']['data'][0]['meta_title'];
	$view['blog']['picture'] = $data['blog']['data'][0]['picture'];
	$view['blog']['title'] = $data['blog']['data'][0]['title'];
	$view['blog']['status'] = array(
		'placeholder' => $data['blog']['data'][0]['status'],
		'value' => $data['blog']['data'][0]['status']
	);
	$view['blog']['timestamp'] = '<p class="title">Created Date</p>
	<p class="colon">:</p>
	<input name="timestamp" type="text" placeholder="Created Date" value="'.$data['blog']['data'][0]['timestamp']->format('j-m-Y H:i:s').'" readonly>
	<p class="response timestamp"></p>
	<div class="clearfix"></div>';
	$view['blog']['url'] = $data['blog']['data'][0]['url'];
	
}

if(!empty($data['blog']['category']['data'])) {
	
	$GLOBALS['category'] = array(
		'placeholder' => 'Category',
		'value' => ''
	);
	
	function loop($category, $list, $parentId, $level = 0, $prefix = '') {
		
		$child = false;
		$result = '';
		
		foreach($list as $key => $value) {
			
			if($value['parent_id'] == $parentId) {
				
				if($level > 0) {
					
					$prefix .= ' --- ';
					
				}
				
				if($value['id'] == $category) {
					
					$GLOBALS['category'] = array(
						'placeholder' => $prefix.$value['name'],
						'value' => $value['id']
					);
					
				}
				
				$child = true;
				$result .= '<option value="'.$value['id'].'">'.$prefix.$value['name'].'</option>';
				
				$level++;
				$result .= loop($category, $list, $value['id'], $level, $prefix);
				$level = $level - 1;
				$prefix = preg_replace('#[ -]#', '', $prefix, 1);
				
			}
			
		}
		
		if($child == false) {
			
			$result = '';
			
		}
		
		return $result;
		
	}
	
	$category = '';
	
	if(!empty($data['blog']['data'])) {
		
		$category = $data['blog']['data'][0]['category_id'];
		
	}
	
	$view['option']['category'] = loop($category, $data['blog']['category']['data'], 0, 0, '');
	$view['blog']['category'] = $GLOBALS['category'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="article-white square-30 margin-right-10"></i>Blog Article Entry</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<?php echo $view['blog']['id'] ?>
                    <p class="title">Title</p>
                    <p class="colon">:</p>
                    <input class="title" name="title" type="text" placeholder="Title" value="<?php echo $view['blog']['title'] ?>">
                    <p class="response title"></p>
                    <div class="clearfix"></div>
                    <p class="title">Description</p>
                    <p class="colon">:</p>
                    <textarea class="description" name="description"><?php echo $view['blog']['description'] ?></textarea>
                    <p class="response description"></p>
                    <div class="clearfix"></div>
                    <p class="title">URL</p>
                    <p class="colon">:</p>
                    <input class="url" name="url" type="text" placeholder="URL" value="<?php echo $view['blog']['url'] ?>">
                    <p class="response url"></p>
                    <div class="clearfix"></div>
                    <p class="title">Category</p>
                    <p class="colon">:</p>
                    <select class="category" name="category">
                    	<option value="<?php echo $view['blog']['category']['value'] ?>"><?php echo $view['blog']['category']['placeholder'] ?></option>
                        <?php echo $view['option']['category'] ?>
                    </select>
                    <p class="response category"></p>
                    <div class="clearfix"></div>
                    <p class="title">Picture</p>
                    <p class="colon">:</p>
                    <input class="picture-file" name"picture-file" type="file" placeholder="Upload Picture">
                    <input class="picture" name="picture" type="text" placeholder="Picture" value="<?php echo $view['blog']['picture'] ?>">
                    <p class="response picture"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Title</p>
                    <p class="colon">:</p>
                    <input class="meta-title" name="meta-title" type="text" placeholder="Meta Title" value="<?php echo $view['blog']['metaTitle'] ?>">
                    <p class="response meta-title"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Description</p>
                    <p class="colon">:</p>
                    <textarea class="meta-description" name="meta-description"><?php echo $view['blog']['metaDescription'] ?></textarea>
                    <p class="response meta-description"></p>
                    <div class="clearfix"></div>
                    <p class="title">Meta Keyword</p>
                    <p class="colon">:</p>
                    <input class="meta-keyword" name="meta-keyword" type="text" placeholder="Meta Keyword" value="<?php echo $view['blog']['metaKeyword'] ?>">
                    <p class="response meta-title"></p>
                    <div class="clearfix"></div>
                    <p class="title">Status</p>
                    <p class="colon">:</p>
                    <select class="status" name="status">
                    	<option value="<?php echo $view['blog']['status']['value'] ?>"><?php echo $view['blog']['status']['placeholder'] ?></option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <p class="response status"></p>
                    <div class="clearfix"></div>
                    <?php echo $view['blog']['timestamp'] ?>
                    <p class="title">Content</p>
                    <p class="colon">:</p>
                    <div class="blog-content">
                    	<textarea id="ckeditor" class="content" name="content"><?php echo $view['blog']['content'] ?></textarea>
                    </div>
                    <p class="response content"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<?php echo $view['blog']['button'] ?>
                    </div>
                </form>
            </div>
        </div>
    </div>