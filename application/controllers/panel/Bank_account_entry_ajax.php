<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_account_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Bank account failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertBankAccount') {
			
			$this->insertBankAccount($_POST);
			
		}
		
		else if($_POST['action'] == 'updateBankAccount') {
			
			$this->updateBankAccount($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertBankAccount($data) {
		
		$this->load->model('bank_account_data');
		
		$data['balance'] = preg_replace('#[^0-9]#', '', $data['balance']);
		
		if(empty($data['balance'])) {
			
			$data['balance'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank_account']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'bank' => false,
						'number' => false
					);
					
					$load = array(
						'bank_id' => $data['bank'],
						'number' => $data['number']
					);
					$bankAccount = $this->bank_account_data->loadBindBankIdNumber($load);
					
					if(empty($bankAccount)) {
						
						$validation['bank'] = true;
						$validation['number'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account already exist!</p>';
						
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
							'balance' => $data['balance'],
							'bank_id' => $data['bank'],
							'name' => $data['name'],
							'number' => $data['number'],
							'status' => $data['status'],
							'type' => $data['type']
						);
						$this->bank_account_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Bank account successfully added!</p>',
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
	private function updateBankAccount($data) {
		
		$this->load->model('bank_account_data');
		
		$data['balance'] = preg_replace('#[^0-9]#', '', $data['balance']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank_account']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'bank' => false,
						'number' => false
					);
					
					$load = array(
						'bank_id' => $data['bank'],
						'number' => $data['number']
					);
					$bankAccount = $this->bank_account_data->loadBindBankIdNumber($load);
					
					if(empty($bankAccount)) {
						
						$validation['bank'] = true;
						$validation['number'] = true;
						
					}
					
					else {
						
						if($bankAccount[0]['id'] == $data['id']) {
							
							$validation['bank'] = true;
							$validation['number'] = true;
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Bank account already exist!</p>';
							
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
						$bankAccount = $this->bank_account_data->loadBindId($load);
						
						if(!empty($bankAccount)) {
							
							$update = array(
								'balance' => $data['balance'],
								'bank_id' => $data['bank'],
								'id' => $bankAccount[0]['id'],
								'name' => $data['name'],
								'number' => $data['number'],
								'status' => $data['status'],
								'type' => $data['type']
							);
							$this->bank_account_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Bank Account successfully edited!</p>',
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