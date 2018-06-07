<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_entry_ajax extends CI_Controller {
	
	
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
		
		if($_POST['action'] == 'insertAdjustment') {
			
			$this->insertAdjustment($_POST);
			
		}
		
		else if($_POST['action'] == 'insertDeposit') {
			
			$this->insertDeposit($_POST);
			
		}
		
		else if($_POST['action'] == 'insertExpense') {
			
			$this->insertExpense($_POST);
			
		}
		
		else if($_POST['action'] == 'insertInject' || $_POST['action'] == 'insertSaving') {
			
			$this->insertInternal($_POST);
			
		}
		
		else if($_POST['action'] == 'insertWithdraw') {
			
			$this->insertWithdraw($_POST);
			
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
		
		else if($_POST['action'] == 'updateAdjustment') {
			
			$this->updateAdjustment($_POST);
			
		}
		
		else if($_POST['action'] == 'updateDeposit') {
			
			$this->updateDeposit($_POST);
			
		}
		
		else if($_POST['action'] == 'updateExpense') {
			
			$this->updateExpense($_POST);
			
		}
		
		else if($_POST['action'] == 'updateInject' || $_POST['action'] == 'updateSaving') {
			
			$this->updateInternal($_POST);
			
		}
		
		else if($_POST['action'] == 'updateWithdraw') {
			
			$this->updateWithdraw($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertAdjustment($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_adjustment_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(empty($data['amount'])) {
			
			$data['amount'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'bankAccount' => false,
					);
					
					if(!empty($data['fromBankAccount'])) {
						
						$load = array(
							'id' => $data['fromBankAccount']
						);
						
					}
					
					else if(!empty($data['toBankAccount'])) {
						
						$load = array(
							'id' => $data['toBankAccount']
						);
						
					}
					
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						if(!empty($data['fromBankAccount'])) {
							
							if($bankAccount[0]['balance'] > $data['amount']) {
								
								$validation['bankAccount'] = true;
								
								$bankAccountId = $data['fromBankAccount'];
								$bankAccountBalance = $bankAccount[0]['balance'] - $data['amount'];
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
								
							}
							
						}
						
						else {
							
							$validation['bankAccount'] = true;
							
							$bankAccountId = $data['toBankAccount'];
							$bankAccountBalance = $bankAccount[0]['balance'] + $data['amount'];
							
						}
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
						
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
							'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
							'amount' => $data['amount'],
							'note' => $data['note']
						);
						
						if(!empty($data['fromBankAccount'])) {
							
							$insert['from_bank_account_id'] = $bankAccountId;
							
						}
						
						else {
							
							$insert['to_bank_account_id'] = $bankAccountId;
							
						}
						
						$this->transaction_adjustment_data->insert($insert);
						
						$update = array(
							'balance' => $bankAccountBalance,
							'id' => $bankAccountId
						);
						$this->bank_account_data->update($update);
						
						$this->initialize['response'] = array(
							'response' => '<p>Adjustment successfully added!</p>',
							'result' => true
						);
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function insertDeposit($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_deposit_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'game_id' => $data['game'],
				'status' => 'Active',
				'username' => $data['player']
			);
			$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
			
			if(!empty($playerIndex)) {
				
				$load = array(
					'id' => $data['promotion']
				);
				$promotion = $this->promotion_data->loadBindId($load);
				
				$amountPromotion = 0;
				
				if(!empty($promotion)) {
					
					$amountPromotion = $data['amount'] * $promotion[0]['percentage'] / 100;
					
					if($amountPromotion > $promotion[0]['cap']) {
						
						$amountPromotion = $promotion[0]['cap'];
						
					}
					
				}
				
				$load = array(
					'id' => $data['game']
				);
				$game = $this->game_data->loadBindId($load);
				
				if(!empty($game)) {
					
					if($game[0]['credit'] < ($data['amount'] + $amountPromotion)) {
						
						$this->initialize['response']['response'] = '<p>Not enough game credit!</p>';
						
					}
					
					else {
						
						$load = array(
							'id' => $data['toBankAccount']
						);
						$bankAccount = $this->bank_account_data->loadBindId($load);
						
						if(!empty($bankAccount)) {
							
							$insert = array(
								'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
								'amount' => $data['amount'],
								'amount_promotion' => $amountPromotion,
								'game_id' => $data['game'],
								'player_id' => $data['player'],
								'note' => $data['note'],
								'promotion_id' => $data['promotion'],
								'to_bank_account_id' => $data['toBankAccount'],
							);
							$this->transaction_deposit_data->insert($insert);
							
							$update = array(
								'balance' => $bankAccount[0]['balance'] + $data['amount'],
								'id' => $data['toBankAccount']
							);
							$this->bank_account_data->update($update);
							
							$update = array(
								'id' => $playerIndex[0]['id'],
								'credit' => $playerIndex[0]['credit'] + ($data['amount'] + $amountPromotion)
							);
							$this->player_index_data->update($update);
							
							$update = array(
								'id' => $game[0]['id'],
								'credit' => $game[0]['credit'] - ($data['amount'] + $amountPromotion)
							);
							$this->game_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Deposit successfully added!</p>',
								'result' => true
							);
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
							
						}
						
					}
					
				}
				
				else {
					
					$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Player username doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function insertExpense($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_expense_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['fromBankAccount']
			);
			$bankAccount = $this->bank_account_data->loadBindId($load);
			
			if(!empty($bankAccount)) {
				
				if($bankAccount[0]['balance'] < $data['amount']) {
					
					$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
					
				}
				
				else {
					
					$insert = array(
						'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
						'amount' => $data['amount'],
						'from_bank_account_id' => $data['fromBankAccount'],
						'note' => $data['note']
					);
					$this->transaction_expense_data->insert($insert);
					
					$update = array(
						'balance' => $bankAccount[0]['balance'] - $data['amount'],
						'id' => $data['fromBankAccount']
					);
					$this->bank_account_data->update($update);
					
					$this->initialize['response'] = array(
						'response' => '<p>Expense successfully added!</p>',
						'result' => true
					);
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function insertInternal($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_inject_data');
		$this->load->model('transaction_saving_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['fromBankAccount']
			);
			$fromBankAccount = $this->bank_account_data->loadBindId($load);
			
			if(!empty($fromBankAccount)) {
				
				if($fromBankAccount[0]['balance'] < $data['amount']) {
					
					$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
					
				}
				
				else {
					
					$load = array(
						'id' => $data['toBankAccount']
					);
					$toBankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($toBankAccount)) {
						
						$insert = array(
							'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
							'amount' => $data['amount'],
							'from_bank_account_id' => $data['fromBankAccount'],
							'note' => $data['note'],
							'to_bank_account_id' => $data['toBankAccount']
						);
						
						if($data['action'] == 'insertInject') {
							
							$this->transaction_inject_data->insert($insert);
							
						}
						
						else {
							
							$this->transaction_saving_data->insert($insert);
							
						}
						
						$update = array(
							'balance' => $fromBankAccount[0]['balance'] - $data['amount'],
							'id' => $data['fromBankAccount']
						);
						$this->bank_account_data->update($update);
						
						$update = array(
							'balance' => $toBankAccount[0]['balance'] + $data['amount'],
							'id' => $data['toBankAccount']
						);
						$this->bank_account_data->update($update);
						
						$this->initialize['response'] = array(
							'response' => '<p>Inject successfully added!</p>',
							'result' => true
						);
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
						
					}
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function insertWithdraw($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('transaction_withdraw_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'game_id' => $data['game'],
				'status' => 'Active',
				'username' => $data['player']
			);
			$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
			
			if(!empty($playerIndex)) {
				
				if($playerIndex[0]['credit'] < $data['amount']) {
					
					$this->initialize['response']['response'] = '<p>Not enough player credit!</p>';
					
				}
				
				else {
					
					$load = array(
						'id' => $data['fromBankAccount']
					);
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						if($bankAccount[0]['balance'] < $data['amount']) {
							
							$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
							
						}
						
						else {
							
							$load = array(
								'id' => $data['game']
							);
							$game = $this->game_data->loadBindId($load);
							
							if(!empty($game)) {
								
								$insert = array(
									'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
									'amount' => $data['amount'],
									'from_bank_account_id' => $data['fromBankAccount'],
									'game_id' => $data['game'],
									'player_id' => $playerIndex[0]['player_id'],
									'note' => $data['note']
								);
								$this->transaction_withdraw_data->insert($insert);
								
								$update = array(
									'balance' => $bankAccount[0]['balance'] - $data['amount'],
									'id' => $data['fromBankAccount']
								);
								$this->bank_account_data->update($update);
								
								$update = array(
									'credit' => $playerIndex[0]['credit'] - $data['amount'],
									'id' => $playerIndex[0]['id']
								);
								$this->player_index_data->update($update);
								
								$update = array(
									'credit' => $game[0]['credit'] + $data['amount'],
									'id' => $game[0]['id']
								);
								$this->game_data->update($update);
								
								$this->initialize['response'] = array(
									'response' => '<p>Withdraw successfully added!</p>',
									'result' => true
								);
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
								
							}
							
						}
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
						
					}
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Player username doesn\'t exist!</p>';
				
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
					'bank_id' => $data['fromBankId']
				);
				
				if($data['type'] == 'Adjustment') {
					
					$bankAccount = $this->bank_account_data->loadBindBankIdOrderNameAsc($load);
					
				}
				
				else {
					
					if($data['type'] == 'Saving') {
						
						$load['type'] = array(
							'Deposit',
							'Withdraw'
						);
						$bankAccount = $this->bank_account_data->loadBindBankIdMultipleTypeOrderNameAsc($load);
						
					}
					
					else {
						
						if($data['type'] == 'Inject From Deposit') {
							
							$load['type'] = 'Deposit';
							
						}
						
						else if($data['type'] == 'Inject From Saving') {
							
							$load['type'] = 'Saving';
							
						}
						
						else if($data['type'] == 'Expense') {
							
							$load['type'] = 'Expense';
							
						}
						
						else if($data['type'] == 'Withdraw') {
							
							$load['type'] = 'Withdraw';
							
						}
						
						$bankAccount = $this->bank_account_data->loadBindBankIdTypeOrderNameAsc($load);
						
					}
					
				}
				
			}
			
			else {
				
				$load = array(
					'bank_id' => $data['toBankId']
				);
				
				if($data['type'] == 'Adjustment') {
					
					$bankAccount = $this->bank_account_data->loadBindBankIdOrderNameAsc($load);
					
				}
				
				else {
					
					if($data['type'] == 'Internal') {
						
						$load['type'] = array(
							'Deposit',
							'Withdraw'
						);
						$bankAccount = $this->bank_account_data->loadBindBankIdMultipleTypeOrderNameAsc($load);
						
					}
					
					else {
						
						if($data['type'] == 'Deposit') {
							
							$load['type'] = 'Deposit';
							
						}
						
						if($data['type'] == 'Inject From Deposit' || $data['type'] == 'Inject From Saving') {
							
							$load['type'] = 'Withdraw';
							
						}
						
						else if($data['type'] == 'Saving') {
							
							$load['type'] = 'Saving';
							
						}
						
						$bankAccount = $this->bank_account_data->loadBindBankIdTypeOrderNameAsc($load);
						
					}
					
				}
				
			}
			
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
	private function updateAdjustment($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_adjustment_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			$adjustment = $this->transaction_adjustment_data->loadBindId($load);
			
			if(!empty($adjustment)) {
				
				$bankAccountAmount = $data['amount'] - $adjustment[0]['amount'];
				
			}
			
			if(!empty($data['fromBankAccount'])) {
				
				$load = array(
					'id' => $data['fromBankAccount']
				);
				
			}
			
			else if(!empty($data['toBankAccount'])) {
				
				$load = array(
					'id' => $data['toBankAccount']
				);
				
			}
			$bankAccount = $this->bank_account_data->loadBindId($load);
			
			if(!empty($bankAccount)) {
				
				$edit = false;
				
				if(!empty($data['fromBankAccount'])) {
					
					if($bankAccount[0]['balance'] < $bankAccountAmount) {
						
						$this->initialize['response']['response'] = '<p>Not enough balance on bank account</p>';
						
					}
					
					else {
						
						$update = array(
							'balance' => $bankAccount[0]['balance'] - $bankAccountAmount,
							'id' => $data['fromBankAccount']
						);
						
						$edit = true;
						
					}
					
				}
				
				else if(!empty($data['toBankAccount'])) {
					
					$update = array(
						'balance' => $bankAccount[0]['balance'] + $bankAccountAmount,
						'id' => $data['toBankAccount']
					);
					
					$edit = true;
					
				}
				
				if($edit == true) {
					
					$this->bank_account_data->update($update);
					
					$update = array(
						'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
						'amount' => $data['amount'],
						'id' => $data['id'],
						'note' => $data['note']
					);
					
					if(!empty($data['fromBankAccount'])) {
						
						$update['from_bank_account_id'] = $data['fromBankAccount'];
						
					}
					
					else {
						
						$update['to_bank_account_id'] = $data['toBankAccount'];
						
					}
					
					$this->transaction_adjustment_data->update($update);
					
					$this->initialize['response'] = array(
						'response' => '<p>Adjustment successfully edited!</p>',
						'result' => true
					);
					
				}
				
				else {
					
					$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updateDeposit($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_deposit_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			$deposit = $this->transaction_deposit_data->loadBindId($load);
			
			if(!empty($deposit)) {
				
				$bankAccountAmount = $data['amount'] - $deposit[0]['amount'];
				
			}
			
			$load = array(
				'game_id' => $data['game'],
				'status' => 'Active',
				'username' => $data['player']
			);
			$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
			
			if(!empty($playerIndex)) {
				
				$load = array(
					'id' => $data['promotion']
				);
				$promotion = $this->promotion_data->loadBindId($load);
				
				$amountPromotion = 0;
				
				if(!empty($promotion)) {
					
					$amountPromotion = $data['amount'] * $promotion[0]['percentage'] / 100;
					
					if($amountPromotion > $promotion[0]['cap']) {
						
						$amountPromotion = $promotion[0]['cap'];
						
					}
					
					$gameAmountPromotion = ($amountPromotion - $this->initialize['transaction']['data'][0]['amount_promotion']);
					
				}
				
				$load = array(
					'id' => $data['game']
				);
				$game = $this->game_data->loadBindId($load);
				
				if(!empty($game)) {
					
					if($game[0]['credit'] < ($bankAccountAmount + $gameAmountPromotion)) {
						
						$this->initialize['response']['response'] = '<p>Not enough game credit!</p>';
						
					}
					
					else {
						
						$load = array(
							'id' => $data['toBankAccount']
						);
						$bankAccount = $this->bank_account_data->loadBindId($load);
						
						if(!empty($bankAccount)) {
							
							$update = array(
								'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
								'amount' => $data['amount'],
								'amount_promotion' => $amountPromotion,
								'game_id' => $data['game'],
								'id' => $data['id'],
								'player_id' => $data['player'],
								'note' => $data['note'],
								'promotion_id' => $data['promotion'],
								'to_bank_account_id' => $data['toBankAccount'],
							);
							$this->transaction_deposit_data->update($update);
							
							$update = array(
								'balance' => $bankAccount[0]['balance'] + $bankAccountAmount,
								'id' => $data['toBankAccount']
							);
							$this->bank_account_data->update($update);
							
							$update = array(
								'id' => $playerIndex[0]['id'],
								'credit' => $playerIndex[0]['credit'] + ($bankAccountAmount + $gameAmountPromotion)
							);
							$this->player_index_data->update($update);
							
							$update = array(
								'id' => $game[0]['id'],
								'credit' => $game[0]['credit'] - ($bankAccountAmount + $gameAmountPromotion)
							);
							$this->game_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Deposit successfully edited!</p>',
								'result' => true
							);
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
							
						}
						
					}
					
				}
				
				else {
					
					$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Player username doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updateExpense($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_expense_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			$expense = $this->transaction_expense_data->loadBindId($load);
			
			if(!empty($expense)) {
				
				$bankAccountAmount = $data['amount'] - $expense[0]['amount'];
				
			}
			
			$load = array(
				'id' => $data['fromBankAccount']
			);
			$bankAccount = $this->bank_account_data->loadBindId($load);
			
			if(!empty($bankAccount)) {
				
				if($bankAccount[0]['balance'] < $bankAccountAmount) {
					
					$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
					
				}
				
				else {
					
					$update = array(
						'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
						'amount' => $data['amount'],
						'from_bank_account_id' => $data['fromBankAccount'],
						'id' => $data['id'],
						'note' => $data['note']
					);
					$this->transaction_expense_data->update($update);
					
					$update = array(
						'balance' => $bankAccount[0]['balance'] - $bankAccountAmount,
						'id' => $data['fromBankAccount']
					);
					$this->bank_account_data->update($update);
					
					$this->initialize['response'] = array(
						'response' => '<p>Expense successfully edited!</p>',
						'result' => true
					);
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updateInternal($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('transaction_inject_data');
		$this->load->model('transaction_saving_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			
			if($data['action'] == 'updateInject') {
				
				$internal = $this->transaction_inject_data->loadBindId($load);
				
			}
			
			else if($data['action'] == 'updateSaving') {
				
				$internal = $this->transaction_saving_data->loadBindId($load);
				
			}
			
			if(!empty($internal)) {
				
				$bankAccountAmount = $data['amount'] - $internal[0]['amount'];
				
			}
			
			$load = array(
				'id' => $data['fromBankAccount']
			);
			$fromBankAccount = $this->bank_account_data->loadBindId($load);
			
			if(!empty($fromBankAccount)) {
				
				if($fromBankAccount[0]['balance'] < $bankAccountAmount) {
					
					$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
					
				}
				
				else {
					
					$load = array(
						'id' => $data['toBankAccount']
					);
					$toBankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($toBankAccount)) {
						
						$update = array(
							'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
							'amount' => $data['amount'],
							'from_bank_account_id' => $data['fromBankAccount'],
							'id' => $data['id'],
							'note' => $data['note'],
							'to_bank_account_id' => $data['toBankAccount']
						);
						
						if($data['action'] == 'updateInject') {
							
							$this->transaction_inject_data->update($update);
							
						}
						
						else {
							
							$this->transaction_saving_data->update($update);
							
						}
						
						$update = array(
							'balance' => $fromBankAccount[0]['balance'] - $bankAccountAmount,
							'id' => $data['fromBankAccount']
						);
						$this->bank_account_data->update($update);
						
						$update = array(
							'balance' => $toBankAccount[0]['balance'] + $bankAccountAmount,
							'id' => $data['toBankAccount']
						);
						$this->bank_account_data->update($update);
						
						$this->initialize['response'] = array(
							'response' => '<p>Inject successfully edited!</p>',
							'result' => true
						);
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
						
					}
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updateWithdraw($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_index_data');
		$this->load->model('transaction_withdraw_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'id' => $data['id']
			);
			$withdraw = $this->transaction_withdraw_data->loadBindId($load);
			
			if(!empty($withdraw)) {
				
				$bankAccountAmount = $data['amount'] - $withdraw[0]['amount'];
				
			}
			
			$load = array(
				'game_id' => $data['game'],
				'status' => 'Active',
				'username' => $data['player']
			);
			$playerIndex = $this->player_index_data->loadBindGameIdStatusUsername($load);
			
			if(!empty($playerIndex)) {
				
				if($playerIndex[0]['credit'] < $bankAccountAmount) {
					
					$this->initialize['response']['response'] = '<p>Not enough player credit!</p>';
					
				}
				
				else {
					
					$load = array(
						'id' => $data['fromBankAccount']
					);
					$bankAccount = $this->bank_account_data->loadBindId($load);
					
					if(!empty($bankAccount)) {
						
						if($bankAccount[0]['balance'] < $bankAccountAmount) {
							
							$this->initialize['response']['response'] = '<p>Not enough balance on bank account!</p>';
							
						}
						
						else {
							
							$load = array(
								'id' => $data['game']
							);
							$game = $this->game_data->loadBindId($load);
							
							if(!empty($game)) {
								
								$update = array(
									'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
									'amount' => $data['amount'],
									'from_bank_account_id' => $data['fromBankAccount'],
									'game_id' => $data['game'],
									'id' => $data['id'],
									'player_id' => $playerIndex[0]['player_id'],
									'note' => $data['note']
								);
								$this->transaction_withdraw_data->update($update);
								
								$update = array(
									'balance' => $bankAccount[0]['balance'] - $bankAccountAmount,
									'id' => $data['fromBankAccount']
								);
								$this->bank_account_data->update($update);
								
								$update = array(
									'credit' => $playerIndex[0]['credit'] - $bankAccountAmount,
									'id' => $playerIndex[0]['id']
								);
								$this->player_index_data->update($update);
								
								$update = array(
									'credit' => $game[0]['credit'] + $bankAccountAmount,
									'id' => $game[0]['id']
								);
								$this->game_data->update($update);
								
								$this->initialize['response'] = array(
									'response' => '<p>Withdraw successfully edited!</p>',
									'result' => true
								);
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
								
							}
							
						}
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Bank account doesn\'t exist!</p>';
						
					}
					
				}
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Player username doesn\'t exist!</p>';
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>