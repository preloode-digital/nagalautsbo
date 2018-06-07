<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {
	
	
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
			'game' => array(
				'data' => ''
			),
			'player' => array(
				'data' => '',
				'new' => array(
					'data' => array()
				)
			),
			'transaction' => array(
				'new' => array(
					'data' => ''
				)
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
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$this->loadTransactionRequest();
		
		$this->loadGame();
		
		$this->loadPlayer();
		
		$this->loadNewPlayer();
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'game' => $this->initialize['game'],
				'player' => $this->initialize['player'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('panel/home', $data);
		
	}
	
	
	/* Load children method */
	private function loadGame() {
		
		$this->load->model('game_data');
		
		$this->initialize['game']['data'] = $this->game_data->loadOrderNameAsc();
		
	}
	
	
	/* Load children method */
	private function loadNewPlayer() {
		
		$this->load->model('player_data');
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'bankAccountName' => 'bank_account_name',
				'bankAccountNumber' => 'bank_account_number',
				'firstName' => 'first_name',
				'gender' => 'gender',
				'id' => 'id',
				'lastName' => 'last_name',
				'status' => 'status',
				'username' => 'username'
			),
			'offset' => 0,
			'limit' => 10,
			'name' => 'filter_new_player'
		);
		$this->initialize['player']['new']['data'] = $this->player_data->loadPagination($load);
		
	}
	
	
	/* Load children method */
	private function loadPlayer() {
		
		$this->load->model('player_data');
		
		$this->initialize['player']['data'] = $this->player_data->loadOrderUsernameAsc();
		
	}
	
	
	/* Load children method */
	private function loadTransactionRequest() {
		
		$this->load->model('transaction_request_data');
		
		$load = array(
			'status' => array(
				'Pending',
				'Taken'
			)
		);
		$this->initialize['transaction']['request']['data'] = $this->transaction_request_data->loadBindMultipleStatusOrderIdDesc($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'index'
				),
				'description' => 'Preloode cash market admin panel, cash market management system with a simple layout and high end features. Customize your own cash market management system with us!',
				'javascript' => array(
					'index'
				),
				'keywords' => 'preloode, cash market, management system, cash market management system, content management system, custom management system, custom cash market management system, admin panel, cash market admin panel, content admin panel, custom admin panel, custom cash market admin panel',
				'name' => NULL
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>