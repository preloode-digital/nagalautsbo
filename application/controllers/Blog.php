<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'blog' => array(
				'all' => '',
				'category' => array(
					'data' => array(),
					'current' => array()
				),
				'data' => array(),
				'offset' => '',
				'page' => 0,
				'pagination' => '',
				'totalRow' => 0,
			),
			'meta' => array(
				'description' => '',
				'keyword' => '',
				'title' => ''
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		$this->load->model('player_log_data');
		
		if(!empty($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'authentication' => $account->authentication,
				'player_id' => $account->id
			);
			$log = $this->player_log_data->loadBindAuthenticationPlayerId($load);
			
			if(!empty($log)) {
				
				$load = array(
					'id' => $account->id
				);
				$this->initialize['account']['detail'] = $this->player_data->loadBindId($load);
				
				if(!empty($this->initialize['account']['detail'])) {
					
					$this->initialize['account']['detail'][0]['credit'] = 0;
					
					$load = array(
						'player_id' => $this->initialize['account']['detail'][0]['id']
					);
					$playerIndex = $this->player_index_data->loadBindPlayerIdOrderGameNameAsc($load);
					
					if(!empty($playerIndex)) {
						
						foreach($playerIndex as $key => $value) {
							
							$this->initialize['account']['detail'][0]['credit'] += $value['credit'];
							
						}
						
					}
					
				}
				
			}
			
		}
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'blog' => $this->initialize['blog']
			)
		);
		$this->load->view('blog', $data);
		
	}
	
	
	/* Load children method */
	private function loadBlog() {
		
		$this->load->model('blog_data');
		
		if(!empty($this->uri->segment(2))) {
			
			$url = preg_replace('#[^0-9A-Za-z\s-]#', '', $this->uri->segment(2));
			$url = preg_replace('#[\s]#', '-', $url);
			$url = strtolower($url);
			
			$load = array(
				'url' => $url
			);
			
			if(!empty($this->initialize['blog']['category']['data'])) {
				
				foreach($this->initialize['blog']['category']['data'] as $key => $value) {
					
					if($value['url'] == $url) {
						
						$this->initialize['blog']['category']['current'][] = $value;
						
					}
					
				}
				
			}
			
			if(!empty($this->initialize['blog']['category']['current'])) {
				
				$load = array(
					'category_id' => $this->initialize['blog']['category']['current'][0]['id']
				);
				$this->initialize['blog']['all'] = $this->blog_data->loadBindCategoryIdOrderIdDesc($load);
				
			}
			
		}
		
		else {
			
			$this->initialize['blog']['all'] = $this->blog_data->loadOrderIdDesc();
			
		}
		
		if(!empty($this->initialize['blog']['all'])) {
			
			$this->initialize['blog']['offset'] = 19;
			$i = 0;
			
			foreach($this->initialize['blog']['all'] as $key => $value) {
				
				if($i >= 0 && $i <= $this->initialize['blog']['offset']) {
					
					$this->initialize['blog']['data'][] = $value;
					
				}
				
				$i++;
				
			}
			
		}
		
	}
	
	
	/* Load children method */
	private function loadBlogCategory() {
		
		$this->load->model('blog_category_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['blog']['category']['data'] = $this->blog_category_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$this->loadBlogCategory();
		
		$this->loadBlog();
		
		if(!empty($this->initialize['blog']['category']['current'])) {
			
			if(!empty($this->initialize['blog']['category']['current'][0]['meta_title'])) {
				
				$this->initialize['meta']['title'] = $this->initialize['blog']['category']['current'][0]['meta_title'];
				
			}
			
			if(!empty($this->initialize['blog']['category']['current'][0]['meta_description'])) {
				
				$this->initialize['meta']['description'] = $this->initialize['blog']['category']['current'][0]['meta_description'];
				
			}
			
			if(!empty($this->initialize['blog']['category']['current'][0]['meta_keyword'])) {
				
				$this->initialize['meta']['keyword'] = $this->initialize['blog']['category']['current'][0]['meta_keyword'];
				
			}
			
		}
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account']['detail'],
				'css' => array(
					'blog'
				),
				'description' => $this->initialize['meta']['description'],
				'javascript' => array(
					'blog'
				),
				'keywords' => $this->initialize['meta']['keyword'],
				'name' => $this->initialize['meta']['title']
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>