<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_ranking extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'account' => array(
				'detail' => ''
			),
			'player' => array(
				'ranking' => array(
					'data' => array()
				),
				'transaction' => array(
					'data' => ''
				)
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
		
		$this->loadPlayer();
		
		$this->loadPlayerTransaction();
		
		$this->rankPlayer();
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account'],
				'player' => $this->initialize['player']
			)
		);
		$this->load->view('player_ranking', $data);
		
	}
	
	
	/* Load children method */
	private function loadPlayer() {
		
		$this->load->model('player_data');
		
		$this->initialize['player']['data'] = $this->player_data->loadOrderUsernameAsc();
		
	}
	
	
	/* Load children method */
	private function loadPlayerTransaction() {
		
		$this->load->model('player_transaction_data');
		
		$this->initialize['player']['transaction']['data'] = $this->player_transaction_data->load();
		
	}
	
	
	/* Load children method */
	private function rankPlayer() {
		
		if(!empty($this->initialize['player']['data'])) {
			
			$ranking = array();
			
			foreach($this->initialize['player']['data'] as $key => $value) {
				
				$ranking[$key] = 0;
				
				if(!empty($this->initialize['player']['transaction']['data'])) {
					
					for($i = 0; $i < count($this->initialize['player']['transaction']['data']); $i++) {
						
						if($this->initialize['player']['transaction']['data'][$i]['player_id'] == $value['id']) {
							
							$ranking[$key] += $this->initialize['player']['transaction']['data'][$i]['point'];
							
						}
						
					}
					
				}
				
			}
			
			arsort($ranking);
			
			if(!empty($ranking)) {
				
				$index = 0;
				
				foreach($ranking as $key => $value) {
					
					$this->initialize['player']['ranking']['data'][$index] = $this->initialize['player']['data'][$key];
					$this->initialize['player']['ranking']['data'][$index]['point'] = $value;
					
					$index++;
					
				}
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'account' => $this->initialize['account']['detail'],
				'css' => array(
					'player_ranking'
				),
				'description' => 'Indo Poker League, komunitas online poker pppoker terbesar di indonesia!',
				'javascript' => array(
					'player_ranking'
				),
				'keywords' => 'indo,poker,league,indo poker,indo poker league,indopokerleague,komunitas,online,poker,komunitas online,pppoker,komunitas online,komunitas online poker,komunitas online poker pppoker',
				'name' => 'IPL Point'
			)
		);
		$this->load->view('head', $data);
		$this->load->view('header', $data);
		
	}
	
	
}
?>