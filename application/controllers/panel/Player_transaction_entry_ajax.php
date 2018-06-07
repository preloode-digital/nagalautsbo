<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_transaction_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Player transaction failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertPlayerTransaction') {
			
			$this->insertPlayerTransaction($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPlayer') {
			
			$this->loadPlayer($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPlayerId') {
			
			$this->loadPlayerId($_POST);
			
		}
		
		else if($_POST['action'] == 'updatePlayerTransaction') {
			
			$this->updatePlayerTransaction($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertPlayerTransaction($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_transaction_data');
		
		$data['point'] = preg_replace('#[^0-9.]#', '', $data['point']);
		
		if(empty($data['point'])) {
			
			$data['point'] = 0;
			
		}
		
		$data['rake'] = preg_replace('#[^0-9.]#', '', $data['rake']);
		
		if(empty($data['rake'])) {
			
			$data['rake'] = 0;
			
		}
		
		$data['stake'] = preg_replace('#[^0-9.]#', '', $data['stake']);
		
		if(empty($data['stake'])) {
			
			$data['stake'] = 0;
			
		}
		
		$data['winlose'] = preg_replace('#[^0-9.]#', '', $data['winlose']);
		
		if(empty($data['winlose'])) {
			
			$data['winlose'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'player' => false
					);
					
					$load = array(
						'username' => $data['player']
					);
					$player = $this->player_data->loadBindUsername($load);
					
					if(!empty($player)) {
						
						$validation['player'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Player doesn\'t exist!</p>';
						
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
							'date' => $data['date'],
							'player_id' => $player[0]['id'],
							'point' => $data['point'],
							'rake' => $data['rake'],
							'stake' => $data['stake'],
							'winlose' => $data['winlose']
						);
						$this->player_transaction_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Player transaction successfully added!</p>',
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
	private function loadPlayer($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'status' => 'Active'
			);
			$playerIndex = $this->player_index_data->loadBindStatusOrderUsernameAsc($load);
			
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
	private function loadPlayerId($data) {
		
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$load = array(
				'username' => $data['username']
			);
			$playerIndex = $this->player_index_data->loadBindUsername($load);
			
			if(!empty($playerIndex)) {
				
				$this->initialize['response'] = array(
					'response' => $playerIndex[0]['player_id'],
					'result' => true
				);
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function updatePlayerTransaction($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_transaction_data');
		
		$data['point'] = preg_replace('#[^0-9.]#', '', $data['point']);
		
		if(empty($data['point'])) {
			
			$data['point'] = 0;
			
		}
		
		$data['rake'] = preg_replace('#[^0-9.]#', '', $data['rake']);
		
		if(empty($data['rake'])) {
			
			$data['rake'] = 0;
			
		}
		
		$data['stake'] = preg_replace('#[^0-9.]#', '', $data['stake']);
		
		if(empty($data['stake'])) {
			
			$data['stake'] = 0;
			
		}
		
		$data['winlose'] = preg_replace('#[^0-9.]#', '', $data['winlose']);
		
		if(empty($data['winlose'])) {
			
			$data['winlose'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'player' => false
					);
					
					$load = array(
						'username' => $data['player']
					);
					$player = $this->player_data->loadBindUsername($load);
					
					if(!empty($player)) {
						
						$validation['player'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Player doesn\'t exist!</p>';
						
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
						$playerTransaction = $this->player_transaction_data->loadBindId($load);
						
						if(!empty($playerTransaction)) {
							
							$update = array(
								'administrator_id' => $this->initialize['administrator']['account'][0]['id'],
								'date' => $data['date'],
								'id' => $playerTransaction[0]['id'],
								'player_id' => $player[0]['id'],
								'point' => $data['point'],
								'rake' => $data['rake'],
								'stake' => $data['stake'],
								'winlose' => $data['winlose']
							);
							$this->player_transaction_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Player transaction successfully edited!</p>',
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