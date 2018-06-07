<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_entry extends CI_Controller {
	
	
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
					'data' => ''
				),
				'data' => ''
			),
			'game' => array(
				'data' => ''
			),
			'player' => array(
				'data' => ''
			),
			'promotion' => array(
				'data' => ''
			),
			'transaction' => array(
				'data' => '',
				'id' => '',
				'type' => ''
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
		
		if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
			
			$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
			
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
		
		$this->loadTransaction();
		
		$this->loadGame();
		
		$this->loadBank();
		
		if(!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))) {
			
			$this->loadPlayer();
			
			$this->loadBankAccount();
			
		}
		
		$data = array(
			'data' => array(
				'bank' => $this->initialize['bank'],
				'game' => $this->initialize['game'],
				'player' => $this->initialize['player'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('panel/transaction_entry', $data);
		
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
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['bank']['account']['data'] = $this->bank_account_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadGame() {
		
		$this->load->model('game_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['game']['data'] = $this->game_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadPlayer() {
		
		$this->load->model('player_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['player']['data'] = $this->player_data->loadBindStatusOrderUsernameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadPromotion() {
		
		$this->load->model('promotion_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['promotion']['data'] = $this->promotion_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadTransaction() {
		
		$this->load->model('transaction_adjustment_data');
		$this->load->model('transaction_deposit_data');
		$this->load->model('transaction_expense_data');
		$this->load->model('transaction_inject_data');
		$this->load->model('transaction_saving_data');
		$this->load->model('transaction_withdraw_data');
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['transaction']['type'] = preg_replace('#[^A-Za-z]#', '', $this->uri->segment(3));
			$this->initialize['transaction']['type'] = ucwords($this->initialize['transaction']['type']);
			
		}
		
		if(!empty($this->uri->segment(4))) {
			
			$this->initialize['transaction']['id'] = preg_replace('#[^0-9]#', '', $this->uri->segment(4));
			
		}
		
		$load = array(
			'id' => $this->initialize['transaction']['id']
		);
		
		if($this->initialize['transaction']['type'] == 'Adjustment') {
			
			$this->initialize['transaction']['data'] = $this->transaction_adjustment_data->loadBindId($load);
			
		}
		
		else if($this->initialize['transaction']['type'] == 'Deposit') {
			
			$this->initialize['transaction']['data'] = $this->transaction_deposit_data->loadBindId($load);
			
			$this->loadPromotion();
			
		}
		
		else if($this->initialize['transaction']['type'] == 'Expense') {
			
			$this->initialize['transaction']['data'] = $this->transaction_expense_data->loadBindId($load);
			
		}
		
		else if($this->initialize['transaction']['type'] == 'Inject') {
			
			$this->initialize['transaction']['data'] = $this->transaction_inject_data->loadBindId($load);
			
		}
		
		else if($this->initialize['transaction']['type'] == 'Saving') {
			
			$this->initialize['transaction']['data'] = $this->transaction_saving_data->loadBindId($load);
			
		}
		
		else if($this->initialize['transaction']['type'] == 'Withdraw') {
			
			$this->initialize['transaction']['data'] = $this->transaction_withdraw_data->loadBindId($load);
			
		}
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'transaction_entry'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'transaction_entry'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Transaction Entry'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>