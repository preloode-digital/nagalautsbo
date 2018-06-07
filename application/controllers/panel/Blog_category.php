<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_category extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'administrator' => array(
				'account' => '',
				'browser' => $this->device->getBrowser(),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->device->getOs()
			),
			'blog' => array(
				'category' => array(
					'data' => '',
					'page' => 0,
					'pagination' => '',
					'totalRow' => ''
				)
			),
			'filter' => array(
				'data' => ''
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('panel/footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('administrator_data');
		$this->load->model('administrator_log_data');
		
		if(isset($_COOKIE['administrator'])) {
			
			$this->initialize['administrator']['account'] = json_decode($_COOKIE['administrator']);
			
			$load = array(
				'administrator_id' => $this->initialize['administrator']['account']->id,
				'authentication' => $this->initialize['administrator']['account']->authentication,
				'browser' => $this->initialize['administrator']['browser'],
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->initialize['administrator']['os']
			);
			$log = $this->administrator_log_data->loadBindAdministratorIdAuthenticationBrowserIpOsOrderIdDesc($load);
			
			if(!empty($log)) {
				
				if($log[0]['log'] == 'Logout') {
					
					header('Location: '.$this->config->item('panel_url').'login/');
					
					exit();
					
				}
				
				$load = array(
					'id' => $this->initialize['administrator']['account']->id
				);
				$this->initialize['administrator']['account'] = $this->administrator_data->loadBindId($load);
					
			}
			
			else {
				
				header('Location: '.$this->config->item('panel_url').'login/');
				
				exit();
				
			}
			
		}
		
		else {
			
			header('Location: '.$this->config->item('panel_url').'login/');
			
			exit();
			
		}
		
	}
	
	
	/* Index children method */
	private function checkPrivilege() {
		
		if(empty($this->initialize['administrator']['account'][0]['privilege_blog'])) {
			
			header('Location: '.base_url().'restricted_access/');
			
			exit();
			
		}
		
	}
	
	
	/* Load children method */
	private function filter($data) {
		
		$this->load->library('filter');
		
		$filter = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'input' => array(
				'administrator' => array(
					$data['administrator']
				),
				'id' => array(
					$data['id']
				),
				'name' => array(
					$data['name']
				),
				'status' => array(
					$data['status']
				),
				'url' => array(
					$data['url']
				)
			),
			'name' => 'filter_blog_category',
			'path' => $this->config->item('cookie_path')
		);
		$this->filter->write($filter);
		
		header('Location: '.$_SERVER['REQUEST_URI'].'');
		
		exit();
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->checkPrivilege();
		
		if(isset($_POST['filter'])) {
			
			$this->filter($_POST);
			
		}
		
		else if(isset($_POST['refresh'])) {
			
			$this->refresh();
			
		}
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$this->loadBlogCategoryPagination();
		
		$this->loadFilter();
		
		$data = array(
			'data' => array(
				'blog' => $this->initialize['blog'],
				'filter' => $this->initialize['filter']
			)
		);
		$this->load->view('panel/blog_category', $data);
		
	}
	
	
	/* Load children method */
	private function loadBlogCategoryPagination() {
		
		$this->load->model('blog_category_data');
		$this->load->library('pagination');
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['blog']['category']['page'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3)) - 1;
			
		}
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator',
				'id' => 'id',
				'name' => 'name',
				'status' => 'status',
				'url' => 'url'
			),
			'name' => 'filter_blog_category'
		);
		$this->initialize['blog']['category']['totalRow'] = count($this->blog_category_data->loadIdPagination($load));
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = $this->config->item('panel_url').'blog_category';
		$pagination['total_rows'] = $this->initialize['blog']['category']['totalRow'];
		$this->pagination->initialize($pagination);
		$this->initialize['blog']['category']['pagination'] = $this->pagination->create_links();
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator',
				'id' => 'id',
				'name' => 'name',
				'status' => 'status',
				'url' => 'url'
			),
			'offset' => $pagination['per_page'] * $this->initialize['blog']['category']['page'],
			'limit' => $pagination['per_page'],
			'name' => 'filter_blog_category'
		);
		$this->initialize['blog']['category']['data'] = $this->blog_category_data->loadPagination($load);
		
	}
	
	
	/* Load children method */
	private function loadFilter() {
		
		if(!empty($_COOKIE['filter_blog_category'])) {
			
			$filter = (array) json_decode($_COOKIE['filter_blog_category']);
			$input = array();
			
			if(!empty($filter)) {
				
				foreach($filter as $key => $value) {
					
					$input[$key] = (array) $value;
					
				}
				
			}
			
			if(!empty($input)) {
				
				foreach($input as $key => $value) {
					
					if($key == $this->initialize['administrator']['account'][0]['id']) {
						
						$this->initialize['filter']['data'] = $value;
						
					}
					
				}
				
			}
			
		}
		
	}
	
	
	/* Load children method */
	private function refresh() {
		
		$this->load->library('filter');
		
		$filter = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'name' => 'filter_blog_category',
			'path' => $this->config->item('cookie_path')
		);
		$this->filter->remove($filter);
		
		header('Location: '.$_SERVER['REQUEST_URI'].'');
		
		exit();
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'blog_category'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'blog_category'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Blog Category'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>