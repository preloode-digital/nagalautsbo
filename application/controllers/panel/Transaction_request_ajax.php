<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction_request_ajax extends CI_Controller {
	
	
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
				'output' => '',
				'response' => '<p>Transaction request process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'acceptTransactionRequest') {
			
			$this->acceptTransactionRequest($_POST);
			
		}
		
		else if($_POST['action'] == 'loadTransactionRequestDetail') {
			
			$this->loadTransactionRequestDetail($_POST);
			
		}
		
		else if($_POST['action'] == 'rejectTransactionRequest') {
			
			$this->rejectTransactionRequest($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function acceptTransactionRequest($data) {
		
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_deposit_data');
		$this->load->model('transaction_request_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[2] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$transactionRequest = $this->transaction_request_data->loadBindId($load);
					
					if(!empty($transactionRequest)) {
						
						$validation = array(
							'bankAccount' => false,
							'game' => false,
							'player' => false,
							'playerIndex' => false,
							'promotion' => true,
							'status' => false
						);
						
						if($transactionRequest[0]['type'] == 'Deposit') {
							
							$load = array(
								'id' => $transactionRequest[0]['to_bank_account_id']
							);
							
						}
						
						else {
							
							$load = array(
								'id' => $data['bankAccountId']
							);
							
						}
						
						$bankAccount = $this->bank_account_data->loadBindId($load);
						
						if(!empty($bankAccount)) {
							
							if($transactionRequest[0]['type'] == 'Deposit') {
								
								$validation['bankAccount'] = true;
								
							}
							
							else {
								
								if($bankAccount[0]['balance'] >= $transactionRequest[0]['amount']) {
									
									$validation['bankAccount'] = true;
									
								}
								
								else {
									
									$this->initialize['response']['response'] = '<p>Not enough bank account balance!</p>';
									
								}
								
							}
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Bank Account doesn\'t exist!</p>';
							
						}
						
						$load = array(
							'id' => $transactionRequest[0]['promotion_id']
						);
						$promotion = $this->promotion_data->loadBindId($load);
						
						$promotionId = '';
						$amountPromotion = 0;
						
						if(!empty($promotion)) {
							
							$promotionId = $promotion[0]['id'];
							$amountPromotion = $transactionRequest[0]['amount'] * $promotion[0]['percentage'] / 100;
							
							if($amountPromotion > $promotion[0]['cap']) {
								
								$amountPromotion = $promotion[0]['cap'];
								
							}
							
						}
						
						$load = array(
							'id' => $transactionRequest[0]['game_id']
						);
						$game = $this->game_data->loadBindId($load);
						
						$gameName = '';
						
						if(!empty($game)) {
							
							if($transactionRequest[0]['type'] == 'Withdrawal') {
								
								$validation['game'] = true;
								
							}
							
							else {
								
								if($game[0]['credit'] >= ($transactionRequest[0]['amount'] + $amountPromotion)) {
									
									$validation['game'] = true;
									
								}
								
								else {
									
									$this->initialize['response']['response'] = '<p>Not enough game credit!</p>';
									
								}
								
							}
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Game doesn\'t exist!</p>';
							
						}
						
						$load = array(
							'id' => $transactionRequest[0]['player_id']
						);
						$player = $this->player_data->loadBindId($load);
						
						if(!empty($player)) {
							
							$validation['player'] = true;
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Player doesn\'t exist!</p>';
							
						}
						
						$load = array(
							'game_id' => $transactionRequest[0]['game_id'],
							'player_id' => $transactionRequest[0]['player_id']
						);
						$playerIndex = $this->player_index_data->loadBindGameIdPlayerId($load);
						
						if(!empty($playerIndex)) {
							
							$validation['playerIndex'] = true;
							
						}
						
						else {
							
							$this->initialize['response']['response'] = '<p>Player index doesn\'t exist!</p>';
							
						}
						
						if($transactionRequest[0]['status'] == 'Pending' || $transactionRequest[0]['status'] == 'Taken') {
							
							$validation['status'] = true;
							
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
							
							$update = array(
								'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
								'id' => $transactionRequest[0]['id'],
								'status' => 'Accepted'
							);
							
							if($transactionRequest[0]['type'] == 'Withdrawal') {
								
								$update['from_bank_account_id'] = $data['bankAccountId'];
								
							}
							
							$this->transaction_request_data->update($update);
							
							if($transactionRequest[0]['type'] == 'Deposit') {
								
								$insert = array(
									'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
									'amount' => $transactionRequest[0]['amount'],
									'amount_promotion' => $amountPromotion,
									'game_id' => $game[0]['id'],
									'player_id' => $player[0]['id'],
									'promotion_id' => $promotionId,
									'to_bank_account_id' => $transactionRequest[0]['to_bank_account_id']
								);
								$this->transaction_deposit_data->insert($insert);
								
								$update = array(
									'balance' => $bankAccount[0]['balance'] + $transactionRequest[0]['amount'],
									'id' => $transactionRequest[0]['to_bank_account_id']
								);
								$this->bank_account_data->update($update);
								
								$update = array(
									'id' => $playerIndex[0]['id'],
									'credit' => $playerIndex[0]['credit'] + ($transactionRequest[0]['amount'] + $amountPromotion)
								);
								$this->player_index_data->update($update);
								
								$update = array(
									'id' => $game[0]['id'],
									'credit' => $game[0]['credit'] - ($transactionRequest[0]['amount'] + $amountPromotion)
								);
								$this->game_data->update($update);
								
							}
							
							else {
								
								$insert = array(
									'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
									'amount' => $transactionRequest[0]['amount'],
									'from_bank_account_id' => $data['bankAccountId'],
									'game_id' => $game[0]['id'],
									'player_id' => $player[0]['id'],
								);
								$this->transaction_withdraw_data->insert($insert);
								
								$update = array(
									'balance' => $bankAccount[0]['balance'] - $transactionRequest[0]['amount'],
									'id' => $data['bankAccountId']
								);
								$this->bank_account_data->update($update);
								
								$update = array(
									'id' => $playerIndex[0]['id'],
									'credit' => $playerIndex[0]['credit'] - $transactionRequest[0]['amount']
								);
								$this->player_index_data->update($update);
								
								$update = array(
									'id' => $game[0]['id'],
									'credit' => $game[0]['credit'] + $transactionRequest[0]['amount']
								);
								$this->game_data->update($update);
								
							}
							
							$this->initialize['response'] = array(
								'response' => '<td class="load-detail" transaction-request-id="'.$transactionRequest[0]['id'].'"><p>'.$transactionRequest[0]['timestamp'].'</p></td>
								<td><p>'.$player[0]['username'].'</p></td>
								<td><p>'.$game[0]['name'].'</p></td>
								<td><p>'.$transactionRequest[0]['amount'].'</p></td>
								<td><p>'.$transactionRequest[0]['type'].'</p></td>
								<td><p>Accepted</p></td>
								<td>
									<button class="load-detail action" transaction-request-id="'.$transactionRequest[0]['id'].'"><i class="trash-15-white"></i>View Detail</button>
								</td>',
								'result' => true
							);
							
						}
						
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
	private function loadTransactionRequestDetail($data) {
		
		$this->load->model('bank_data');
		$this->load->model('bank_account_data');
		$this->load->model('game_data');
		$this->load->model('notification_data');
		$this->load->model('player_data');
		$this->load->model('promotion_data');
		$this->load->model('transaction_request_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$transactionRequest = $this->transaction_request_data->loadBindId($load);
					
					if(!empty($transactionRequest)) {
						
						$player = $this->player_data->loadOrderUsernameAsc();
						
						$playerUsername = '';
						
						if(!empty($player)) {
							
							foreach($player as $key => $value) {
								
								if($value['id'] == $transactionRequest[0]['player_id']) {
									
									$playerUsername = $value['username'];
									
								}
								
							}
							
						}
						
						$game = $this->game_data->loadOrderNameAsc();
						
						$gameName = '';
						
						if(!empty($game)) {
							
							foreach($game as $key => $value) {
								
								if($value['id'] == $transactionRequest[0]['game_id']) {
									
									$gameName = $value['name'];
									
								}
								
							}
							
						}
						
						$transactionRequest[0]['timestamp'] = new DateTime($transactionRequest[0]['timestamp']);
						$button = '';
						
						if($transactionRequest[0]['status'] == 'Pending' || $transactionRequest[0]['status'] == 'Taken') {
							
							$button = '<div class="button">
								<button class="accept" name="accept" type="submit" data-transaction-request-id="'.$transactionRequest[0]['id'].'">Accept</button>
								<button class="reject" name="reject" type="submit" data-transaction-request-id="'.$transactionRequest[0]['id'].'">Reject</button>
							</div>';
							
						}
						
						$bankAccountOption = '';
						
						if($transactionRequest[0]['type'] == 'Withdrawal') {
							
							$load = array(
								'status' => 'Active',
								'type' => 'Withdrawal'
							);
							$bankAccount = $this->bank_account_data->loadBindStatusTypeOrderNameAsc($load);
							
							$bank = $this->bank_data->loadOrderNameAsc();
							
							$bankAccountOption = '<p class="title">Bank Account</p>
							<p class="colon">:</p>
							<select class="bank-account" name="bank-account">';
							
							if(!empty($bankAccount)) {
								
								foreach($bankAccount as $key => $value) {
									
									if(!empty($bank)) {
										
										for($i = 0; $i < count($bank); $i++) {
											
											if($bank[0]['id'] = $value['bank_id']) {
												
												$bankAccountOption .= '<option value="'.$value['id'].'">'.$bank[0]['name'].' - '.$value['number'].' - '.$value['name'].'</option>';
												
											}
											
										}
										
									}
									
								}
								
							}
							
							$bankAccountOption .= '</select>
							<div class="clearfix"></div>';
							
						}
						
						$load = array(
							'transaction_request_id' => $transactionRequest[0]['id']
						);
						$notification = $this->notification_data->loadBindTransactionRequestId($load);
						
						$notificationId = 0;
						
						if(!empty($notification)) {
							
							$notificationId = $notification[0]['id'];
							
						}
						
						$this->initialize['response']['response'] = '<p class="title">ID</p>
						<p class="colon">:</p>
						<p class="detail">'.$transactionRequest[0]['id'].'</p>
						<div class="clearfix"></div>
						<p class="title">Player</p>
						<p class="colon">:</p>
						<p class="detail">'.$playerUsername.'</p>
						<div class="clearfix"></div>
						<p class="title">Game</p>
						<p class="colon">:</p>
						<p class="detail">'.$gameName.'</p>
						<div class="clearfix"></div>
						<p class="title">Type</p>
						<p class="colon">:</p>
						<p class="detail">'.$transactionRequest[0]['type'].'</p>
						<div class="clearfix"></div>
						<p class="title">Amount</p>
						<p class="colon">:</p>
						<p class="detail">'.$transactionRequest[0]['amount'].'</p>
						<div class="clearfix"></div>
						'.$bankAccountOption.'
						<p class="title">Status</p>
						<p class="colon">:</p>
						<p class="detail">'.$transactionRequest[0]['status'].'</p>
						<div class="clearfix"></div>
						<p class="title">Created Date</p>
						<p class="colon">:</p>
						<p class="detail">'.$transactionRequest[0]['timestamp']->format('j-m-Y H:i:s').'</p>
						<div class="clearfix"></div>'
						.$button;
						
						$update = array(
							'id' => $transactionRequest[0]['id'],
							'status' => 'Taken'
						);
						$this->transaction_request_data->update($update);
						
						$update = array(
							'id' => $notificationId,
							'status' => 'Viewed'
						);
						$this->notification_data->update($update);
						
						$this->initialize['response']['result'] = true;
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function rejectTransactionRequest($data) {
		
		$this->load->model('game_data');
		$this->load->model('player_data');
		$this->load->model('transaction_request_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_transaction'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_transaction']);
				
				if($privilege[2] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$transactionRequest = $this->transaction_request_data->loadBindId($load);
					
					if(!empty($transactionRequest)) {
						
						$validation = array(
							'status' => false
						);
						
						if($transactionRequest[0]['status'] == 'Pending' || $transactionRequest[0]['status'] == 'Taken') {
							
							$validation['status'] = true;
							
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
							
							$update = array(
								'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
								'id' => $transactionRequest[0]['id'],
								'status' => 'Rejected'
							);
							$this->transaction_request_data->update($update);
							
							$load = array(
								'id' => $transactionRequest[0]['id']
							);
							$transactionRequest = $this->transaction_request_data->loadBindId($load);
							
							if(!empty($transactionRequest)) {
								
								$load = array(
									'id' => $transactionRequest[0]['game_id']
								);
								$game = $this->game_data->loadBindId($load);
								
								$gameName = '';
								
								if(!empty($game)) {
									
									$gameName = $game[0]['name'];
									
								}
								
								$load = array(
									'id' => $transactionRequest[0]['player_id']
								);
								$player = $this->player_data->loadBindId($load);
								
								$playerUsername = '';
								
								if(!empty($player)) {
									
									$playerUsername = $player[0]['username'];
									
								}
								
								$this->initialize['response'] = array(
									'response' => '<td class="load-detail" transaction-request-id="'.$transactionRequest[0]['id'].'"><p>'.$transactionRequest[0]['timestamp'].'</p></td>
									<td><p>'.$playerUsername.'</p></td>
									<td><p>'.$gameName.'</p></td>
									<td><p>'.$transactionRequest[0]['amount'].'</p></td>
									<td><p>'.$transactionRequest[0]['type'].'</p></td>
									<td><p>Rejected</p></td>
									<td>
										<button class="load-detail action" transaction-request-id="'.$transactionRequest[0]['id'].'"><i class="trash-15-white"></i>View Detail</button>
									</td>',
									'result' => true
								);
								
							}
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>