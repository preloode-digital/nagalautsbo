<?php
$view = array(
	'page' => array(
		'deposit' => array(
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

if(!empty($data['page']['deposit']['data'])) {
	
	if(!empty($data['url']['data'])) {
		
		foreach($data['url']['data'] as $key => $value) {
			
			$view['page']['deposit']['description'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="description" name="description" placeholder="Description '.$value['name'].'" value="">
			<p class="response description"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['metaDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-description" name="meta-description" placeholder="Meta Description '.$value['name'].'" value="">
			<p class="response meta-description"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['metaKeyword'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-keyword" name="meta-keyword" placeholder="Meta Keyword '.$value['name'].'" value="">
			<p class="response meta-keyword"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['metaTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="meta-title" name="meta-title" placeholder="Meta Title '.$value['name'].'" value="">
			<p class="response meta-title"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['ogTitle'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-title" name="og-title" placeholder="OG Title '.$value['name'].'" value="">
			<p class="response og-title"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['ogDescription'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="og-description" name="og-description" placeholder="OG Description '.$value['name'].'" value="">
			<p class="response og-description"></p>
			<div class="clearfix"></div>';
			$view['page']['deposit']['title'] .= '<p class="title">'.$value['name'].'</p>
			<p class="colon">:</p>
			<input class="title" name="title" placeholder="Title '.$value['name'].'" value="">
			<p class="response title"></p>
			<div class="clearfix"></div>';
			
		}
		
	}
	
	$view['page']['deposit']['content'] = $data['page']['deposit']['data'][0]['content'];
	
}
?>


<div id="content">
    <div class="wrapper">
    	<div class="header">
        	<h2 class="page-title"><i class="article-white square-30 margin-right-10"></i>Setting Deposit</h2>
        </div>
        <div class="content">
        	<div class="detail">
            	<form method="post" action="">
                	<h3>Title</h3>
                	<?php echo $view['page']['deposit']['title'] ?>
                    <h3>Description</h3>
                	<?php echo $view['page']['deposit']['description'] ?>
                    <h3>Meta Title</h3>
                	<?php echo $view['page']['deposit']['metaTitle'] ?>
                    <h3>Meta Description</h3>
                	<?php echo $view['page']['deposit']['metaDescription'] ?>
                    <h3>Meta Keyword</h3>
                	<?php echo $view['page']['deposit']['metaKeyword'] ?>
                    <h3>OG Title</h3>
                	<?php echo $view['page']['deposit']['ogTitle'] ?>
                    <h3>OG Description</h3>
                	<?php echo $view['page']['deposit']['ogDescription'] ?>
                    <p class="title">Content</p>
                    <p class="colon">:</p>
                    <div class="clearfix"></div>
                    <div class="home-deposit">
                    	<textarea id="ckeditor" class="deposit" name="deposit"><?php echo $view['page']['deposit']['content'] ?></textarea>
                    </div>
                    <p class="response home-deposit"></p>
                    <div class="clearfix"></div>
                    <div class="button">
                    	<button class="update" name="update"><i class="pencil-white square-15 margin-right-10"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>