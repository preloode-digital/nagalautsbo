<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_entry_ajax extends CI_Controller {
	
	
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
				'picture' => '',
				'response' => '<p>Administrator failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertAdministrator') {
			
			$this->insertAdministrator($_POST);
			
		}
		
		else if($_POST['action'] == 'loadSinglePrivilege') {
			
			$this->loadSinglePrivilege($_POST);
			
		}
		
		else if($_POST['action'] == 'updateAdministrator') {
			
			$this->updateAdministrator($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertAdministrator($data) {
		
		$this->load->model('administrator_data');
		
		$data['password'] = hash('sha512', $data['password']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'username' => false
					);
					
					$load = array(
						'username' => $data['username']
					);
					$administrator = $this->administrator_data->loadBindUsername($load);
					
					if(empty($administrator)) {
						
						$validation['username'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Administrator username already exist!</p>';
						
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
							'administrator_role_id' => $data['administratorRoleId'],
							'first_name' => $data['firstName'],
							'gender' => $data['gender'],
							'last_name' => $data['lastName'],
							'middle_name' => $data['middleName'],
							'password' => $data['password'],
							'picture' => $data['picture'],
							'privilege_administrator' => $data['privilege']['administrator'],
							'privilege_bank' => $data['privilege']['bank'],
							'privilege_bank_account' => $data['privilege']['bankAccount'],
							'privilege_blog' => $data['privilege']['blog'],
							'privilege_gallery' => $data['privilege']['gallery'],
							'privilege_game' => $data['privilege']['game'],
							'privilege_player' => $data['privilege']['player'],
							'privilege_promotion' => $data['privilege']['promotion'],
							'privilege_report' => $data['privilege']['report'],
							'privilege_setting' => $data['privilege']['setting'],
							'privilege_transaction' => $data['privilege']['transaction'],
							'status' => $data['status'],
							'username' => $data['username']
						);
						$this->administrator_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Administrator successfully added!</p>',
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
	private function loadSinglePrivilege($data) {
		
		$this->load->model('administrator_role_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			$administratorRole = $this->administrator_role_data->loadBindId($load);
			
			if(!empty($administratorRole)) {
				
				$this->initialize['response'] = array(
					'response' => $administratorRole[0],
					'result' => true
				);
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Upload picture children method */
	private function resizePicture($data) {
		
		$this->load->model('administrator_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$source['path'] = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$data['path'];
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			if($source['width'] > $source['height']) {
				
				$destination = array(
					'height' => $source['height'],
					'width' => $source['height']
				);
				$source['x'] = ($source['width'] - $source['height']) / 2;
				$source['y'] = 0;
				
			}
			
			else if($source['width'] < $source['height']) {
				
				$destination = array(
					'height' => $source['width'],
					'width' => $source['width']
				);
				$source['x'] = 0;
				$source['y'] = ($source['height'] - $source['width']) / 2;
				
			}
			
			else {
				
				$destination = array(
					'height' => $source['height'],
					'width' => $source['width']
				);
				$source['x'] = 0;
				$source['y'] = 0;
				
			}
			
			$resize = array(
				'destinationHeight' => $destination['height'],
				'destinationPath' => '/'.$data['path'],
				'destinationX' => 0,
				'destinationWidth' => $destination['width'],
				'destinationY' => 0,
				'sourceHeight' => $destination['height'],
				'sourcePath' => '/'.$data['path'],
				'sourceX' => $source['x'],
				'sourceWidth' => $destination['width'],
				'sourceY' => $source['y']
			);
			$this->administrator_data->resizePicture($resize);
			
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			$resize = array(
				'destinationHeight' => 300,
				'destinationPath' => '/'.$data['path'],
				'destinationX' => 0,
				'destinationWidth' => 300,
				'destinationY' => 0,
				'sourceHeight' => $source['height'],
				'sourcePath' => '/'.$data['path'],
				'sourceX' => 0,
				'sourceWidth' => $source['width'],
				'sourceY' => 0
			);
			$this->administrator_data->resizePicture($resize);
			
		}
		
	}
	
	
	/* Index children method */
	private function updateAdministrator($data) {
		
		$this->load->model('administrator_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'username' => false
					);
					
					$load = array(
						'username' => $data['username']
					);
					$administrator = $this->administrator_data->loadBindUsername($load);
					
					if(empty($administrator)) {
						
						$validation['username'] = true;
						
					}
					
					else {
						
						if($administrator[0]['id'] != $data['id']) {
							
							$validation['username'] = true;
							
						}
						
						else {
							
							if($administrator[0]['username'] == $data['username']) {
								
								$validation['username'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Administrator username already exist!</p>';
								
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
						$administrator = $this->administrator_data->loadBindId($load);
						
						if(!empty($administrator)) {
							
							if($administrator[0]['password'] != $data['password']) {
								
								$data['password'] = hash('sha512', $data['password']);
								
							}
							
							$update = array(
								'administrator_role_id' => $data['administratorRoleId'],
								'first_name' => $data['firstName'],
								'gender' => $data['gender'],
								'id' => $administrator[0]['id'],
								'last_name' => $data['lastName'],
								'middle_name' => $data['middleName'],
								'password' => $data['password'],
								'picture' => $data['picture'],
								'privilege_administrator' => $data['privilege']['administrator'],
								'privilege_bank' => $data['privilege']['bank'],
								'privilege_bank_account' => $data['privilege']['bankAccount'],
								'privilege_blog' => $data['privilege']['blog'],
								'privilege_gallery' => $data['privilege']['gallery'],
								'privilege_game' => $data['privilege']['game'],
								'privilege_player' => $data['privilege']['player'],
								'privilege_promotion' => $data['privilege']['promotion'],
								'privilege_report' => $data['privilege']['report'],
								'privilege_setting' => $data['privilege']['setting'],
								'privilege_transaction' => $data['privilege']['transaction'],
								'status' => $data['status'],
								'username' => $data['username']
							);
							$this->administrator_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Administrator successfully edited!</p>',
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
		
		$this->load->model('administrator_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->administrator_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/panel/administrator/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/panel/administrator/'.$upload['file_name']
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