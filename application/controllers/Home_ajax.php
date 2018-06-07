<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'response' => array(
				'response' => '',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		if($_POST['action'] == 'loadResetPassword') {
			
			$this->loadResetPassword();
			
		}
		
		else if($_POST['action'] == 'login') {
			
			$this->login($_POST);
			
		}
		
		else if($_POST['action'] == 'logout') {
			
			$this->logout();
			
		}
		
		else if($_POST['action'] == 'resetPassword') {
			
			$this->resetPassword($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadResetPassword() {
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function login($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_log_data');
		
		$data['password'] = hash('sha512', $data['password']);
		
		$load = array(
			'username' => $data['username']
		);
		$player = $this->player_data->loadBindUsername($load);
		
		if(!empty($player)) {
			
			if($player[0]['password'] == $data['password']) {
				
				$load = array(
					'player_id' => $player[0]['id']
				);
				$log = $this->player_log_data->loadBindPlayerId($load);
				
				if(!empty($log)) {
					
					$last = count($log) - 1;
					
					if($log[$last]['log'] == 'Login') {
						
						$insert = array(
							'authentication' => $log[$last]['authentication'],
							'ip' => $_SERVER['REMOTE_ADDR'],
							'log' => 'Logout',
							'player_id' => $player[0]['id']
						);
						$this->player_log_data->insert($insert);
						
					}
					
				}
				
				$insert = array(
					'authentication' => hash('sha512', uniqid(date('d-m-Y'), true)),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'log' => 'Login',
					'player_id' => $player[0]['id']
				);
				$this->player_log_data->insert($insert);
				
				$account = json_encode(array(
					'authentication' => $insert['authentication'],
					'id' => $player[0]['id']
				));
				setcookie('account', $account, time() + (86400 * 365), $this->config->item('cookie_path'));
				
				$this->initialize['response']['result'] = true;
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Invalid password!</p>';
				
			}
			
		}
		
		else {
			
			$this->initialize['response']['response'] = '<p>Username tidak terdaftar!</p>';
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function logout() {
		
		$this->load->model('player_log_data');
		
		if(isset($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'authentication' => $account->authentication,
				'player_id' => $account->id
			);
			$log = $this->player_log_data->loadBindAuthenticationPlayerId($load);
			
			if(!empty($log)) {
				
				$last = count($log) - 1;
				
				if($log[$last]['log'] == 'Login') {
					
					$insert = array(
						'authentication' => $account->authentication,
						'ip' => $_SERVER['REMOTE_ADDR'],
						'log' => 'Logout',
						'player_id' => $account->id,
					);
					$this->player_log_data->insert($insert);
					
					setcookie('account', '', $_SERVER['REQUEST_TIME'] + (86400 * 1), $this->config->item('cookie_path'));
					
					$this->initialize['response']['result'] = true;
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function resetPassword($data) {
		
		$this->load->model('player_data');
		
	}
	
	
}
?>