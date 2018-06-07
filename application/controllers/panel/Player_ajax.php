<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Player process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deletePlayer') {
			
			$this->deletePlayer($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPlayerDetail') {
			
			$this->loadPlayerDetail($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPointDetail') {
			
			$this->loadPointDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deletePlayer($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$player = $this->player_data->loadBindId($load);
					
					if(!empty($player)) {
						
						$delete = array(
							'id' => $player[0]['id']
						);
						$this->player_data->delete($delete);
						
						$delete = array(
							'player_id' => $player[0]['id']
						);
						$this->player_index_data->delete($delete);
						
						$this->player_index_data->resetIndex();
						
						$this->initialize['response'] = array(
							'response' => '<p>Player successfully deleted!</p>',
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
	private function loadPlayerDetail($data) {
		
		$this->load->model('bank_data');
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$player = $this->player_data->loadBindId($load);
					
					if(!empty($player)) {
						
						$load = array(
							'player_id' => $player[0]['id']
						);
						$playerIndex = $this->player_index_data->loadBindPlayerIdOrderGameNameAsc($load);
						
						$account = '';
						
						if(!empty($playerIndex)) {
							
							foreach($playerIndex as $key => $value) {
								
								$account .= '<p class="title">'.$value['game_name'].' Account</p>
								<p class="colon">:</p>
								<p class="username">'.$value['username'].'</p>
								<p class="credit">Credit : '.$value['credit'].'</p>
								<div class="clearfix"></div>';
								
							}
							
						}
						
						$load = array(
							'status' => 'Active'
						);
						$bank = $this->bank_data->loadBindStatusOrderNameAsc($load);
						
						$bankName = '';
						
						if(!empty($bank)) {
							
							foreach($bank as $key => $value) {
								
								if($value['id'] == $player[0]['bank_id']) {
									
									$bankName = $value['name'];
									
								}
								
							}
							
						}
						
						$player[0]['timestamp'] = new DateTime($player[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Username</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['username'].'</p>
							<div class="clearfix"></div>
							<p class="title">First Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['first_name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Middle Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['middle_name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Last Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['last_name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Gender</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['gender'].'</p>
							<div class="clearfix"></div>
							'.$account.'
							<p class="title">Bank</p>
							<p class="colon">:</p>
							<p class="detail">'.$bankName.'</p>
							<div class="clearfix"></div>
							<p class="title">Bank Account Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['bank_account_name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Bank Account Number</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['bank_account_number'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$player[0]['timestamp']->format('j-m-Y H:i:s').'</p>
							<div class="clearfix"></div>',
							'result' => true
						);
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>