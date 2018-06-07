<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_ranking_ajax extends CI_Controller {
	
	
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
		
		if($_POST['action'] == 'loadTopPlayer') {
			
			$this->loadTopPlayer($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadTopPlayer($data) {
		
		$this->load->model('player_data');
		$this->load->model('player_transaction_data');
		
		if(empty($data['startDate'])) {
			
			$data['startDate'] = '0000-00-00';
			
		}
		
		
		if(empty($data['endDate'])) {
			
			$data['endDate'] = '9999-12-31';
			
		}
		
		$data['startDate'] .= ' 00:00:00';
		$data['endDate'] .= ' 23:59:59';
		
		$player = $this->player_data->loadOrderUsernameAsc();
		
		$load = array(
			'timestamp' => array(
				$data['startDate'],
				$data['endDate']
			)
		);
		$playerTransaction = $this->player_transaction_data->loadBindTimestamp($load);
		
		if(!empty($player)) {
			
			$ranking = array();
			
			foreach($player as $key => $value) {
				
				$ranking[$key] = 0;
				
				if(!empty($playerTransaction)) {
					
					for($i = 0; $i < count($playerTransaction); $i++) {
						
						if($playerTransaction[$i]['player_id'] == $value['id']) {
							
							$ranking[$key] += $playerTransaction[$i]['point'];
							
						}
						
					}
					
				}
				
			}
			
			arsort($ranking);
			
			if(!empty($ranking)) {
				
				$this->initialize['response']['response'] = '<tr>
                	<th><p>No</p></th>
                    <th><p>Nama Pengguna</p></th>
                    <th><p>Jumlah Point</p></th>
                </tr>';
				$number = 1;
				
				foreach($ranking as $key => $value) {
					
					if($data['type'] == 'Top 10' && $number <= 10 || $data['type'] == 'Top 50' && $number <= 50 || $data['type'] == 'Top 100' && $number <= 100) {
						
						if(!empty($value)) {
							
							$value = number_format($value);
							
						}
						
						$this->initialize['response']['response'] .= '<tr>
							<td><p>'.$number.'</p></td>
							<td><p>'.$player[$key]['username'].'</p></td>
							<td><p>'.$value.'</p></td>
						</tr>';
						
					}
					
					$number++;
					
				}
				
				$this->initialize['response']['result'] = true;
				
			}
			
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