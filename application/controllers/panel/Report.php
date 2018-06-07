<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Report extends CI_Controller {
	
	
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
			'filter' => array(
				'data' => ''
			),
			'transaction' => array(
				'data' => array(),
				'i' => 0,
				'merge' => array()
			),
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
		
		if(empty($this->initialize['administrator']['account'][0]['privilege_report'])) {
			
			header('Location: '.base_url().'restricted_access/');
			
			exit();
			
		}
		
	}
	
	
	/* Load children method */
	private function filter($data) {
		
		$this->load->library('filter');
		
		$filter = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'input' => array(
				'timestamp' => array(
					$data['start-date'],
					$data['end-date']
				),
			),
			'name' => 'filter_report',
			'path' => $this->config->item('cookie_path')
		);
		
		if(!empty($filter['input']['timestamp'][0])) {
			
			$filter['input']['timestamp'][0] .= ' 00:00:00';
			
		}
		
		if(!empty($filter['input']['timestamp'][1])) {
			
			$filter['input']['timestamp'][1] .= ' 23:59:59';
			
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
		
		$this->loadTransaction();
		
		$this->loadFilter();
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'filter' => $this->initialize['filter'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('panel/report', $data);
		
	}
	
	
	/* Load children method */
	private function loadFilter() {
		
		if(!empty($_COOKIE['filter_report'])) {
			
			$filter = (array) json_decode($_COOKIE['filter_report']);
			$input = array();
			
			if(!empty($filter)) {
				
				foreach($filter as $key => $value) {
					
					$input[$key] = (array) $value;
					
				}
				
			}
			
			if(!empty($input)) {
				
				foreach($input as $key => $value) {
					
					if($key == $this->initialize['administrator']['account'][0]['id']) {
						
						$this->initialize['filter'] = $value;
						
					}
					
				}
				
				if(!empty($this->initialize['filter']['timestamp'][0])) {
					
					$this->initialize['filter']['timestamp'][0] = explode(' ', $this->initialize['filter']['timestamp'][0]);
					$this->initialize['filter']['timestamp'][0] = $this->initialize['filter']['timestamp'][0][0];
					
				}
				
				if(!empty($this->initialize['filter']['timestamp'][1])) {
					
					$this->initialize['filter']['timestamp'][1] = explode(' ', $this->initialize['filter']['timestamp'][1]);
					$this->initialize['filter']['timestamp'][1] = $this->initialize['filter']['timestamp'][1][0];
					
				}
				
			}
			
		}
		
	}
	
	
	/* Load children method */
	private function loadTransaction() {
		
		$this->loadTransactionAdjustment();
		
		$this->loadTransactionDeposit();
		
		$this->loadTransactionExpense();
		
		$this->loadTransactionInject();
		
		$this->loadTransactionSaving();
		
		$this->loadTransactionWithdraw();
		
		if(!empty($this->initialize['transaction']['merge'])) {
			
			foreach($this->initialize['transaction']['merge'] as $key => $value) {
				
				$this->initialize['transaction']['data'][] = $value;
				
			}
			
		}
		
	}
	
	
	/* Transaction pagination children method */
	private function loadTransactionAdjustment() {
		
		$this->load->model('transaction_adjustment_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
	
	
	/* Transaction pagination children method */
	private function loadTransactionSaving() {
		
		$this->load->model('transaction_saving_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
				'timestamp' => 'timestamp'
			),
			'name' => 'filter_report'
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
					'report'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'report'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Report'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>