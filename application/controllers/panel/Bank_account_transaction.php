<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_account_transaction extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'administrator' => array(
				'account' => '',
				'browser' => $this->device->getBrowser(),
				'data' => '',
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->device->getOs()
			),
			'bank' => array(
				'account' => array(
					'data' => '',
					'id' => 0
				)
			),
			'filter' => array(
				'data' => ''
			),
			'game' => array(
				'data' => ''
			),
			'player' => array(
				'data' => ''
			),
			'transaction' => array(
				'data' => array(),
				'i' => 0,
				'merge' => array(),
				'page' => 0,
				'pagination' => '',
				'totalRow' => ''
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
		
		if(empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
			
			header('Location: '.base_url().'restricted_access/');
			
			exit();
			
		}
		
	}
	
	
	/* Load children method */
	private function filter($data) {
		
		$this->load->model('player_data');
		$this->load->library('filter');
		
		$filter = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'input' => array(
				'administrator' => array(
					$data['administrator']
				),
				'amount' => array(
					$data['amount']
				),
				'fromBankAccount' => array(
					$data['from-bank-account']
				),
				'game' => array(
					$data['game']
				),
				'id' => array(
					$data['id']
				),
				'player' => array(
					$data['player']
				),
				'timestamp' => array(
					$data['start-date'],
					$data['end-date']
				),
				'toBankAccount' => array(
					$data['to-bank-account']
				),
				'type' => array(
					$data['type']
				)
			),
			'name' => 'filter_bank_account_transaction',
			'path' => $this->config->item('cookie_path')
		);
		
		if(!empty($filter['input']['player'][0])) {
			
			$load = array(
				'username' => $filter['input']['player'][0]
			);
			$player = $this->player_data->loadBindUsername($load);
			
			if(!empty($player)) {
				
				$filter['input']['player'][0] = $player[0]['id'];
				
			}
			
		}
		
		if(!empty($filter['input']['timestamp'][0])) {
			
			$filter['input']['timestamp'][0] = preg_replace('#[^0-9\-]#', '', $filter['input']['timestamp'][0]).' 00:00:00';
			
		}
		
		if(!empty($filter['filter']['timestamp'][1])) {
			
			$filter['filter']['timestamp'][1] = preg_replace('#[^0-9\-]#', '', $filter['filter']['timestamp'][1]).' 23:59:59';
			
		}
		
		$this->filter->write($filter);
		
		header('Location: '.$_SERVER['REQUEST_URI'].'');
		
		exit();
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->checkPrivilege();
		
		if(isset($_POST['filter'])) {
			
			$this->filter($_POST);
			
		}
		
		else if(isset($_POST['refresh'])) {
			
			$this->refresh();
			
		}
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$this->loadFilter();
		
		$this->loadTransactionPagination();
		
		$this->loadBankAccount();
		
		$this->loadPlayer();
		
		$this->loadGame();
		
		$this->loadAdministrator();
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'bank' => $this->initialize['bank'],
				'filter' => $this->initialize['filter'],
				'game' => $this->initialize['game'],
				'player' => $this->initialize['player'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('panel/bank_account_transaction', $data);
		
	}
	
	
	/* Load children method */
	private function loadAdministrator() {
		
		$this->load->model('administrator_data');
		
		$this->initialize['administrator']['data'] = $this->administrator_data->loadOrderUsernameAsc();
		
	}
	
	
	/* Load children method */
	private function loadBankAccount() {
		
		$this->load->model('bank_account_data');
		
		$this->initialize['bank']['account']['data'] = $this->bank_account_data->loadOrderNameAsc();
		
	}
	
	
	/* Load children method */
	private function loadFilter() {
		
		if(!empty($_COOKIE['filter_transaction'])) {
			
			$filter = (array) json_decode($_COOKIE['filter_bank_account_transaction']);
			$input = array();
			
			if(!empty($filter)) {
				
				foreach($filter as $key => $value) {
					
					$input[$key] = (array) $value;
					
				}
				
			}
			
			if(!empty($input)) {
				
				foreach($input as $key => $value) {
					
					if($key == $this->initialize['administrator']['account'][0]['id']) {
						
						$this->initialize['filter']['data'] = $value;
						
					}
					
				}
				
			}
			
		}
		
	}
	
	
	/* Load children method */
	private function loadGame() {
		
		$this->load->model('game_data');
		
		$this->initialize['game']['data'] = $this->game_data->loadOrderNameAsc();
		
	}
	
	
	/* Load children method */
	private function loadPlayer() {
		
		$this->load->model('player_data');
		
		$this->initialize['player']['data'] = $this->player_data->loadOrderUsernameAsc();
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionAdjustment() {
		
		$this->load->model('transaction_adjustment_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'fromBankAccount' => 'from_bank_account_id',
				'id' => 'id',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'name' => 'filter_transaction'
		);
		$adjustment = $this->transaction_adjustment_data->loadPagination($load);
		
		if(!empty($adjustment)) {
			
			foreach($adjustment as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Adjustment';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionDeposit() {
		
		$this->load->model('transaction_deposit_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'game' => 'game_id',
				'id' => 'id',
				'player' => 'player_id',
				'promotion' => 'promotion_id',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'name' => 'filter_transaction'
		);
		$deposit = $this->transaction_deposit_data->loadPagination($load);
		
		if(!empty($deposit)) {
			
			foreach($deposit as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Deposit';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionExpense() {
		
		$this->load->model('transaction_expense_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'fromBankAccount' => 'from_bank_account_id',
				'id' => 'id',
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_transaction'
		);
		$expense = $this->transaction_expense_data->loadPagination($load);
		
		if(!empty($expense)) {
			
			foreach($expense as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Expense';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionInject() {
		
		$this->load->model('transaction_inject_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'fromBankAccount' => 'from_bank_account_id',
				'id' => 'id',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'name' => 'filter_transaction'
		);
		$inject = $this->transaction_inject_data->loadPagination($load);
		
		if(!empty($inject)) {
			
			foreach($inject as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Inject';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Load children method */
	private function loadTransactionPagination() {
		
		$this->load->library('pagination');
		
		if(!empty($this->uri->segment(2))) {
			
			$this->initialize['bank']['account']['id'] = preg_replace('#[^0-9]#', '', $this->uri->segment(2));
			
		}
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['transaction']['page'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3)) - 1;
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Adjustment') {
			
			$this->loadTransactionAdjustment();
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Deposit') {
			
			$this->loadTransactionDeposit();
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Expense') {
			
			$this->loadTransactionExpense();
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Inject') {
			
			$this->loadTransactionInject();
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Saving') {
			
			$this->loadTransactionSaving();
			
		}
		
		if(empty($this->initialize['filter']['type'][0]) || $this->initialize['filter']['type'][0] == 'Withdraw') {
			
			$this->loadTransactionWithdraw();
			
		}
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['transaction']['page'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3)) - 1;
			
		}
		
		$dataSort = array();
		
		if(!empty($this->initialize['transaction']['merge'])) {
			
			foreach($this->initialize['transaction']['merge'] as $key => $value) {
				
				if($value['type'] == 'Adjustment' || $value['type'] == 'Expense' || $value['type'] == 'Inject' || $value['type'] == 'Saving') {
					
					if($value['from_bank_account_id'] == $this->initialize['bank']['account']['id'] || $value['to_bank_account_id'] == $this->initialize['bank']['account']['id']) {
						
						$dataSort[$key] = $value['timestamp'];
						
					}
					
				}
				
				else if($value['type'] == 'Deposit') {
					
					if($value['to_bank_account_id'] == $this->initialize['bank']['account']['id']) {
						
						$dataSort[$key] = $value['timestamp'];
						
					}
					
				}
				
				else if($value['type'] == 'Withdraw') {
					
					if($value['from_bank_account_id'] == $this->initialize['bank']['account']['id']) {
						
						$dataSort[$key] = $value['timestamp'];
						
					}
					
				}
				
			}
			
		}
		
		arsort($dataSort);
		
		$this->initialize['transaction']['totalRow'] = count($this->initialize['transaction']['merge']);
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = $this->config->item('panel_url').'bank_account_transaction/'.$this->initialize['bank']['account']['id'];
		$pagination['total_rows'] = $this->initialize['transaction']['totalRow'];
		$this->pagination->initialize($pagination);
		$this->initialize['transaction']['pagination'] = $this->pagination->create_links();
		
		if(!empty($dataSort)) {
			
			$offset = $pagination['per_page'] * $this->initialize['transaction']['page'];
			$limit = $offset + $pagination['per_page'];
			$i = 0;
			
			foreach($dataSort as $key => $value) {
				
				if($i >= $offset && $i < $limit) {
					
					$this->initialize['transaction']['data'][] = $this->initialize['transaction']['merge'][$key];
					
				}
				
				if($this->initialize['transaction']['merge'][$key]['type'] == 'Adjustment' || $this->initialize['transaction']['merge'][$key]['type'] == 'Expense' || $this->initialize['transaction']['merge'][$key]['type'] == 'Inject' || $this->initialize['transaction']['merge'][$key]['type'] == 'Saving') {
					
					if($this->initialize['transaction']['merge'][$key]['from_bank_account_id'] == $this->initialize['bank']['account']['id']) {
						
						$bankAccount[0]['balance'] += $this->initialize['transaction']['merge'][$key]['amount'];
						
					}
					
					else if($this->initialize['transaction']['merge'][$key]['to_bank_account_id'] == $this->initialize['bank']['account']['id']) {
						
						$bankAccount[0]['balance'] -= $this->initialize['transaction']['merge'][$key]['amount'];
						
					}
					
				}
				
				else if($this->initialize['transaction']['merge'][$key]['type'] == 'Deposit') {
					
					$bankAccount[0]['balance'] -= $this->initialize['transaction']['merge'][$key]['amount'];
					
				}
				
				else if($this->initialize['transaction']['merge'][$key]['type'] == 'Withdraw') {
					
					$bankAccount[0]['balance'] += $this->initialize['transaction']['merge'][$key]['amount'];
					
				}
				
				$i++;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionSaving() {
		
		$this->load->model('transaction_saving_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'fromBankAccount' => 'from_bank_account_id',
				'id' => 'id',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'name' => 'filter_transaction'
		);
		$saving = $this->transaction_saving_data->loadPagination($load);
		
		if(!empty($saving)) {
			
			foreach($saving as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Saving';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionWithdraw() {
		
		$this->load->model('transaction_withdraw_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'fromBankAccount' => 'from_bank_account_id',
				'game' => 'game_id',
				'id' => 'id',
				'player' => 'player_id',
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_transaction'
		);
		$withdraw = $this->transaction_withdraw_data->loadPagination($load);
		
		if(!empty($withdraw)) {
			
			foreach($withdraw as $key => $value) {
				
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']] = $value;
				$this->initialize['transaction']['merge'][$this->initialize['transaction']['i']]['type'] = 'Withdraw';
				
				$this->initialize['transaction']['i']++;
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'bank_account_transaction'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'js' => array(
					'bank_account_transaction'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Bank Account Transaction'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>