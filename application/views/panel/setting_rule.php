<?php
$view = array(
	'page' => array(
		'rule' => array(
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

if(!empty($data['page']['rule']['data'])) {
	
	if(!empty($data['url']['data'])) {
		
		foreach($data['url']['data'] as $key => $value) {
			
			$view['page']['rule']['description'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="description" name="description" placeholder="Description '.$value['name'].'" value="">
			<p class="response description"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['metaDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-description" name="meta-description" placeholder="Meta Description '.$value['name'].'" value="">
			<p class="response meta-description"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['metaKeyword'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-keyword" name="meta-keyword" placeholder="Meta Keyword '.$value['name'].'" value="">
			<p class="response meta-keyword"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['metaTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-title" name="meta-title" placeholder="Meta Title '.$value['name'].'" value="">
			<p class="response meta-title"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['ogTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-title" name="og-title" placeholder="OG Title '.$value['name'].'" value="">
			<p class="response og-title"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['ogDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-description" name="og-description" placeholder="OG Description '.$value['name'].'" value="">
			<p class="response og-description"></p>
			<div class="clearfix"></div>';
			$view['page']['rule']['title'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="title" name="title" placeholder="Title '.$value['name'].'" value="">
			<p class="response title"></p>
			<div class="clearfix"></div>';
			
		}
		
	}
	
	$view['page']['rule']['content'] = $data['page']['rule']['data'][0]['content'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="article-white square-30 margin-right-10"></i>Setting Rule</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<h3>Title</h3>
                	<?php echo $view['page']['rule']['title'] ?>
                    <h3>Description</h3>
                	<?php echo $view['page']['rule']['description'] ?>
                    <h3>Meta Title</h3>
                	<?php echo $view['page']['rule']['metaTitle'] ?>
                    <h3>Meta Description</h3>
                	<?php echo $view['page']['rule']['metaDescription'] ?>
                    <h3>Meta Keyword</h3>
                	<?php echo $view['page']['rule']['metaKeyword'] ?>
                    <h3>OG Title</h3>
                	<?php echo $view['page']['rule']['ogTitle'] ?>
                    <h3>OG Description</h3>
                	<?php echo $view['page']['rule']['ogDescription'] ?>
                    <p class="title">Content</p>
                    <p class="colon">:</p>
                    <div class="clearfix"></div>
                    <div class="rule-content">
                    	<textarea id="ckeditor" class="rule" name="rule"><?php echo $view['page']['rule']['content'] ?></textarea>
                    </div>
                    <p class="response rule-content"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>