<?php
$view = array(
	'menu' => '<li>
		<a href="'.$this->config->item('panel_url').'"><p><i class="dashboard-white square-20 margin-right-10"></i>Dashboard</p></a>
		<div class="clearfix"></div>
		<span></span>
	</li>
	<div class="separator"></div>',
	'name' => '',
	'picture' => base_url().'asset/image/panel/administrator/administrator_picture.png'
);

if(!empty($data['administrator']['account'])) {
	
	if(!empty($data['administrator']['account'][0]['picture'])) {
		
		$view['picture'] = base_url().$data['administrator']['account'][0]['picture'];
		
	}
	
	$view['name'] = $data['administrator']['account'][0]['first_name'];
	
	if(!empty($data['administrator']['account'][0]['middle_name'])) {
		
		$view['name'] .= ' '.$data['administrator']['account'][0]['middle_name'];
		
	}
	
	if(!empty($data['administrator']['account'][0]['last_name'])) {
		
		$view['name'] .= ' '.$data['administrator']['account'][0]['last_name'];
		
	}
	
	if(!empty($data['administrator']['account'][0]['privilege_administrator'])) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_administrator']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li class="menu" data-index="1">
				<a href="'.$this->config->item('panel_url').'administrator/"><p><i class="user-white square-20 margin-right-10"></i>Administrator</p></a>
				<p class="toggle" data-index="1"><i class="toggle-white square-15 menu-toggle"></i></p>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>
			<li class="child-menu" data-index="1">
				<a href="'.$this->config->item('panel_url').'administrator_role/"><p><i class="user-role-white square-20 margin-right-10"></i>Role</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="1"></div>
			<li class="child-menu-hidden child-menu" data-index="1">
				<a href="'.$this->config->item('panel_url').'administrator_role_entry/"><p><i class="user-role-white square-20 margin-right-10"></i>Role Entry</p></a>
			</li>';
			
		}
		
	}
	
	if(!empty($data['administrator']['account'][0]['privilege_bank'])) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_bank']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'bank/"><p><i class="bank-white square-20 margin-right-10"></i>Bank</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_bank_account'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_bank_account']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'bank_account/"><p><i class="bank-account-white square-20 margin-right-10"></i>Bank Account</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_blog'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_blog']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li class="menu" data-index="2">
				<a href="'.$this->config->item('panel_url').'blog/"><p><i class="article-white square-20 margin-right-10"></i>Blog</p></a>
				<p class="toggle" data-index="2"><i class="toggle-white square-15 menu-toggle"></i></p>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>
			<li class="child-menu" data-index="2">
				<a href="'.$this->config->item('panel_url').'blog_category/"><p><i class="category-white square-20 margin-right-10"></i>Category</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="2"></div>
			<li class="child-menu-hidden child-menu" data-index="2">
				<a href="'.$this->config->item('panel_url').'blog_category_entry/"><p><i class="category-white square-20 margin-right-10"></i>Category Entry</p></a>
			</li>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_gallery'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_gallery']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'gallery/"><p><i class="picture-white square-20 margin-right-10"></i>Gallery</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_game'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_game']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'game/"><p><i class="game-white square-20 margin-right-10"></i>Game</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_player'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_player']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li class="menu" data-index="3">
				<a href="'.$this->config->item('panel_url').'player/"><p><i class="player-white square-20 margin-right-10"></i>Player</p></a>
				<p class="toggle" data-index="3"><i class="toggle-white square-15 margin-right-10 menu-toggle"></i></p>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>
			<li class="child-menu" data-index="3">
				<a href="'.$this->config->item('panel_url').'player_transaction/"><p><i class="transaction-white square-20 margin-right-10"></i>Transaction</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="3"></div>
			<li class="child-menu-hidden child-menu" data-index="3">
				<a href="'.$this->config->item('panel_url').'player_transaction_entry/"><p><i class="transaction-white square-20 margin-right-10"></i>Transaction Entry</p></a>
			</li>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_promotion'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_promotion']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'promotion/"><p><i class="promotion-white square-20 margin-right-10"></i>Promotion</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_report'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_report']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li>
				<a href="'.$this->config->item('panel_url').'report/"><p><i class="report-white square-20 margin-right-10"></i>Report</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_setting'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_setting']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li class="menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting/"><p><i class="setting-white square-20 margin-right-10"></i>Setting</p></a>
				<p class="toggle" data-index="4"><i class="toggle-white square-15 margin-right-10 menu-toggle"></i></p>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_url/"><p><i class="link-white square-20 margin-right-10"></i>URL</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_slider/"><p><i class="picture-white square-20 margin-right-10"></i>Slider</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu-hidden child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_url_entry/"><p><i class="link-white square-20 margin-right-10"></i>URL Entry</p></a>
			</li>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_home/"><p><i class="home-white square-20 margin-right-10"></i>Home</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_register/"><p><i class="article-white square-20 margin-right-10"></i>Register</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_deposit/"><p><i class="transaction-white square-20 margin-right-10"></i>Deposit</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_withdrawal/"><p><i class="transaction-white square-20 margin-right-10"></i>Withdrawal</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_game/"><p><i class="game-white square-20 margin-right-10"></i>Game</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_promotion/"><p><i class="promotion-white square-20 margin-right-10"></i>Promotion</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_live_score/"><p><i class="soccer-field-white square-20 margin-right-10"></i>Live Score</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_rule/"><p><i class="article-white square-20 margin-right-10"></i>Rule</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_about_us/"><p><i class="article-white square-20 margin-right-10"></i>About Us</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>
			<li class="child-menu" data-index="4">
				<a href="'.$this->config->item('panel_url').'setting_faq/"><p><i class="article-white square-20 margin-right-10"></i>F.A.Q.</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="4"></div>';
			
		}
		
	}
	
	if($data['administrator']['account'][0]['privilege_transaction'] > 0) {
		
		$privilege = str_split($data['administrator']['account'][0]['privilege_transaction']);
		
		if($privilege[0] > 0) {
			
			$view['menu'] .= '<li class="menu" data-index="5">
				<a href="'.$this->config->item('panel_url').'transaction/"><p><i class="transaction-white square-20 margin-right-10"></i>Transaction</p></a>
				<p class="toggle" data-index="5"><i class="toggle-white square-15 margin-right-10 menu-toggle"></i></p>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator"></div>
			<li class="child-menu" data-index="5">
				<a href="'.$this->config->item('panel_url').'transaction_request/"><p><i class="flow-white square-20 margin-right-10"></i>Request</p></a>
				<div class="clearfix"></div>
				<span></span>
			</li>
			<div class="separator child-menu" data-index="5"></div>';
			
		}
		
	}
	
	$view['menu'] .= '<div class="separator"></div>';
	
}
?>


<div id="sidebar" class="scrollbar">
	<div class="profile">
    	<div class="picture">
        	<img class="responsive" src="<?php echo $view['picture'] ?>" alt="<?php echo $this->config->item('site_name') ?> User <?php echo $view['name'] ?>">
        </div>
        <h2><?php echo $view['name'] ?></h2> 
    </div>
    <div class="clear"></div>
    <ul class="menu">
        <?php echo $view['menu'] ?>
    </ul>
</div>