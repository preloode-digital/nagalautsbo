<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_role_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Administrator role failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteAdministratorRole') {
			
			$this->deleteAdministratorRole($_POST);
			
		}
		
		else if($_POST['action'] == 'loadAdministratorRoleDetail') {
			
			$this->loadAdministratorRoleDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteAdministratorRole($data) {
		
		$this->load->model('administrator_role_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$administratorRole = $this->administrator_role_data->loadBindId($load);
					
					if(!empty($administratorRole)) {
						
						$delete = array(
							'id' => $administratorRole[0]['id']
						);
						$this->administrator_role_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Administrator role successfully deleted!</p>',
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
	private function loadAdministratorRoleDetail($data) {
		
		$this->load->model('administrator_role_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_administrator'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_administrator']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$administratorRole = $this->administrator_role_data->loadBindId($load);
					
					if(!empty($administratorRole)) {
						
						$administratorRole[0]['timestamp'] = new DateTime($administratorRole[0]['timestamp']);
						
						$privilege = array(
							'administrator' => str_split($administratorRole[0]['privilege_administrator']),
							'bank' => str_split($administratorRole[0]['privilege_bank']),
							'bankAccount' => str_split($administratorRole[0]['privilege_bank_account']),
							'game' => str_split($administratorRole[0]['privilege_game']),
							'player' => str_split($administratorRole[0]['privilege_player']),
							'promotion' => str_split($administratorRole[0]['privilege_promotion']),
							'report' => str_split($administratorRole[0]['privilege_report']),
							'setting' => str_split($administratorRole[0]['privilege_setting']),
							'transaction' => str_split($administratorRole[0]['privilege_transaction'])
						);
						
						if($privilege['administrator'][0] > 0) {
							
							$privilege['administrator']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['administrator']['view'] = '';
							
						}
						
						if($privilege['administrator'][1] > 0) {
							
							$privilege['administrator']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['administrator']['insert'] = '';
							
						}
						
						if($privilege['administrator'][2] > 0) {
							
							$privilege['administrator']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['administrator']['edit'] = '';
							
						}
						
						if($privilege['administrator'][3] > 0) {
							
							$privilege['administrator']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['administrator']['delete'] = '';
							
						}
						
						if($privilege['bank'][0] > 0) {
							
							$privilege['bank']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['bank']['view'] = '';
							
						}
						
						if($privilege['bank'][1] > 0) {
							
							$privilege['bank']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['bank']['insert'] = '';
							
						}
						
						if($privilege['bank'][2] > 0) {
							
							$privilege['bank']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['bank']['edit'] = '';
							
						}
						
						if($privilege['bank'][3] > 0) {
							
							$privilege['bank']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['bank']['delete'] = '';
							
						}
						
						if($privilege['bankAccount'][0] > 0) {
							
							$privilege['bankAccount']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['bankAccount']['view'] = '';
							
						}
						
						if($privilege['bankAccount'][1] > 0) {
							
							$privilege['bankAccount']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['bankAccount']['insert'] = '';
							
						}
						
						if($privilege['bankAccount'][2] > 0) {
							
							$privilege['bankAccount']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['bankAccount']['edit'] = '';
							
						}
						
						if($privilege['bankAccount'][3] > 0) {
							
							$privilege['bankAccount']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['bankAccount']['delete'] = '';
							
						}
						
						if($privilege['game'][0] > 0) {
							
							$privilege['game']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['game']['view'] = '';
							
						}
						
						if($privilege['game'][1] > 0) {
							
							$privilege['game']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['game']['insert'] = '';
							
						}
						
						if($privilege['game'][2] > 0) {
							
							$privilege['game']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['game']['edit'] = '';
							
						}
						
						if($privilege['game'][3] > 0) {
							
							$privilege['game']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['game']['delete'] = '';
							
						}
						
						if($privilege['player'][0] > 0) {
							
							$privilege['player']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['player']['view'] = '';
							
						}
						
						if($privilege['player'][1] > 0) {
							
							$privilege['player']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['player']['insert'] = '';
							
						}
						
						if($privilege['player'][2] > 0) {
							
							$privilege['player']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['player']['edit'] = '';
							
						}
						
						if($privilege['player'][3] > 0) {
							
							$privilege['player']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['player']['delete'] = '';
							
						}
						
						if($privilege['promotion'][0] > 0) {
							
							$privilege['promotion']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['promotion']['view'] = '';
							
						}
						
						if($privilege['promotion'][1] > 0) {
							
							$privilege['promotion']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['promotion']['insert'] = '';
							
						}
						
						if($privilege['promotion'][2] > 0) {
							
							$privilege['promotion']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['promotion']['edit'] = '';
							
						}
						
						if($privilege['promotion'][3] > 0) {
							
							$privilege['promotion']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['promotion']['delete'] = '';
							
						}
						
						if($privilege['report'][0] > 0) {
							
							$privilege['report']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['report']['view'] = '';
							
						}
						
						if($privilege['report'][1] > 0) {
							
							$privilege['report']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['report']['insert'] = '';
							
						}
						
						if($privilege['report'][2] > 0) {
							
							$privilege['report']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['report']['edit'] = '';
							
						}
						
						if($privilege['report'][3] > 0) {
							
							$privilege['report']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['report']['delete'] = '';
							
						}
						
						if($privilege['setting'][0] > 0) {
							
							$privilege['setting']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['setting']['view'] = '';
							
						}
						
						if($privilege['setting'][1] > 0) {
							
							$privilege['setting']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['setting']['insert'] = '';
							
						}
						
						if($privilege['setting'][2] > 0) {
							
							$privilege['setting']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['setting']['edit'] = '';
							
						}
						
						if($privilege['setting'][3] > 0) {
							
							$privilege['setting']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['setting']['delete'] = '';
							
						}
						
						if($privilege['transaction'][0] > 0) {
							
							$privilege['transaction']['view'] = 'checked';
							
						}
						
						else {
							
							$privilege['transaction']['view'] = '';
							
						}
						
						if($privilege['transaction'][1] > 0) {
							
							$privilege['transaction']['insert'] = 'checked';
							
						}
						
						else {
							
							$privilege['transaction']['insert'] = '';
							
						}
						
						if($privilege['transaction'][2] > 0) {
							
							$privilege['transaction']['edit'] = 'checked';
							
						}
						
						else {
							
							$privilege['transaction']['edit'] = '';
							
						}
						
						if($privilege['transaction'][3] > 0) {
							
							$privilege['transaction']['delete'] = 'checked';
							
						}
						
						else {
							
							$privilege['transaction']['delete'] = '';
							
						}
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorRole[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Username</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorRole[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorRole[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$administratorRole[0]['timestamp']->format('j-m-Y H:i:s').'</p>
							<div class="clearfix"></div>
							<h3>Privilege</h3>
							<p class="title">Administrator</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-administrator" type="checkbox" '.$privilege['administrator']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-administrator" type="checkbox" '.$privilege['administrator']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-administrator" type="checkbox" '.$privilege['administrator']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-administrator" type="checkbox" '.$privilege['administrator']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Bank</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-bank" type="checkbox" '.$privilege['bank']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-bank" type="checkbox" '.$privilege['bank']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-bank" type="checkbox" '.$privilege['bank']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-bank" type="checkbox" '.$privilege['bank']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Bank Account</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-bank-account" type="checkbox" '.$privilege['bankAccount']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-bank-account" type="checkbox" '.$privilege['bankAccount']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-bank-account" type="checkbox" '.$privilege['bankAccount']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-bank-account" type="checkbox" '.$privilege['bankAccount']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Game</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-game" type="checkbox" '.$privilege['game']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-game" type="checkbox" '.$privilege['game']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-game" type="checkbox" '.$privilege['game']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-game" type="checkbox" '.$privilege['game']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Player</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-player" type="checkbox" '.$privilege['player']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-player" type="checkbox" '.$privilege['player']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-player" type="checkbox" '.$privilege['player']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-player" type="checkbox" '.$privilege['player']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Promotion</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-promotion" type="checkbox" '.$privilege['promotion']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-promotion" type="checkbox" '.$privilege['promotion']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-promotion" type="checkbox" '.$privilege['promotion']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-promotion" type="checkbox" '.$privilege['promotion']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Report</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-report" type="checkbox" '.$privilege['report']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-report" type="checkbox" '.$privilege['report']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-report" type="checkbox" '.$privilege['report']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-report" type="checkbox" '.$privilege['report']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Setting</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-setting" type="checkbox" '.$privilege['setting']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-setting" type="checkbox" '.$privilege['setting']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-setting" type="checkbox" '.$privilege['setting']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-setting" type="checkbox" '.$privilege['setting']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
							<div class="clearfix"></div>
							<p class="title">Transaction</p>
							<p class="colon">:</p>
							<div class="checkbox">
								<div class="item">
									<input name="privilege-transaction" type="checkbox" '.$privilege['transaction']['view'].'>
									<p class="checkbox">View</p>
								</div>
								<div class="item">
									<input name="privilege-transaction" type="checkbox" '.$privilege['transaction']['insert'].'>
									<p class="checkbox">Add</p>
								</div>
								<div class="item">
									<input name="privilege-transaction" type="checkbox" '.$privilege['transaction']['edit'].'>
									<p class="checkbox">Edit</p>
								</div>
								<div class="item">
									<input name="privilege-transaction" type="checkbox" '.$privilege['transaction']['delete'].'>
									<p class="checkbox">Delete</p>
								</div>
							</div>
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