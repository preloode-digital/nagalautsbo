<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank_account extends CI_Controller {
	
	
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
					'page' => 0,
					'pagination' => '',
					'totalRow' => ''
				),
				'data' => ''
			),
			'filter' => array(
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
		
		if(empty($this->initialize['administrator']['account'][0]['privilege_bank_account'])) {
			
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
				'id' => array(
					$data['id']
				),
				'name' => array(
					$data['name']
				),
				'number' => array(
					$data['number']
				),
				'bank' => array(
					$data['bank']
				),
				'type' => array(
					$data['type']
				),
				'status' => array(
					$data['status']
				)
			),
			'name' => 'filter_bank_account',
			'path' => $this->config->item('cookie_path')
		);
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
		
		$this->loadBankAccountPagination();
		
		$this->loadBank();
		
		$this->loadFilter();
		
		$data = array(
			'data' => array(
				'bank' => $this->initialize['bank'],
				'filter' => $this->initialize['filter']
			)
		);
		$this->load->view('panel/bank_account', $data);
		
	}
	
	
	/* Load children method */
	private function loadBank() {
		
		$this->load->model('bank_data');
		
		$this->initialize['bank']['data'] = $this->bank_data->loadOrderNameAsc();
		
	}
	
	
	/* Load children method */
	private function loadBankAccountPagination() {
		
		$this->load->model('bank_account_data');
		$this->load->library('pagination');
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['bank']['account']['page'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3)) - 1;
			
		}
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'bank' => 'bank_id',
				'name' => 'name',
				'number' => 'number',
				'id' => 'id',
				'status' => 'status',
				'type' => 'type'
			),
			'name' => 'filter_bank_account'
		);
		$this->initialize['bank']['account']['totalRow'] = count($this->bank_account_data->loadIdPagination($load));

		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = $this->config->item('panel_url').'bank_account';
		$pagination['total_rows'] = $this->initialize['bank']['account']['totalRow'];
		$this->pagination->initialize($pagination);
		$this->initialize['bank']['account']['pagination'] = $this->pagination->create_links();
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'bank' => 'bank_id',
				'name' => 'name',
				'number' => 'number',
				'id' => 'id',
				'status' => 'status',
				'type' => 'type'
			),
			'offset' => $pagination['per_page'] * $this->initialize['bank']['account']['page'],
			'limit' => $pagination['per_page'],
			'name' => 'filter_bank_account'
		);
		$this->initialize['bank']['account']['data'] = $this->bank_account_data->loadPagination($load);
		
	}
	
	
	/* Load children method */
	private function loadFilter() {
		
		if(!empty($_COOKIE['filter_bank_account'])) {
			
			$filter = (array) json_decode($_COOKIE['filter_bank_account']);
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
	private function refresh() {
		
		$this->load->library('filter');
		
		$filter = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'name' => 'filter_bank_account',
			'path' => $this->config->item('cookie_path')
		);
		$this->filter->remove($filter);
		
		header('Location: '.$_SERVER['REQUEST_URI'].'');
		
		exit();
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'bank_account'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'bank_account'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => 'Bank Account'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>