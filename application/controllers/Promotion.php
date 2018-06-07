<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Promotion extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'player' => array(
				'account' => '',
				'browser' => $this->device->getBrowser(),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'os' => $this->device->getOs()
			),
			'promotion' => array(
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
		
		if(!empty($_COOKIE['player'])) {
			
			$account = json_decode($_COOKIE['player']);
			
			$load = array(
				'player_id' => $account->id,
				'authentication' => $account->authentication
			);
			$log = $this->player_log_data->loadBindAuthenticationPlayerId($load);
			
			if(!empty($log)) {
				
				$load = array(
					'id' => $account->id
				);
				$this->initialize['player']['account'] = $this->player_data->loadBindId($load);
				
				if(!empty($this->initialize['player']['account'])) {
					
					$this->initialize['player']['account'][0]['credit'] = 0;
					
					$load = array(
						'player_id' => $this->initialize['player']['account'][0]['id']
					);
					$playerIndex = $this->player_index_data->loadBindPlayerIdOrderGameNameAsc($load);
					
					if(!empty($playerIndex)) {
						
						foreach($playerIndex as $key => $value) {
							
							$this->initialize['player']['account'][0]['credit'] += $value['credit'];
							
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
		
		$this->loadPromotion();
		
		$data = array(
			'data' => array(
				'player' => $this->initialize['player'],
				'promotion' => $this->initialize['promotion']
			)
		);
		$this->load->view('promotion', $data);
		
	}
	
	
	/* Load children method */
	private function loadPromotion() {
		
		$this->load->model('promotion_data');
		
		$load = array(
			'status' => 'Active'
		);
		$this->initialize['promotion']['data'] = $this->promotion_data->loadBindStatusOrderSequenceAsc($load);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['player'],
				'css' => array(
					'promotion'
				),
				'javascript' => array(
					'promotion'
				),
				'name' => 'Promo'
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>