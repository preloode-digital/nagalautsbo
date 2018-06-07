<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Deposit extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'bank' => array(
				'data' => ''
			),
			'bankAccount' => array(
				'data' => ''
			),
			'transaction' => array(
				'request' => array(
					'data' => ''
				)
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		$this->load->model('player_log_data');
		
		if(!empty($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'player_id' => $account->id,
				'authentication' => $account->authentication
			);
			$log = $this->player_log_data->loadBindAuthenticationPlayerId($load);
			
			if(!empty($log)) {
				
				$load = array(
					'id' => $account->id
				);
				$this->initialize['account']['detail'] = $this->player_data->loadBindId($load);
				
				if(!empty($this->initialize['account']['detail'])) {
					
					$this->initialize['account']['detail'][0]['credit'] = 0;
					
					$load = array(
						'player_id' => $this->initialize['account']['detail'][0]['id']
					);
					$playerIndex = $this->player_index_data->loadBindPlayerIdOrderGameNameAsc($load);
					
					if(!empty($playerIndex)) {
						
						foreach($playerIndex as $key => $value) {
							
							$this->initialize['account']['detail'][0]['credit'] += $value['credit'];
							
						}
						
					}
					
				}
				
			}
			
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
		
		$this->loadBank();
		
		$this->loadBankAccount();
		
		if(!empty($this->initialize['account']['detail'])) {
			
			$this->loadTransactionRequest();
			
		}
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'bank' => $this->initialize['bank'],
				'bankAccount' => $this->initialize['bankAccount'],
				'transaction' => $this->initialize['transaction']
			)
		);
		$this->load->view('deposit', $data);
		
	}
	
	
	/* Load children method */
	private function loadBank() {
		
		$this->load->model('bank_data');
		
		$this->initialize['bank']['data'] = $this->bank_data->loadOrderNameAsc();
		
	}
	
	
	/* Load children method */
	private function loadBankAccount() {
		
		$this->load->model('bank_account_data');
		
		$load = array(
			'status' => 'Active',
			'type' => 'Deposit'
		);
		$this->initialize['bankAccount']['data'] = $this->bank_account_data->loadBindStatusTypeOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadTransactionRequest() {
		
		$this->load->model('transaction_request_data');
		
		$load = array(
			'player_id' => $this->initialize['account']['detail'][0]['id'],
			'type' => 'Deposit'
		);
		$this->initialize['transaction']['request']['data'] = $this->transaction_request_data->loadBindPlayerIdTypeOrderIdDesc($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'css' => array(
					'deposit'
				),
				'javascript' => array(
					'deposit'
				),
				'name' => 'Deposit'
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>