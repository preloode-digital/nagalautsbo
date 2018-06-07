<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_slider_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Slider failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertSlider') {
			
			$this->insertSlider($_POST);
			
		}
		
		else if($_POST['action'] == 'updateSlider') {
			
			$this->updateSlider($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertSlider($data) {
		
		$this->load->model('slider_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$slider = $this->slider_data->loadBindName($load);
					
					if(empty($slider)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Slider name already exist!</p>';
						
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
							'alternative_text' => $data['alternativeText'],
							'name' => $data['name'],
							'picture' => $data['picture'],
							'sequence' => $data['sequence'],
							'status' => $data['status']
						);
						$this->slider_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Slider successfully added!</p>',
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
		
		$this->load->model('slider_data');
		
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
				$this->slider_data->resizePicture($resize);
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function updateSlider($data) {
		
		$this->load->model('slider_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$slider = $this->slider_data->loadBindName($load);
					
					if(empty($slider)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($slider[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($slider[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Slider name already exist!</p>';
								
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
						$slider = $this->slider_data->loadBindId($load);
						
						if(!empty($slider)) {
							
							$update = array(
								'alternative_text' => $data['alternativeText'],
								'id' => $slider[0]['id'],
								'name' => $data['name'],
								'picture' => $data['picture'],
								'sequence' => $data['sequence'],
								'status' => $data['status']
							);
							$this->slider_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Slider successfully edited!</p>',
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
		
		$this->load->model('slider_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->slider_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/promotion/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/slider/'.$upload['file_name']
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