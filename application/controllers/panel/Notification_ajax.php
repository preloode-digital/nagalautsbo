<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notification_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Notification failed processed!</p>',
				'result' => false,
				'transactionRequest' => ''
			)
		);
		
	}
	
	
	/* Index children method */
	private function getNotification($data) {
		
		$this->load->model('game_data');
		$this->load->model('notification_data');
		$this->load->model('player_data');
		$this->load->model('transaction_request_data');
		
		$data['offset'] = preg_replace('#[^0-9]#', '', $data['offset']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'status' => 'Pending'
			);
			$notification = $this->notification_data->loadBindStatusOrderIdDesc($load);
			
			if(!empty($notification)) {
				
				$load = array(
					'status' => 'Pending'
				);
				$transactionRequest = $this->transaction_request_data->loadBindStatusOrderIdDesc($load);
				
				if(!empty($transactionRequest)) {
					
					$player = $this->player_data->loadOrderUsernameAsc();
					
					$game = $this->game_data->loadOrderNameAsc();
					
					foreach($transactionRequest as $key => $value) {
						
						if($value['id'] > $data['offset']) {
							
							$playerUsername = '';
							
							if(!empty($player)) {
								
								for($i = 0; $i < count($player); $i++) {
									
									if($player[$i]['id'] == $value['player_id']) {
										
										$playerUsername = $player[$i]['username'];
										
									}
									
								}
								
							}
							
							$gameName = '';
							
							if(!empty($game)) {
								
								for($i = 0; $i < count($game); $i++) {
									
									if($game[$i]['id'] == $value['game_id']) {
										
										$gameName = $game[$i]['name'];
										
									}
									
								}
								
							}
							
							$this->initialize['response']['transactionRequest'] .= '<tr class="transaction-request" data-transaction-request-id="'.$value['id'].'">
								<td class="load-detail" transaction-request-id="'.$value['id'].'"><p>'.$value['timestamp'].'</p></td>
								<td><p>'.$playerUsername.'</p></td>
								<td><p>'.$gameName.'</p></td>
								<td><p>'.$value['amount'].'</p></td>
								<td><p>'.$value['type'].'</p></td>
								<td><p>'.$value['status'].'</p></td>
								<td>
									<button class="load-transaction-request-detail action" data-transaction-request-id="'.$value['id'].'"><i class="view-15-white"></i>View</button>
								</td>
							</tr>';
							
						}
						
					}
					
				}
				
				$this->initialize['response']['response'] = count($notification);
				$this->initialize['response']['result'] = true;
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'getNotification') {
			
			$this->getNotification($_POST);
			
		}
		
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
	
		
}
?>