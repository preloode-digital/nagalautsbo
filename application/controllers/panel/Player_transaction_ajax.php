<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_transaction_ajax extends CI_Controller {
	
	
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
				'response' => '',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deletePlayerTransaction') {
			
			$this->deletePlayerTransaction($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPlayerTransactionDetail') {
			
			$this->loadPlayerTransactionDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deletePlayerTransaction($data) {
		
		$this->load->model('player_transaction_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$playerTransaction = $this->player_transaction_data->loadBindId($load);
					
					if(!empty($playerTransaction)) {
						
						$delete = array(
							'id' => $playerTransaction[0]['id']
						);
						$this->player_transaction_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Player transaction successfully deleted!</p>',
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
	private function loadPlayerTransactionDetail($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_transaction_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_player'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_player']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$playerTransaction = $this->player_transaction_data->loadBindId($load);
					
					if(!empty($playerTransaction)) {
						
						$load = array(
							'id' => $playerTransaction[0]['player_id']
						);
						$player = $this->player_data->loadBindId($load);
						
						$playerUsername = '';
						
						if(!empty($player)) {
							
							$playerUsername = $player[0]['username'];
							
						}
						
						$playerTransaction[0]['timestamp'] = new DateTime($playerTransaction[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Username</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerUsername.'</p>
							<div class="clearfix"></div>
							<p class="title">Stake</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['stake'].'</p>
							<div class="clearfix"></div>
							<p class="title">Win/Lose</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['winlose'].'</p>
							<div class="clearfix"></div>
							<p class="title">Rake</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['rake'].'</p>
							<div class="clearfix"></div>
							<p class="title">Point</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['point'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$playerTransaction[0]['timestamp']->format('j-m-Y H:i:s').'</p>
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