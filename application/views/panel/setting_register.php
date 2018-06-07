<?php
$view = array(
	'page' => array(
		'register' => array(
			'content' => '',
			'description' => '',
			'metaDescription' => '',
			'metaKeyword' => '',
			'metaTitle' => '',
			'ogDescription' => '',
			'ogTitle' => '',
			'title' => ''
		)
	)
);

if(!empty($data['page']['register']['data'])) {
	
	if(!empty($data['url']['data'])) {
		
		foreach($data['url']['data'] as $key => $value) {
			
			$view['page']['register']['description'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="description" name="description" placeholder="Description '.$value['name'].'" value="">
			<p class="response description"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['metaDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-description" name="meta-description" placeholder="Meta Description '.$value['name'].'" value="">
			<p class="response meta-description"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['metaKeyword'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-keyword" name="meta-keyword" placeholder="Meta Keyword '.$value['name'].'" value="">
			<p class="response meta-keyword"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['metaTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-title" name="meta-title" placeholder="Meta Title '.$value['name'].'" value="">
			<p class="response meta-title"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['ogTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-title" name="og-title" placeholder="OG Title '.$value['name'].'" value="">
			<p class="response og-title"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['ogDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-description" name="og-description" placeholder="OG Description '.$value['name'].'" value="">
			<p class="response og-description"></p>
			<div class="clearfix"></div>';
			$view['page']['register']['title'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="title" name="title" placeholder="Title '.$value['name'].'" value="">
			<p class="response title"></p>
			<div class="clearfix"></div>';
			
		}
		
	}
	
	$view['page']['register']['content'] = $data['page']['register']['data'][0]['content'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="article-white square-30 margin-right-10"></i>Setting Register</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<h3>Title</h3>
                	<?php echo $view['page']['register']['title'] ?>
                    <h3>Description</h3>
                	<?php echo $view['page']['register']['description'] ?>
                    <h3>Meta Title</h3>
                	<?php echo $view['page']['register']['metaTitle'] ?>
                    <h3>Meta Description</h3>
                	<?php echo $view['page']['register']['metaDescription'] ?>
                    <h3>Meta Keyword</h3>
                	<?php echo $view['page']['register']['metaKeyword'] ?>
                    <h3>OG Title</h3>
                	<?php echo $view['page']['register']['ogTitle'] ?>
                    <h3>OG Description</h3>
                	<?php echo $view['page']['register']['ogDescription'] ?>
                    <p class="title">Content</p>
                    <p class="colon">:</p>
                    <div class="clearfix"></div>
                    <div class="register-content">
                    	<textarea id="ckeditor" class="register" name="register"><?php echo $view['page']['register']['content'] ?></textarea>
                    </div>
                    <p class="response register-content"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>