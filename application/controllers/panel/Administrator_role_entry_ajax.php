<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_role_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Administrator role failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertAdministratorRole') {
			
			$this->insertAdministratorRole($_POST);
			
		}
		
		else if($_POST['action'] == 'updateAdministratorRole') {
			
			$this->updateAdministratorRole($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertAdministratorRole($data) {
		
		$this->load->model('administrator_role_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$administratorRole = $this->administrator_role_data->loadBindName($load);
					
					if(empty($administratorRole)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Administrator role name already exist!</p>';
						
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
							'status' => $data['status']
						);
						$this->administrator_role_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Administrator role successfully added!</p>',
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
	private function updateAdministratorRole($data) {
		
		$this->load->model('administrator_role_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$administratorRole = $this->administrator_role_data->loadBindName($load);
					
					if(empty($administratorRole)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($administratorRole[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($administratorRole[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Administrator role name already exist!</p>';
								
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
						$administratorRole = $this->administrator_role_data->loadBindId($load);
						
						if(!empty($administratorRole)) {
							
							$update = array(
								'name' => $data['name'],
								'id' => $administratorRole[0]['id'],
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
								'status' => $data['status']
							);
							$this->administrator_role_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Administrator role successfully edited!</p>',
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