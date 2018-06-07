<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'response' => array(
				'response' => '',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAccount();
		
		if($_POST['action'] == 'loadBlog') {
			
			$this->loadBlog($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadAccount() {
		
		$this->load->model('player_data');
		
		if(!empty($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'id' => $account->id
			);
			$this->initialize['account']['detail'] = $this->player_data->loadBindId($load);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadBlog($data) {
		
		$this->load->model('blog_data');
		
		$blogArticle = '';
		
		if(!empty($data['categoryId'])) {
			
			$load = array(
				'category_id' => $this->initialize['blog']['category']['current'][0]['id']
			);
			$blog = $this->blog_data->loadBindCategoryIdOrderIdDesc($load);
			
		}
		
		else {
			
			$blog = $this->blog_data->loadOrderIdDesc();
			
		}
		
		if(!empty($blog)) {
			
			$limit = $data['offset'] + 20;
			$i = 0;
			
			foreach($blog as $key => $value) {
				
				if($i >= $data['offset'] && $i <= $limit) {
					
					$this->initialize['response']['response'] .= '<div class="grid">
						<div class="image">
							<img class="responsive" src="'.base_url().$value['picture'].'" alt="'.$value['title'].$this->config->item('site_name').' Article">
						</div>
						<div class="title">
							<h3>'.$value['title'].'</h3>
							<p class="article">'.$value['description'].'</p>
							<p class="date">'.$value['timestamp']->format('j-F-Y').'</p>
						</div>
					</div>';
					
				}
				
				$i++;
				
			}
			
			if(!empty($this->initialize['response']['response'])) {
				
				$this->initialize['response']['offset'] = $limit;
				$this->initialize['response']['result'] = true;
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>