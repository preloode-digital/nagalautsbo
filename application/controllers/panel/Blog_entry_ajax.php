<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Blog article failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertBlog') {
			
			$this->insertBlog($_POST);
			
		}
		
		else if($_POST['action'] == 'updateBlog') {
			
			$this->updateBlog($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertBlog($data) {
		
		$this->load->model('blog_data');
		
		if(empty($data['url'])) {
			
			$data['url'] = preg_replace('#[^0-9A-Za-z\s-]#', '', $data['title']);
			$data['url'] = preg_replace('#[\s]#', '-', $data['url']);
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_blog'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_blog']);
				
				if($privilege[1] > 0) {
					
					$load = array(
						'url' => $data['url']
					);
					$blogArticle = $this->blog_data->loadBindUrl($load);
					
					$url = $data['url'];
					$i = 1;
					
					while(!empty($blogArticle)) {
						
						$url = $data['url'].'-'.$i;
						
						$load = array(
							'url' => $data['url'].'-'.$i
						);
						$blogArticle = $this->blog_data->loadBindUrl($load);
						
						$i++;
						
					}
					
					$data['url'] = $url;
					
					$insert = array(
						'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
						'category_id' => $data['category'],
						'content' => $data['content'],
						'description' => $data['description'],
						'meta_description' => $data['metaDescription'],
						'meta_keyword' => $data['metaKeyword'],
						'meta_title' => $data['metaTitle'],
						'picture' => $data['picture'],
						'status' => $data['status'],
						'title' => $data['title'],
						'url' => $data['url']
					);
					$this->blog_data->insert($insert);
					
					$this->initialize['response'] = array(
						'response' => '<p>Blog article successfully added!</p>',
						'result' => true
					);
					
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
	
	
	/* Upload picture children method */
	private function resizePicture($data) {
		
		$this->load->model('blog_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$source['path'] = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$data['path'];
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			if($source['width'] > 600) {
				
				$destination = array(
					'height' => (600 / $source['width']) * $source['height'],
					'width' => 600
				);
				
				$resize = array(
					'destinationHeight' => $destination['height'],
					'destinationPath' => '/'.$data['path'],
					'destinationX' => 0,
					'destinationWidth' => $destination['width'],
					'destinationY' => 0,
					'sourceHeight' => $source['height'],
					'sourcePath' => '/'.$data['path'],
					'sourceX' => 0,
					'sourceWidth' => $source['width'],
					'sourceY' => 0
				);
				$this->blog_data->resizePicture($resize);
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function updateBlog($data) {
		
		$this->load->model('blog_data');
		
		if(empty($data['url'])) {
			
			$data['url'] = preg_replace('#[^0-9A-Za-z\s-]#', '', $data['title']);
			$data['url'] = preg_replace('#[\s]#', '-', $data['url']);
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_blog'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_blog']);
				
				if($privilege[2] > 0) {
					
					$load = array(
						'url' => $data['url']
					);
					$blog = $this->blog_data->loadBindUrl($load);
					
					$url = $data['url'];
					$i = 1;
					
					while(!empty($blog)) {
						
						if($blog[0]['id'] != $data['id']) {
							
							$url = $data['url'].'-'.$i;
							
						}
						
						$load = array(
							'url' => $data['url'].'-'.$i
						);
						$blog = $this->blog_data->loadBindUrl($load);
						
						$i++;
						
					}
					
					$data['url'] = $url;
					
					$load = array(
						'id' => $data['id']
					);
					$blog = $this->blog_data->loadBindId($load);
					
					if(!empty($blog)) {
						
						$update = array(
							'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
							'category_id' => $data['category'],
							'content' => $data['content'],
							'description' => $data['description'],
							'id' => $blog[0]['id'],
							'meta_description' => $data['metaDescription'],
							'meta_keyword' => $data['metaKeyword'],
							'meta_title' => $data['metaTitle'],
							'picture' => $data['picture'],
							'status' => $data['status'],
							'title' => $data['title'],
							'url' => $data['url']
						);
						$this->blog_data->update($update);
						
						$this->initialize['response'] = array(
							'response' => '<p>Blog article successfully edited!</p>',
							'result' => true
						);
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function uploadPicture($data) {
		
		$this->load->model('blog_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->blog_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/blog/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/blog/'.$upload['file_name']
				);
				$this->resizePicture($resize);
				
			}
			
			else {
				
				$this->initialize['response'] = array(
					'response' => $upload,
					'result' => false
				);
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>