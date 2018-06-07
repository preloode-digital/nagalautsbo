<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Withdrawal_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'response' => array(
				'response' => '',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAccount();
		
		if($_POST['action'] == 'insertWithdrawal') {
			
			$this->insertWithdrawal($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertWithdrawal($data) {
		
		$this->load->model('notification_data');
		$this->load->model('transaction_request_data');
		
		$data['amount'] =  preg_replace('#[^0-9]#', '', $data['amount']);
		
		if(!empty($this->initialize['account']['detail'])) {
			
			$validation = array(
				'amount' => false
			);
			
			if($data['amount'] < 100000) {
				
				$this->initialize['response']['response'] = 'Silahkan withdraw minimal Rp. 100,000!';
				
			}
			
			else {
				
				$validation['amount'] = true;
				
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
					'amount' => $data['amount'],
					'game_id' => 1,
					'player_id' => $this->initialize['account']['detail'][0]['id'],
					'status' => 'Pending',
					'type' => 'Withdrawal'
				);
				$this->transaction_request_data->insert($insert);
				
				$insert = array(
					'status' => 'Pending',
					'transaction_request_id' => $this->transaction_request_data->initialize['insert_id'],
					'type' => 'Withdrawal'
				);
				$this->notification_data->insert($insert);
				
				$this->initialize['response'] = array(
					'response' => '<p>Permintaan withdrawal berhasil!</p>',
					'result' => true
				);
				
			}
			
		}
		
		else {
			
			$this->initialize['response']['response'] = '<p>Silahkan login terlebih dahulu!</p>';
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function loadAccount() {
		
		$this->load->model('player_data');
		
		if(!empty($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'id' => $account->id
			);
			$this->initialize['account']['detail'] = $this->player_data->loadBindId($load);
			
		}
		
	}
	
	
}
?>