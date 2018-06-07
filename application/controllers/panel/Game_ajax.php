<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Game_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Game process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteGame') {
			
			$this->deleteGame($_POST);
			
		}
		
		else if($_POST['action'] == 'loadGameDetail') {
			
			$this->loadGameDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteGame($data) {
		
		$this->load->model('game_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_game'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_game']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$game = $this->game_data->loadBindId($load);
					
					if(!empty($game)) {
						
						$delete = array(
							'id' => $game[0]['id']
						);
						$this->game_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Game successfully deleted!</p>',
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
	private function loadGameDetail($data) {
		
		$this->load->model('game_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_game'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_game']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$game = $this->game_data->loadBindId($load);
					
					if(!empty($game)) {
						
						if(!empty($game[0]['credit'])) {
							
							$game[0]['credit'] = number_format($game[0]['credit']);
							
						}
						
						$game[0]['timestamp'] = new DateTime($game[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$game[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$game[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Credit</p>
							<p class="colon">:</p>
							<p class="detail">'.$game[0]['credit'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$game[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$game[0]['timestamp']->format('j-m-Y H:i:s').'</p>
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