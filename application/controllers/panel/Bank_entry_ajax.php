<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Bank failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertBank') {
			
			$this->insertBank($_POST);
			
		}
		
		else if($_POST['action'] == 'updateBank') {
			
			$this->updateBank($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertBank($data) {
		
		$this->load->model('bank_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$bank = $this->bank_data->loadBindName($load);
					
					if(empty($bank)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank name already exist!</p>';
						
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
							'status' => $data['status']
						);
						
						$this->bank_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Bank successfully added!</p>',
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
	private function updateBank($data) {
		
		$this->load->model('bank_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => $data['name']
					);
					
					$load = array(
						'name' => $data['name']
					);
					$bank = $this->bank_data->loadBindName($load);
					
					if(empty($bank)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($bank[0]['id'] == $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($bank[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Bank name already exist!</p>';
								
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
						$bank = $this->bank_data->loadBindId($load);
						
						if(!empty($bank)) {
							
							$update = array(
								'id' => $bank[0]['id'],
								'name' => $data['name'],
								'status' => $data['status']
							);
							$this->bank_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Bank successfully edited!</p>',
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