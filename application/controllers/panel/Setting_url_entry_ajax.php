<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_url_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>URL failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertUrl') {
			
			$this->insertUrl($_POST);
			
		}
		
		else if($_POST['action'] == 'updateUrl') {
			
			$this->updateUrl($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertUrl($data) {
		
		$this->load->model('url_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false,
						'url' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$url = $this->url_data->loadBindName($load);
					
					if(empty($url)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>URL name already exist!</p>';
						
					}
					
					$load = array(
						'url' => $data['url']
					);
					$url = $this->url_data->loadBindUrl($load);
					
					if(empty($url)) {
						
						$validation['url'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>URL URL already exist!</p>';
						
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
							'status' => $data['status'],
							'url' => $data['url']
						);
						$this->url_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>URL successfully added!</p>',
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
	private function updateUrl($data) {
		
		$this->load->model('url_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false,
						'url' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$url = $this->url_data->loadBindName($load);
					
					if(empty($url)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($url[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($url[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>URL name already exist!</p>';
								
							}
							
						}
						
					}
					
					$load = array(
						'url' => $data['url']
					);
					$url = $this->url_data->loadBindUrl($load);
					
					if(empty($url)) {
						
						$validation['url'] = true;
						
					}
					
					else {
						
						if($url[0]['id'] != $data['id']) {
							
							$validation['url'] = true;
							
						}
						
						else {
							
							if($url[0]['url'] == $data['url']) {
								
								$validation['url'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>URL URL already exist!</p>';
								
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
						$url = $this->url_data->loadBindId($load);
						
						if(!empty($url)) {
							
							$update = array(
								'id' => $url[0]['id'],
								'name' => $data['name'],
								'url' => $data['url'],
								'status' => $data['status']
							);
							$this->url_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>URL successfully edited!</p>',
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