<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_account_entry extends CI_Controller {
	
	
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
			'bank' => array(
				'account' => array(
					'data' => '',
					'id' => ''
				),
				'data' => ''
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('panel/footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('administrator_data');
		$this->load->model('administrator_log_data');
		
		if(isset($_COOKIE['administrator'])) {
			
			$this->initialize['administrator']['account'] = json_decode($_COOKIE['administrator']);
			
			$load = array(
				'administrator_id' => $this->initialize['administrator']['account']->id,
				'authentication' => $this->initialize['administrator']['account']->authentication,
				'browser' => $this->initialize['administrator']['browser'],
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->initialize['administrator']['os']
			);
			$log = $this->administrator_log_data->loadBindAdministratorIdAuthenticationBrowserIpOsOrderIdDesc($load);
			
			if(!empty($log)) {
				
				if($log[0]['log'] == 'Logout') {
					
					header('Location: '.$this->config->item('panel_url').'login/');
					
					exit();
					
				}
				
				$load = array(
					'id' => $this->initialize['administrator']['account']->id
				);
				$this->initialize['administrator']['account'] = $this->administrator_data->loadBindId($load);
					
			}
			
			else {
				
				header('Location: '.$this->config->item('panel_url').'login/');
				
				exit();
				
			}
			
		}
		
		else {
			
			header('Location: '.$this->config->item('panel_url').'login/');
			
			exit();
			
		}
		
	}
	
	
	/* Index children method */
	private function checkPrivilege() {
		
		if(!empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
			
			$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_bank_account']);
			
			if($privilege[1] == 0) {
				
				header('Location: '.base_url().'restricted_access/');
				
				exit();
				
			}
			
			if($privilege[2] == 0) {
				
				if(!empty($this->uri->segment(3))) {
					
					header('Location: '.base_url().'restricted_access/');
					
					exit();
					
				}
				
			}
			
		}
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->checkPrivilege();
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$this->loadBankAccount();
		
		$this->loadBank();
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'bank' => $this->initialize['bank']
			)
		);
		$this->load->view('panel/bank_account_entry', $data);
		
	}
	
	
	/* Load children method */
	private function loadBank() {
		
		$this->load->model('bank_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['bank']['data'] = $this->bank_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadBankAccount() {
		
		$this->load->model('bank_account_data');
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['bank']['account']['id'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3));
			
		}
		
		$load = array(
			'id' => $this->initialize['bank']['account']['id']
		);
		$this->initialize['bank']['account']['data'] = $this->bank_account_data->loadBindId($load);
		
		if(!empty($this->uri->segment(3)) && empty($this->initialize['bank']['account']['data'])) {
			
			header('Location: '.base_url().'restricted_access/');
			
			exit();
			
		}
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'bank_account_entry'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'bank_account_entry'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Bank Account Entry'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>