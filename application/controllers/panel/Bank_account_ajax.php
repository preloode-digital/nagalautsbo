<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_account_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Bank account process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteBankAccount') {
			
			$this->deleteBankAccount($_POST);
			
		}
		
		else if($_POST['action'] == 'loadBankAccountDetail') {
			
			$this->loadBankAccountDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteBankAccount($data) {
		
		$this->load->model('bank_account_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank_account']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						$delete = array(
							'id' => $bankAccount[0]['id']
						);
						$this->bank_account_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Bank account successfully deleted!</p>',
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
	private function loadBankAccountDetail($data) {
		
		$this->load->model('bank_account_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank_account']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						if(!empty($bankAccount[0]['balance'])) {
							
							$bankAccount[0]['balance'] = number_format($bankAccount[0]['balance']);
							
						}
						
						$bankAccount[0]['timestamp'] = new DateTime($bankAccount[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Number</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['number'].'</p>
							<div class="clearfix"></div>
							<p class="title">Bank</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['bank_id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Type</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['type'].'</p>
							<div class="clearfix"></div>
							<p class="title">Balance</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['balance'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankAccount[0]['timestamp']->format('j-m-Y H:i:s').'</p>
							<div class="clearfix"></div>
							<a href="'.$this->config->item('panel_url').'bank_account_transaction/'.$bankAccount[0]['id'].'/"><p class="transaction">Detail Transaction</p></a>',
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