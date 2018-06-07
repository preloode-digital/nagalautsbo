<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_request extends CI_Controller {
	
	
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
				'os' => $this->device->getOs(),
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
			'promotion' => array(
				'data' => ''
			),
			'transaction' => array(
				'request' => array(
					'data' => '',
					'page' => 0,
					'pagination' => '',
					'totalRow' => ''
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
	
	
	/* Index children method */
	private function checkPrivilege() {
		
		if(empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
			
			header('Location: '.base_url().'restricted_access/');
			
			exit();
			
		}
		
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
		
		$this->loadTransactionRequestPagination();
		
		$this->loadAdministrator();
		
		$this->loadGame();
		
		$this->loadPlayer();
		
		$this->loadPromotion();
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'filter' => $this->initialize['filter'],
				'game' => $this->initialize['game'],
				'player' => $this->initialize['player'],
				'promotion' => $this->initialize['promotion'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('panel/transaction_request', $data);
		
	}
	
	
	/* Load children method */
	private function loadAdministrator() {
		
		$this->load->model('administrator_data');
		
		$this->initialize['administrator']['data'] = $this->administrator_data->loadOrderUsernameAsc();
		
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
	
	
	/* Load children method */
	private function loadPromotion() {
		
		$this->load->model('promotion_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['promotion']['data'] = $this->promotion_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadTransactionRequestPagination() {
		
		$this->load->model('transaction_request_data');
		$this->load->library('pagination');
		
		if(!empty($this->uri->segment(3))) {
			
			$this->initialize['transaction']['request']['page'] = preg_replace('#[^0-9]#', '', $this->uri->segment(3)) - 1;
			
		}
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'game' => 'game_id',
				'id' => 'id',
				'player' => 'player_id',
				'promotion' => 'promotion_id',
				'status' => 'status',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'name' => 'filter_transaction_request'
		);
		$this->initialize['transaction']['request']['totalRow'] = count($this->transaction_request_data->loadIdPagination($load));
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = $this->config->item('panel_url');
		$pagination['total_rows'] = $this->initialize['transaction']['request']['totalRow'];
		$this->pagination->initialize($pagination);
		$this->initialize['transaction']['request']['pagination'] = $this->pagination->create_links();
		
		$load = array(
			'account' => $this->initialize['administrator']['account'][0]['id'],
			'column' => array(
				'administrator' => 'administrator_id',
				'amount' => 'amount',
				'game' => 'game_id',
				'id' => 'id',
				'player' => 'player_id',
				'promotion' => 'promotion_id',
				'status' => 'status',
				'timestamp' => 'timestamp',
				'toBankAccount' => 'to_bank_account_id'
			),
			'offset' => $pagination['per_page'] * $this->initialize['transaction']['request']['page'],
			'limit' => $pagination['per_page'],
			'name' => 'filter_transaction_request'
		);		
		$this->initialize['transaction']['request']['data'] = $this->transaction_request_data->loadPagination($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator'],
				'css' => array(
					'transaction_request'
				),
				'description' => 'Indo Poker League, komunitas online poker pppoker terbesar di indonesia!',
				'javascript' => array(
					'transaction_request'
				),
				'keywords' => 'indo,poker,league,indo poker,indo poker league,indopokerleague,komunitas,online,poker,komunitas online,pppoker,komunitas online,komunitas online poker,komunitas online poker pppoker',
				'name' => 'Transaction Request'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>