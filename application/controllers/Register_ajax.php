<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'response' => array(
				'response' => '<p>Register process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		if($_POST['action'] == 'register') {
			
			$this->register($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function register($data) {
		
		$this->load->model('player_data');
		
		$validation = array(
			'bank' => true,
			'email' => true,
			'phone' => true
		);
		
		$player = $this->player_data->loadOrderUsernameAsc();
		
		if(!empty($player)) {
			
			foreach($player as $key => $value) {
				
				if($value['bank_id'] == $data['bank'] && $value['bank_account_name'] == $data['bankAccountName'] && $value['bank_account_number'] == $data['bankAccountNumber']) {
					
					$validation['bank'] = false;
					$this->initialize['response']['response'] = '<p>Akun bank sudah terdaftar!</p>';
					
				}
				
				if($value['email'] == $data['email']) {
					
					$validation['email'] = false;
					$this->initialize['response']['response'] = '<p>Email sudah terdaftar!</p>';
					
				}
				
				if($value['phone'] == $data['phone']) {
					
					$validation['phone'] = false;
					$this->initialize['response']['response'] = '<p>Nomor telepon sudah terdaftar!</p>';
					
				}
				
				if($value['username'] == $data['username']) {
					
					$validation['username'] = false;
					$this->initialize['response']['response'] = '<p>Nama pengguna sudah terdaftar!</p>';
					
				}
				
			}
			
		}
		
		$insert = true;
		
		foreach($validation as $key => $value) {
			
			if($value == false) {
				
				$insert = false;
				
				break;
				
			}
			
		}
		
		if($insert == true) {
			
			$insert = array(
				'bank_account_name' => $data['bankAccountName'],
				'bank_account_number' => $data['bankAccountNumber'],
				'bank_id' => $data['bank'],
				'email' => $data['email'],
				'password' => $data['password'],
				'phone' => $data['phone'],
				'status' => 'Active',
				'username' => $data['username']
			);
			$this->player_data->insert($insert);
			
			$insert = array(
				'status' => 'Pending',
				'type' => 'Registration'
			);
			$this->notification_data->insert($insert);
			
			$this->initialize['response'] = array(
				'response' => '<p>Register berhasil silahkan login!</p>',
				'result' => true
			);
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>