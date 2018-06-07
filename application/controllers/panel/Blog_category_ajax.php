<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_category_ajax extends CI_Controller {
	
	
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
				'response' => '',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteBlogCategory') {
			
			$this->deleteBlogCategory($_POST);
			
		}
		
		else if($_POST['action'] == 'loadBlogCategoryDetail') {
			
			$this->loadBlogCategoryDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteBlogCategory($data) {
		
		$this->load->model('blog_category_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$blogCategory = $this->blog_category_data->loadBindId($load);
					
					if(!empty($blogCategory)) {
						
						$delete = array(
							'id' => $blogCategory[0]['id']
						);
						$this->blog_category_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Blog category successfully deleted!</p>',
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
	private function loadBlogCategoryDetail($data) {
		
		$this->load->model('administrator_data');
		$this->load->model('blog_category_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$blogCategory = $this->blog_category_data->loadBindId($load);
					
					if(!empty($blogCategory)) {
						
						$load = array(
							'id' => $blogCategory[0]['administrator_id']
						);
						$administrator = $this->administrator_data->loadBindId($load);
						
						$administratorUsername = '';
						
						if(!empty($administrator)) {
							
							$administratorUsername = $administrator[0]['username'];
							
						}
						
						$load = array(
							'id' => $blogCategory[0]['parent_id']
						);
						$parentCategory = $this->blog_category_data->loadBindId($load);
						
						$parent = 'Root';
						
						if(!empty($parentCategory)) {
							
							$parent = $parentCategory[0]['name'];
							
						}
						
						$blogCategory[0]['timestamp'] = new DateTime($blogCategory[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Description</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['description'].'</p>
							<div class="clearfix"></div>
							<p class="title">URL</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['url'].'</p>
							<div class="clearfix"></div>
							<p class="title">Parent</p>
							<p class="colon">:</p>
							<p class="detail">'.$parent.'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Title</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['meta_title'].'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Description</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['meta_description'].'</p>
							<div class="clearfix"></div>
							<p class="title">Meta Keyword</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['meta_keyword'].'</p>
							<div class="clearfix"></div>
							<p class="title">Administrator</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorUsername.'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$blogCategory[0]['timestamp']->format('j-m-Y H:i:s').'</p>
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