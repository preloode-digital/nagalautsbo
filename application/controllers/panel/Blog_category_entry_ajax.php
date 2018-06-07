<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_category_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Blog category failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertBlogCategory') {
			
			$this->insertBlogCategory($_POST);
			
		}
		
		else if($_POST['action'] == 'updateBlogCategory') {
			
			$this->updateBlogCategory($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertBlogCategory($data) {
		
		$this->load->model('blog_category_data');
		
		if(empty($data['url'])) {
			
			$data['url'] = preg_replace('#[^0-9A-Za-z\s-]#', '', $data['name']);
			$data['url'] = preg_replace('#[\s]#', '-', $data['url']);
			$data['url'] = strtolower($data['url']);
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$blogCategory = $this->blog_category_data->loadBindName($load);
					
					if(empty($blogCategory)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Blog category name already exist!</p>';
						
					}
					
					$load = array(
						'url' => $data['url']
					);
					$blogCategory = $this->blog_category_data->loadBindUrl($load);
					
					$url = $data['url'];
					$i = 1;
					
					while(!empty($blogCategory)) {
						
						$url = $data['url'].'-'.$i;
						
						$load = array(
							'url' => $data['url'].'-'.$i
						);
						$blogCategory = $this->blog_category_data->loadBindUrl($load);
						
						$i++;
						
					}
					
					$data['url'] = $url;
					
					$currentId = $this->blog_category_data->loadAutoIncrement();
					
					$data['path'] = $currentId[0]['AUTO_INCREMENT'];
					
					if(!empty($data['parent'])) {
						
						$load = array(
							'id' => $data['parent']
						);
						$blogCategory = $this->blog_category_data->loadBindId($load);
						
						if(!empty($blogCategory)) {
							
							$data['parent'] = $blogCategory[0]['id'];
							$data['path'] = $blogCategory[0]['path'].'/'.$currentId[0]['AUTO_INCREMENT'];
							
						}
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$insert = array(
							'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
							'description' => $data['description'],
							'meta_description' => $data['metaDescription'],
							'meta_keyword' => $data['metaKeyword'],
							'meta_title' => $data['metaTitle'],
							'name' => $data['name'],
							'parent_id' => $data['parent'],
							'path' => $data['path'],
							'status' => $data['status'],
							'url' => $data['url']
						);
						$this->blog_category_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Blog category successfully added!</p>',
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
	private function updateBlogCategory($data) {
		
		$this->load->model('blog_category_data');
		
		if(empty($data['url'])) {
			
			$data['url'] = preg_replace('#[^0-9A-Za-z\s-]#', '', $data['name']);
			$data['url'] = preg_replace('#[\s]#', '-', $data['url']);
			$data['url'] = strtolower($data['url']);
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_report']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$blogCategory = $this->blog_category_data->loadBindName($load);
					
					if(empty($blogCategory)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($blogCategory[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($blogCategory[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Blog category name already exist!</p>';
								
							}
							
						}
						
					}
					
					$load = array(
						'url' => $data['url']
					);
					$blogCategory = $this->blog_category_data->loadBindUrl($load);
					
					$url = $data['url'];
					$i = 1;
					
					while(!empty($blogCategory)) {
						
						if($blogCategory[0]['id'] != $data['id']) {
							
							$url = $data['url'].'-'.$i;
							
						}
						
						$load = array(
							'url' => $data['url'].'-'.$i
						);
						$blogCategory = $this->blog_category_data->loadBindUrl($load);
						
						$i++;
						
					}
					
					$data['url'] = $url;
					
					$load = array(
						'id' => $data['parent']
					);
					$blogCategory = $this->blog_category_data->loadBindId($load);
					
					$data['path'] = $data['id'];
					
					if(!empty($blogCategory)) {
						
						$data['parent'] = $blogCategory[0]['id'];
						$data['path'] = $blogCategory[0]['path'].'/'.$data['id'];
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$load = array(
							'id' => $data['id']
						);
						$blogCategory = $this->blog_category_data->loadBindId($load);
						
						if(!empty($blogCategory)) {
							
							$update = array(
								'description' => $data['description'],
								'id' => $blogCategory[0]['id'],
								'meta_description' => $data['metaDescription'],
								'meta_keyword' => $data['metaKeyword'],
								'meta_title' => $data['metaTitle'],
								'name' => $data['name'],
								'parent_id' => $data['parent'],
								'path' => $data['path'],
								'status' => $data['status'],
								'url' => $data['url']
							);
							$this->blog_category_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Blog category successfully edited!</p>',
								'result' => true
							);
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>