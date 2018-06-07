<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Player failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertPlayer') {
			
			$this->insertPlayer($_POST);
			
		}
		
		else if($_POST['action'] == 'updatePlayer') {
			
			$this->updatePlayer($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertPlayer($data) {
		
		$this->load->model('game_data');
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		$data['password'] = hash('sha512', $data['password']);
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'username' => false
					);
					
					$load = array(
						'username' => $data['username']
					);
					$player = $this->player_data->loadBindUsername($load);
					
					if(empty($player)) {
						
						$validation['username'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Player username already exist!</p>';
						
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
							'bank_account_name' => $data['bankAccountName'],
							'bank_account_number' => $data['bankAccountNumber'],
							'bank_id' => $data['bank'],
							'email' => $data['email'],
							'first_name' => $data['firstName'],
							'gender' => $data['gender'],
							'last_name' => $data['lastName'],
							'middle_name' => $data['middleName'],
							'password' => $data['password'],
							'phone' => $data['phone'],
							'picture' => $data['picture'],
							'status' => $data['status'],
							'username' => $data['username']
						);
						$this->player_data->insert($insert);
						
						$load = array(
							'status' => 'Active'
						);
						$game = $this->game_data->loadBindStatusOrderNameAsc($load);
						
						if(!empty($game)) {
							
							for($i = 0; $i < count($game); $i++) {
								
								$data['game']['credit'][$i] = preg_replace('#[^0-9]#', '', $data['game']['credit'][$i]);
									
								if(empty($data['game']['credit'][$i])) {
									
									$data['game']['credit'][$i] = 0;
									
								}
								
								$insert = array(
									'credit' => $data['game']['credit'][$i],
									'game_id' => $game[$i]['id'],
									'player_id' => $this->player_data->initialize['insert_id'],
									'status' => $data['status'],
									'username' => $data['game']['id'][$i]
								);
								$this->player_index_data->insert($insert);
								
							}
							
						}
						
						$this->initialize['response'] = array(
							'response' => '<p>Player successfully added!</p>',
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
	
	
	/* Upload picture children method */
	private function resizePicture($data) {
		
		$this->load->model('player_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$source['path'] = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$data['path'];
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			if($source['width'] > 600) {
				
				$destination = array(
					'height' => (600 / $source['width']) * $source['height'],
					'width' => 600
				);
				
				$resize = array(
					'destinationHeight' => $destination['height'],
					'destinationPath' => '/'.$data['path'],
					'destinationX' => 0,
					'destinationWidth' => $destination['width'],
					'destinationY' => 0,
					'sourceHeight' => $source['height'],
					'sourcePath' => '/'.$data['path'],
					'sourceX' => 0,
					'sourceWidth' => $source['width'],
					'sourceY' => 0
				);
				$this->player_data->resizePicture($resize);
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function updatePlayer($data) {
		
		$this->load->model('game_data');
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'username' => false
					);
					
					$load = array(
						'username' => $data['username']
					);
					$player = $this->player_data->loadBindUsername($load);
					
					if(empty($player)) {
						
						$validation['username'] = true;
						
					}
					
					else {
						
						if($player[0]['id'] != $data['id']) {
							
							$validation['username'] = true;
							
						}
						
						else {
							
							if($player[0]['username'] == $data['username']) {
								
								$validation['username'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Player username already exist!</p>';
								
							}
							
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
						$player = $this->player_data->loadBindId($load);
						
						if(!empty($player)) {
							
							if($player[0]['password'] != $data['password']) {
								
								$data['password'] = hash('sha512', $data['password']);
								
							}
							
							$update = array(
								'bank_account_name' => $data['bankAccountName'],
								'bank_account_number' => $data['bankAccountNumber'],
								'bank_id' => $data['bank'],
								'email' => $data['email'],
								'first_name' => $data['firstName'],
								'gender' => $data['gender'],
								'id' => $player[0]['id'],
								'last_name' => $data['lastName'],
								'middle_name' => $data['middleName'],
								'password' => $data['password'],
								'phone' => $data['phone'],
								'picture' => $data['picture'],
								'status' => $data['status'],
								'username' => $data['username']
							);
							$this->player_data->update($update);
							
							$delete = array(
								'player_id' => $data['id'],
							);
							$this->player_index_data->delete($delete);
							
							$load = array(
								'status' => 'Active'
							);
							$game = $this->game_data->loadBindStatusOrderNameAsc($load);
							
							if(!empty($game)) {
								
								for($i = 0; $i < count($game); $i++) {
									
									$data['game']['credit'][$i] = preg_replace('#[^0-9]#', '', $data['game']['credit'][$i]);
									
									if(!empty($data['game']['credit'][$i])) {
										
										$data['game']['credit'][$i] = 0;
										
									}
									
									$insert = array(
										'credit' => $data['game']['credit'][$i],
										'game_id' => $game[$i]['id'],
										'player_id' => $data['id'],
										'status' => $data['status'],
										'username' => $data['game']['id'][$i]
									);
									$this->player_index_data->insert($insert);
									
								}
								
							}
							
							$this->player_index_data->resetIndex();
							
							$this->initialize['response'] = array(
								'response' => '<p>Player successfully edited!</p>',
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
	private function uploadPicture($data) {
		
		$this->load->model('player_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->player_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/player/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/player/'.$upload['file_name']
				);
				$this->resizePicture($resize);
				
			}
			
			else {
				
				$this->initialize['response'] = array(
					'response' => $upload,
					'result' => false
				);
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>