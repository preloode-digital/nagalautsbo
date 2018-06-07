<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_request_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Transaction failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertTransactionRequest') {
			
			$this->insertTransactionRequest($_POST);
			
		}
		
		else if($_POST['action'] == 'loadFromBank' || $_POST['action'] == 'loadToBank') {
			
			$this->loadBankAccount($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPlayer') {
			
			$this->loadPlayer($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPromotion') {
			
			$this->loadPromotion($_POST);
			
		}
		
		else if($_POST['action'] == 'updateTransactionRequest') {
			
			$this->updateTransactionRequest($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertTransactionRequest($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_request_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'bankAccount' => false,
						'game' => false,
						'player' => false,
						'promotion' => true
					);
					
					if($data['type'] == 'Deposit') {
						
						$load = array(
							'id' => $data['toBankAccount']
						);
						
					}
					
					else {
						
						$load = array(
							'id' => $data['fromBankAccount']
						);
						
					}
					
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						$validation['bankAccount'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank Account doesn\'t exist!</p>';
						
					}
					
					$load = array(
						'id' => $data['game']
					);
					$game = $this->game_data->loadBindId($load);
					
					if(!empty($game)) {
						
						$validation['game'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
						
					}
					
					$load = array(
						'game_id' => $data['game'],
						'status' => 'Active',
						'username' => $data['player']
					);
					$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
					
					if(!empty($playerIndex)) {
						
						$validation['player'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Player doesn\'t exist!</p>';
						
					}
					
					$promotionId = '';
					
					if(!empty($data['promotion'])) {
						
						$load = array(
							'id' => $data['promotion']
						);
						$promotion = $this->promotion_data->loadBindId($load);
						
						if(empty($promotion)) {
							
							$validation['promotion'] = false;
							
						}
						
						else {
							
							$promotionId = $promotion[0]['id'];
							
						}
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$insert = array(
							'amount' => $data['amount'],
							'from_bank_account_id' => $data['fromBankAccount'],
							'game_id' => $game[0]['id'],
							'player_id' => $playerIndex[0]['player_id'],
							'promotion_id' => $promotionId,
							'status' => $data['status'],
							'to_bank_account_id' => $data['toBankAccount'],
							'type' => $data['type']
						);
						
						if($data['status'] == 'Accepted' || $data['status'] == 'Rejected') {
							
							$insert['administrator_id'] = $this->initialize['administrator']['account'][0]['id'];
							
						}
						
						$this->transaction_request_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Transaction request successfully added!</p>',
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
	private function loadBankAccount($data) {
		
		$this->load->model('bank_account_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if($data['action'] == 'loadFromBank') {
				
				$load = array(
					'bank_id' => $data['fromBankId'],
					'type' => 'Withdrawal'
				);
				
			}
			
			else {
				
				$load = array(
					'bank_id' => $data['toBankId'],
					'type' => 'Deposit'
				);
				
			}
			
			$bankAccount = $this->bank_account_data->loadBindBankIdTypeOrderNameAsc($load);
			
			if(!empty($bankAccount)) {
				
				if($data['action'] == 'loadFromBank') {
					
					$this->initialize['response']['response'] .= '<option value="">From Bank Account</option>';
					
				}
				
				else {
					
					$this->initialize['response']['response'] .= '<option value="">To Bank Account</option>';
					
				}
				
				foreach($bankAccount as $key => $value) {
					
					$this->initialize['response']['response'] .= '<option value="'.$value['id'].'">'.$value['number'].' - '.$value['name'].'</option>';
					
				}
				
				$this->initialize['response']['result'] = true;
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function loadPlayer($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'game_id' => $data['game'],
				'status' => 'Active'
			);
			$playerIndex = $this->player_index_data->loadBindGameIdStatusOrderUsernameAsc($load);
			
			if(!empty($playerIndex)) {
				
				$this->initialize['response']['response'] = array();
				
				foreach($playerIndex as $key => $value) {
					
					$this->initialize['response']['response'][] = $value['username'];
					
				}
				
				$this->initialize['response']['result'] = true;
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function loadPromotion($data) {
		
		$this->load->model('promotion_data');
		$this->load->model('promotion_index_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'game_id' => $data['game']
			);
			$promotionIndex = $this->promotion_index_data->loadBindGameIdOrderPromotionNameAsc($load);
			
			if(!empty($promotionIndex)) {
				
				$this->initialize['response']['response'] = '<option value="">Promotion</option>';
				
				foreach($promotionIndex as $key => $value) {
					
					if($value['promotion_minimum_deposit'] <= $data['amount']) {
						
						$this->initialize['response']['response'] .= '<option value="'.$value['promotion_id'].'">'.$value['promotion_name'].'</option>';
						
					}
					
				}
				
				$this->initialize['response']['result'] = true;
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updateTransactionRequest($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_request_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'bankAccount' => false,
						'game' => false,
						'player' => false,
						'promotion' => true
					);
					
					if($data['type'] == 'Deposit') {
						
						$load = array(
							'id' => $data['toBankAccount']
						);
						
					}
					
					else {
						
						$load = array(
							'id' => $data['fromBankAccount']
						);
						
					}
					
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						$validation['bankAccount'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank Account doesn\'t exist!</p>';
						
					}
					
					$load = array(
						'id' => $data['game']
					);
					$game = $this->game_data->loadBindId($load);
					
					if(!empty($game)) {
						
						$validation['game'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
						
					}
					
					$load = array(
						'game_id' => $data['game'],
						'status' => 'Active',
						'username' => $data['player']
					);
					$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
					
					if(!empty($playerIndex)) {
						
						$validation['player'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Player doesn\'t exist!</p>';
						
					}
					
					$promotionId = '';
					
					if(!empty($data['promotion'])) {
						
						$load = array(
							'id' => $data['promotion']
						);
						$promotion = $this->promotion_data->loadBindId($load);
						
						if(empty($promotion)) {
							
							$validation['promotion'] = false;
							
						}
						
						else {
							
							$promotionId = $promotion[0]['id'];
							
						}
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$load = array(
							'id' => $data['id']
						);
						$transactionRequest = $this->transaction_request_data->loadBindId($load);
						
						if(!empty($transactionRequest)) {
							
							$update = array(
								'amount' => $data['amount'],
								'from_bank_account_id' => $data['fromBankAccount'],
								'game_id' => $game[0]['id'],
								'id' => $transactionRequest[0]['id'],
								'player_id' => $playerIndex[0]['player_id'],
								'promotion_id' => $promotionId,
								'status' => $data['status'],
								'to_bank_account_id' => $data['toBankAccount'],
								'type' => $data['type']
							);
							
							if($data['status'] == 'Accepted' || $data['status'] == 'Rejected') {
								
								$insert['administrator_id'] = $this->initialize['administrator']['account'][0]['id'];
								
							}
							
							$this->transaction_request_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Transaction request successfully added!</p>',
								'result' => true
							);
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>