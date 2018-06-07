<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Game_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Game failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertGame') {
			
			$this->insertGame($_POST);
			
		}
		
		else if($_POST['action'] == 'updateGame') {
			
			$this->updateGame($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertGame($data) {
		
		$this->load->model('game_data');
		
		$data['credit'] = preg_replace('#[^0-9]#', '', $data['credit']);
		
		if(empty($data['credit'])) {
			
			$data['credit'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_game'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_game']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$game = $this->game_data->loadBindName($load);
					
					if(empty($game)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Game name already exist!</p>';
						
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
							'credit' => $data['credit'],
							'name' => $data['name'],
							'status' => $data['status']
						);
						$this->game_data->insert($insert);
						
						$this->initialize['response'] = array(
							'response' => '<p>Game successfully added!</p>',
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
	private function updateGame($data) {
		
		$this->load->model('game_data');
		
		$data['credit'] = preg_replace('#[^0-9]#', '', $data['credit']);
		
		if(empty($data['credit'])) {
			
			$data['credit'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_game'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_game']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$game = $this->game_data->loadBindName($load);
					
					if(empty($game)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($game[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($game[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Game name already exist!</p>';
								
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
						$game = $this->game_data->loadBindId($load);
						
						if(!empty($game)) {
							
							$update = array(
								'credit' => $data['credit'],
								'id' => $game[0]['id'],
								'name' => $data['name'],
								'status' => $data['status']
							);
							$this->game_data->update($update);
							
							$this->initialize['response'] = array(
								'response' => '<p>Game successfully edited!</p>',
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