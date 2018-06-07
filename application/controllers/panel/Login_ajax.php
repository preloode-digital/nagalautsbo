<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'administrator' => array(
				'browser' => $this->device->getBrowser(),
				'data' => '',
				'ip' => $_SERVER['REMOTE_ADDR'],
				'log' => '',
				'os' => $this->device->getOs()
			),
			'log' => array(
				'data' => ''
			),
			'response' => array(
				'baseUrl' => base_url(),
				'name' => '',
				'panelUrl' => $this->config->item('panel_url'),
				'picture' => '',
				'response' => '<p>Login failed!</p>',
				'result' => false,
				'username' => ''
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		if($_POST['action'] == 'checkPassword') {
			
			$this->checkPassword($_POST);
			
		}
		
		else if($_POST['action'] == 'checkUsername') {
			
			$this->checkUsername($_POST);
			
		}
		
		else if($_POST['action'] == 'logout') {
			
			$this->logout();
			
		}
		
	}
	
	
	/* Index children method */
	private function checkPassword($data) {
		
		$this->load->model('administrator_data');
		
		$data['password'] = hash('sha512', $data['password']);
		
		$load = array(
			'username' => $data['username']
		);
		$this->initialize['administrator']['data'] = $this->administrator_data->loadBindUsername($load);
		
		if(!empty($this->initialize['administrator']['data'])) {
			
			if($this->initialize['administrator']['data'][0]['password'] == $data['password'] || $this->initialize['administrator']['data'][0]['recovery_password'] == $data['password']) {
				
				$this->login();
				
				$this->initialize['response']['result'] = true;
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Invalid password!</p>';
								
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function checkUsername($data) {
		
		$this->load->model('administrator_data');
		
		$load = array(
			'username' => $data['username']
		);
		$this->initialize['administrator']['data'] = $this->administrator_data->loadBindUsername($load);
		
		if(!empty($this->initialize['administrator']['data'])) {
			
			if($this->initialize['administrator']['data'][0]['status'] == 'Active') {
				
				if(empty($this->initialize['administrator']['data'][0]['picture'])) {
					
					$this->initialize['administrator']['data'][0]['picture'] = 'asset/image/panel/administrator/administrator_picture.png';
					
				}
				
				$this->initialize['response']['name'] = $this->initialize['administrator']['data'][0]['first_name'];
				
				if(!empty($this->initialize['administrator']['data'][0]['middle_name'])) {
					
					$this->initialize['response']['name'] .= ' '.$this->initialize['administrator']['data'][0]['middle_name'];
					
				}
				
				if(!empty($this->initialize['administrator']['data'][0]['last_name'])) {
					
					$this->initialize['response']['name'] .= ' '.$this->initialize['administrator']['data'][0]['last_name'];
					
				}
				
				$this->initialize['response']['picture'] = base_url().$this->initialize['administrator']['data'][0]['picture'];
				$this->initialize['response']['result'] = true;
				$this->initialize['response']['username'] = $this->initialize['administrator']['data'][0]['username'];
				
			}
			
			else {
				
				$this->initialize['response']['response'] = '<p>Account has not been activated!</p>';
				
			}
			
		}
		
		else {
			
			$this->initialize['response']['response'] = '<p>Cannot find your account!</p>';
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Check password children method */
	private function login() {
		
		$this->load->model('administrator_log_data');
		
		$load = array(
			'administrator_id' => $this->initialize['administrator']['data'][0]['id'],
			'browser' => $this->initialize['administrator']['browser'],
			'ip' => $_SERVER['REMOTE_ADDR'],
			'os' => $this->initialize['administrator']['os']
		);
		$log = $this->administrator_log_data->loadBindAdministratorIdBrowserIpOsOrderIdDesc($load);
		
		if(!empty($log)) {
			
			if($log[0]['log'] == 'Login') {
				
				$insert = array(
					'administrator_id' => $this->initialize['administrator']['data'][0]['id'],
					'authentication' => $log[0]['authentication'],
					'browser' => $this->initialize['administrator']['browser'],
					'ip' => $_SERVER['REMOTE_ADDR'],
					'log' => 'Logout',
					'os' => $this->initialize['administrator']['os']
				);
				$this->administrator_log_data->insert($insert);
				
			}
			
		}
		
		$insert = array(
			'administrator_id' => $this->initialize['administrator']['data'][0]['id'],
			'authentication' => hash('sha512', uniqid(date('m-d-Y'), true)),
			'browser' => $this->initialize['administrator']['browser'],
			'ip' => $_SERVER['REMOTE_ADDR'],
			'log' => 'Login',
			'os' => $this->initialize['administrator']['os']
		);
		$this->administrator_log_data->insert($insert);
		
		$administrator = json_encode(array(
			'id' => $this->initialize['administrator']['data'][0]['id'],
			'authentication' => $insert['authentication']
		));
		setcookie('administrator', $administrator, time() + (86400 * 365), $this->config->item('cookie_path'));
		
	}
	
	
	/* Index children method */
	private function logout() {
		
		$this->load->model('administrator_log_data');
		
		if(isset($_COOKIE['administrator'])) {
			
			$administrator = json_decode($_COOKIE['administrator']);
			
			$load = array(
				'administrator_id' => $administrator->id,
				'authentication' => $administrator->authentication,
				'browser' => $this->initialize['administrator']['browser'],
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->initialize['administrator']['os']
			);
			$log = $this->administrator_log_data->loadBindAdministratorIdAuthenticationBrowserIpOsOrderIdDesc($load);
			
			if(!empty($log)) {
				
				if($log[0]['log'] == 'Login') {
					
					$insert = array(
						'administrator_id' => $administrator->id,
						'authentication' => $administrator->authentication,
						'browser' => $this->initialize['administrator']['browser'],
						'ip' => $_SERVER['REMOTE_ADDR'],
						'log' => 'Logout',
						'os' => $this->initialize['administrator']['os']
					);
					$this->administrator_log_data->insert($insert);
					
					setcookie('administrator', '', $_SERVER['REQUEST_TIME'] + (86400 * 1), $this->config->item('cookie_path'));
					
					$this->initialize['response']['result'] = true;
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>