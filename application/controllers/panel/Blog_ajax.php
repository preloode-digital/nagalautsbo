<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_ajax extends CI_Controller {
	
	
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
			'response' => array(
				'response' => '<p>Blog process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteBlog') {
			
			$this->deleteBlog($_POST);
			
		}
		
		else if($_POST['action'] == 'loadBlogDetail') {
			
			$this->loadBlogDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteBlog($data) {
		
		$this->load->model('blog_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$blog = $this->blog_data->loadBindId($load);
					
					if(!empty($blog)) {
						
						$delete = array(
							'id' => $blog[0]['id']
						);
						$this->blog_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Blog successfully deleted!</p>',
							'result' => true
						);
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function loadAdministrator() {
		
		$this->load->model('administrator_data');
		
		if(!empty($_COOKIE['administrator'])) {
			
			$administrator = json_decode($_COOKIE['administrator']);
			
			$load = array(
				'id' => $administrator->id
			);
			$this->initialize['administrator']['account'] = $this->administrator_data->loadBindId($load);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadBlogDetail($data) {
		
		$this->load->model('administrator_data');
		$this->load->model('blog_data');
		$this->load->model('blog_category_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$blog = $this->blog_data->loadBindId($load);
					
					if(!empty($blog)) {
						
						$load = array(
							'id' => $blog[0]['administrator_id']
						);
						$administrator = $this->administrator_data->loadBindId($load);
						
						$administratorUsername = '';
						
						if(!empty($administrator)) {
							
							$administratorUsername = $administrator[0]['username'];
							
						}
						
						$load = array(
							'id' => $blog[0]['category_id']
						);
						$blogCategory = $this->blog_category_data->loadBindId($load);
						
						$category = '';
						
						if(!empty($blogCategory)) {
							
							$category = $blogCategory[0]['name'];
							
						}
						
						$blog[0]['timestamp'] = new DateTime($blog[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Title</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['title'].'</p>
							<div class="clearfix"></div>
							<p class="title">Description</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['description'].'</p>
							<div class="clearfix"></div>
							<p class="title">URL</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['url'].'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Title</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['meta_title'].'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Description</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['meta_description'].'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Keyword</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['meta_keyword'].'</p>
							<div class="clearfix"></div>
							<p class="title">Category</p>
							<p class="colon">:</p>
							<p class="detail">'.$category.'</p>
							<div class="clearfix"></div>
							<p class="title">Administrator</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorUsername.'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$blog[0]['timestamp']->format('j-m-Y H:i:s').'</p>
							<div class="clearfix"></div>',
							'result' => true
						);
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>