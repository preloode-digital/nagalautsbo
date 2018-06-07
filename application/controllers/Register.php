<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'bank' => array(
				'data' => ''
			),
			'game' => array(
				'data' => ''
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('player_data');
		$this->load->model('player_index_data');
		$this->load->model('player_log_data');
		
		if(empty($_COOKIE['account'])) {
			
			header('Location: '.base_url().'');
			
			exit();
			
		}
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$this->loadBank();
		
		$this->loadGame();
		
		$data = array(
			'data' => array(
				'bank' => $this->initialize['bank'],
				'game' => $this->initialize['game']
			)
		);
		$this->load->view('register', $data);
		
	}
	
	
	/* Load children method */
	private function loadBank() {
		
		$this->load->model('bank_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['bank']['data'] = $this->bank_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Load children method */
	private function loadGame() {
		
		$this->load->model('game_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['game']['data'] = $this->game_data->loadBindStatusOrderNameAsc($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'css' => array(
					'register'
				),
				'javascript' => array(
					'register'
				),
				'name' => 'Register'
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>