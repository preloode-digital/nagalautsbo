<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Gallery_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Gallery failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertGallery') {
			
			$this->insertGallery($_POST);
			
		}
		
		else if($_POST['action'] == 'updateGallery') {
			
			$this->updateGallery($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertGallery($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_gallery'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_gallery']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$gallery = $this->gallery_data->loadBindName($load);
					
					if(empty($gallery)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Gallery name already exist!</p>';
						
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
							'name' => $data['name'],
							'picture' => $data['picture'],
							'sequence' => $data['sequence'],
							'status' => $data['status'],
							'url' => $data['url']
						);
						
						$this->gallery_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Gallery successfully added!</p>',
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
	
	
	/* Upload picture children method */
	private function resizePicture($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$source['path'] = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$data['path'];
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			if($source['width'] > 1200) {
				
				$destination = array(
					'height' => (1200 / $source['width']) * $source['height'],
					'width' => 1200
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
				$this->gallery_data->resizePicture($resize);
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function updateGallery($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_gallery'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_gallery']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => $data['name']
					);
					
					$load = array(
						'name' => $data['name']
					);
					$gallery = $this->gallery_data->loadBindName($load);
					
					if(empty($gallery)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($gallery[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($gallery[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Gallery name already exist!</p>';
								
							}
							
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
						
						$load = array(
							'id' => $data['id']
						);
						$gallery = $this->gallery_data->loadBindId($load);
						
						if(!empty($gallery)) {
							
							$update = array(
								'id' => $gallery[0]['id'],
								'name' => $data['name'],
								'picture' => $data['picture'],
								'sequence' => $data['sequence'],
								'status' => $data['status'],
								'url' => $data['url']
							);
							$this->gallery_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Gallery successfully edited!</p>',
								'result' => true
							);
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function uploadPicture($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->gallery_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/gallery/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/gallery/'.$upload['file_name']
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