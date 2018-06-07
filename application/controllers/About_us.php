<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class About_us extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
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
		
		if(!empty($_COOKIE['account'])) {
			
			$account = json_decode($_COOKIE['account']);
			
			$load = array(
				'player_id' => $account->id,
				'authentication' => $account->authentication
			);
			$log = $this->player_log_data->loadBindAuthenticationPlayerId($load);
			
			if(!empty($log)) {
				
				$load = array(
					'id' => $account->id
				);
				$this->initialize['account']['detail'] = $this->player_data->loadBindId($load);
				
				if(!empty($this->initialize['account']['detail'])) {
					
					$this->initialize['account']['detail'][0]['credit'] = 0;
					
					$load = array(
						'player_id' => $this->initialize['account']['detail'][0]['id']
					);
					$playerIndex = $this->player_index_data->loadBindPlayerIdOrderGameNameAsc($load);
					
					if(!empty($playerIndex)) {
						
						foreach($playerIndex as $key => $value) {
							
							$this->initialize['account']['detail'][0]['credit'] += $value['credit'];
							
						}
						
					}
					
				}
				
			}
			
		}
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->checkAccount();
		
		$this->topView();
		
		$this->load();
		
		$this->bottomView();
		
	}
	
	
	/* Index children method */
	private function load() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account']
			)
		);
		$this->load->view('about_us', $data);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'css' => array(
					'about_us'
				),
				'javascript' => array(
					'about_us'
				),
				'name' => 'Tentang Kami'
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>