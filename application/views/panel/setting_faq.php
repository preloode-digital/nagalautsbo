<?php
$view = array(
	'page' => array(
		'faq' => array(
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

if(!empty($data['page']['faq']['data'])) {
	
	if(!empty($data['url']['data'])) {
		
		foreach($data['url']['data'] as $key => $value) {
			
			$view['page']['faq']['description'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="description" name="description" placeholder="Description '.$value['name'].'" value="">
			<p class="response description"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['metaDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-description" name="meta-description" placeholder="Meta Description '.$value['name'].'" value="">
			<p class="response meta-description"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['metaKeyword'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-keyword" name="meta-keyword" placeholder="Meta Keyword '.$value['name'].'" value="">
			<p class="response meta-keyword"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['metaTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-title" name="meta-title" placeholder="Meta Title '.$value['name'].'" value="">
			<p class="response meta-title"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['ogTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-title" name="og-title" placeholder="OG Title '.$value['name'].'" value="">
			<p class="response og-title"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['ogDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-description" name="og-description" placeholder="OG Description '.$value['name'].'" value="">
			<p class="response og-description"></p>
			<div class="clearfix"></div>';
			$view['page']['faq']['title'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="title" name="title" placeholder="Title '.$value['name'].'" value="">
			<p class="response title"></p>
			<div class="clearfix"></div>';
			
		}
		
	}
	
	$view['page']['faq']['content'] = $data['page']['faq']['data'][0]['content'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="article-white square-30 margin-right-10"></i>Setting F.A.Q.</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<h3>Title</h3>
                	<?php echo $view['page']['faq']['title'] ?>
                    <h3>Description</h3>
                	<?php echo $view['page']['faq']['description'] ?>
                    <h3>Meta Title</h3>
                	<?php echo $view['page']['faq']['metaTitle'] ?>
                    <h3>Meta Description</h3>
                	<?php echo $view['page']['faq']['metaDescription'] ?>
                    <h3>Meta Keyword</h3>
                	<?php echo $view['page']['faq']['metaKeyword'] ?>
                    <h3>OG Title</h3>
                	<?php echo $view['page']['faq']['ogTitle'] ?>
                    <h3>OG Description</h3>
                	<?php echo $view['page']['faq']['ogDescription'] ?>
                    <p class="title">Content</p>
                    <p class="colon">:</p>
                    <div class="clearfix"></div>
                    <div class="faq-content">
                    	<textarea id="ckeditor" class="faq" name="faq"><?php echo $view['page']['faq']['content'] ?></textarea>
                    </div>
                    <p class="response faq-content"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>