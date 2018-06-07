<?php
$view = array(
	'blog' => array(
		'list' => '<h3 class="empty">Still don\'t have article yet</h3>'
	),
	'button' => array(
		'list' => ''
	),
	'category' => array(
		'id' => 0,
		'list' => '<ul class="category">
			<li><a href="'.base_url().'blog/#"><p class="m-font">Still don\'t have category yet</p></a></li>
		</ul>'
	)
);

if(!empty($data['blog']['data'])) {
	
	$view['blog']['list'] = '';
	$i = 0;
	
	foreach($data['blog']['data'] as $key => $value) {
		
		$value['timestamp'] = new DateTime($value['timestamp']);
		
		$view['blog']['list'] .= '<a href="'.base_url().'blog_post/'.$value['url'].'/">
			<div class="grid">
				<div class="image">
					<img class="responsive" src="'.base_url().$value['picture'].'" alt="'.$value['title'].$this->config->item('site_name').' Article">
				</div>
				<div class="title">
					<h3>'.$value['title'].'</h3>
					<p class="article">'.$value['description'].'</p>
					<p class="date">'.$value['timestamp']->format('j-F-Y').'</p>
				</div>
			</div>
		</a>';
		
		$i++;
		
	}
	
	if(!empty($data['blog']['category']['current'])) {
		
		$view['category']['id'] = $data['blog']['category']['current'][0]['id'];
		
	}
	
	if($data['blog']['offset'] == $i) {
		
		$view['button']['list'] = '<div class="load">
			<p class="load-blog" data-category-id="'.$view['category']['id'].'" data-offset="'.$data['blog']['offset'].'">Load More</p>
		</div>';
		
	}
	
}

if(!empty($data['blog']['category']['data'])) {
	
	function loop($list, $parentId, $level = 0) {
		
		$child = false;
		$result = '<ul class="category">';
		
		foreach($list as $key => $value) {
			
			if($value['parent_id'] == $parentId) {
				
				$child = true;
				$result .= '<li><a href="'.base_url().'blog/'.$value['url'].'/"><p class="m-font">'.$value['name'].'</p></a>';
				$level++;
				$result .= loop($list, $value['id'], $level);
				$level = $level - 1;
				$result .= '</li>';
				
			}
			
		}
		
		$result .= '</ul>';
		
		if($child == false) {
			
			$result = '';
			
		}
		
		return $result;
		
	}
	
	$view['category']['list'] = loop($data['blog']['category']['data'], 0, 0);
	
}
?>


<div id="content">
	<div class="wrapper">
    	<div class="content">
        	<div class="header">
            	<h2>Blog</h2>
            </div>
            <div class="category">
            	<p class="load-category m-font">Category<i class="toggle-20-white"></i></p>
                <?php echo $view['category']['list'] ?>
            </div>
            <div class="blog">
            	<?php echo $view['blog']['list'] ?>
            </div>
            <div class="clear"></div>
            <?php echo $view['button']['list'] ?>
        </div>
    </div>
</div>