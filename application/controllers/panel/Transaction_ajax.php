<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Transaction process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteTransaction') {
			
			$this->deleteTransaction($_POST);
			
		}
		
		else if($_POST['action'] == 'loadTransactionDetail') {
			
			$this->loadTransactionDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteTransaction($data) {
		
		$this->load->model('transaction_adjustment_data');
		$this->load->model('transaction_deposit_data');
		$this->load->model('transaction_expense_data');
		$this->load->model('transaction_inject_data');
		$this->load->model('transaction_saving_data');
		$this->load->model('transaction_withdraw_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					
					$transaction = '';
					
					if($data['type'] == 'Adjustment') {
						
						$transaction = $this->transaction_adjustment_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Deposit') {
						
						$transaction = $this->transaction_deposit_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Expense') {
						
						$transaction = $this->transaction_expense_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Inject') {
						
						$transaction = $this->transaction_inject_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Saving') {
						
						$transaction = $this->transaction_saving_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Withdraw') {
						
						$transaction = $this->transaction_withdraw_data->loadBindId($load);
						
					}
					
					if(!empty($transaction)) {
						
						$delete = array(
							'id' => $transaction[0]['id']
						);
						
						if($data['type'] == 'Adjustment') {
							
							$this->transaction_adjustment_data->delete($delete);
							
						}
						
						else if($data['type'] == 'Deposit') {
							
							$this->transaction_deposit_data->delete($delete);
							
						}
						
						else if($data['type'] == 'Expense') {
							
							$this->transaction_expense_data->delete($delete);
							
						}
						
						else if($data['type'] == 'Inject') {
							
							$this->transaction_inject_data->delete($delete);
							
						}
						
						else if($data['type'] == 'Saving') {
							
							$this->transaction_saving_data->delete($delete);
							
						}
						
						else if($data['type'] == 'Withdraw') {
							
							$this->transaction_withdraw_data->delete($delete);
							
						}
						
						$this->initialize['response'] = array(
							'response' => '<p>Transaction successfully deleted!</p>',
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
	private function loadTransactionDetail($data) {
		
		$this->load->model('administrator_data');
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_adjustment_data');
		$this->load->model('transaction_deposit_data');
		$this->load->model('transaction_expense_data');
		$this->load->model('transaction_inject_data');
		$this->load->model('transaction_saving_data');
		$this->load->model('transaction_withdraw_data');
		
		$this->loadAdministrator();
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					
					if($data['type'] == 'Deposit') {
						
						$transaction = $this->transaction_deposit_data->loadBindId($load);
						$transaction[0]['type'] = 'Deposit';
						
						$load = array(
							'id' => $transaction[0]['promotion_id']
						);
						$promotion = $this->promotion_data->loadBindId($load);
						
					}
					
					else if($data['type'] == 'Withdraw') {
						
						$transaction = $this->transaction_withdraw_data->loadBindId($load);
						$transaction[0]['type'] = 'Withdraw';
						
					}
					
					else if($data['type'] == 'Expense') {
						
						$transaction = $this->transaction_expense_data->loadBindId($load);
						$transaction[0]['type'] = 'Expense';
						
					}
					
					else if($data['type'] == 'Inject') {
						
						$transaction = $this->transaction_inject_data->loadBindId($load);
						$transaction[0]['type'] = 'Inject';
						
					}
					
					else if($data['type'] == 'Saving') {
						
						$transaction = $this->transaction_saving_data->loadBindId($load);
						$transaction[0]['type'] = 'Saving';
						
					}
					
					else if($data['type'] == 'Adjustment') {
						
						$transaction = $this->transaction_adjustment_data->loadBindId($load);
						$transaction[0]['type'] = 'Adjustment';
						
					}
					
					if(!empty($transaction)) {
						
						$this->initialize['response']['response'] = '<p class="title">ID</p>
						<p class="colon">:</p>
						<p class="detail">'.$transaction[0]['id'].'</p>
						<div class="clearfix"></div>';
						
						$load = array(
							'status' => 'Active'
						);
						$player = $this->player_data->loadBindStatusOrderUsernameAsc($load);
						
						$load = array(
							'status' => 'Active'
						);
						$bankAccount = $this->bank_account_data->loadBindStatusOrderNameAsc($load);
						
						if($transaction[0]['type'] == 'Deposit') {
							
							if(!empty($player)) {
								
								foreach($player as $key => $value) {
									
									if($value['id'] == $transaction[0]['player_id']) {
										
										$this->initialize['response']['response'] .= '<p class="title">Transfer From</p>
										<p class="colon">:</p>
										<p class="detail">'.$value['username'].'</p>
										<div class="clearfix"></div>';
										
									}
									
								}
								
							}
							
						}
						
						else {
							
							if(!empty($bankAccount)) {
								
								foreach($bankAccount as $key => $value) {
									
									if($value['id'] == $transaction[0]['from_bank_account_id']) {
										
										$this->initialize['response']['response'] .= '<p class="title">Transfer From</p>
										<p class="colon">:</p>
										<p class="detail">'.$value['name'].' - '.$value['number'].'</p>
										<div class="clearfix"></div>';
										
									}
									
								}
								
							}
							
						}
						
						if($transaction[0]['type'] == 'Withdraw') {
							
							if(!empty($player)) {
								
								foreach($player as $key => $value) {
									
									if($value['id'] == $transaction[0]['player_id']) {
										
										$this->initialize['response']['response'] .= '<p class="title">Transfer To</p>
										<p class="colon">:</p>
										<p class="detail">'.$value['username'].'</p>
										<div class="clearfix"></div>';
										
									}
									
								}
								
							}
							
						}
						
						else {
							
							if(!empty($bankAccount)) {
								
								foreach($bankAccount as $key => $value) {
									
									if($value['id'] == $transaction[0]['to_bank_account_id']) {
										
										$this->initialize['response']['response'] .= '<p class="title">Transfer To</p>
										<p class="colon">:</p>
										<p class="detail">'.$value['name'].' - '.$value['number'].'</p>
										<div class="clearfix"></div>';
										
									}
									
								}
								
							}
							
						}
						
						$this->initialize['response']['response'] .= '<p class="title">Amount</p>
						<p class="colon">:</p>
						<p class="detail">'.number_format($transaction[0]['amount']).'</p>
						<div class="clearfix"></div>';
						
						if($transaction[0]['type'] == 'Deposit') {
							
							$promotionName = '';
							
							if(!empty($promotion)) {
								
								$promotionName = $promotion[0]['name'];
								
							}
							
							$this->initialize['response']['response'] .= '<p class="title">Promotion</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotionName.'</p>
							<div class="clearfix"></div>';
							
						}
						
						$load = array(
							'status' => 'Active'
						);
						$game = $this->game_data->loadBindStatusOrderNameAsc($load);
						
						if($transaction[0]['type'] == 'Deposit' || $transaction[0]['type'] == 'Withdraw') {
							
							if(!empty($game)) {
								
								foreach($game as $key => $value) {
									
									if($value['id'] == $transaction[0]['game_id']) {
										
										$this->initialize['response']['response'] .= '<p class="title">Game</p>
										<p class="colon">:</p>
										<p class="detail">'.$value['name'].'</p>
										<div class="clearfix"></div>';
										
									}
									
								}
								
							}
							
						}
						
						$this->initialize['response']['response'] .= '<p class="title">Note</p>
						<p class="colon">:</p>
						<p class="detail">'.$transaction[0]['note'].'</p>
						<div class="clearfix"></div>';
						
						$administrator = $this->administrator_data->loadOrderUsernameAsc();
						
						if(!empty($administrator)) {
							
							foreach($administrator as $key => $value) {
								
								if($value['id'] == $transaction[0]['administrator_id']) {
									
									$this->initialize['response']['response'] .= '<p class="title">Administrator</p>
									<p class="colon">:</p>
									<p class="detail">'.$value['username'].'</p>
									<div class="clearfix"></div>';
									
								}
								
							}
							
						}
						
						$transaction[0]['timestamp'] = new DateTime($transaction[0]['timestamp']);
						
						$this->initialize['response']['response'] .= '<p class="title">Created Date</p>
						<p class="colon">:</p>
						<p class="detail">'.$transaction[0]['timestamp']->format('j-m-Y H:i:s').'</p>
						<div class="clearfix"></div>';
						
						$this->initialize['response']['result'] = true;
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>