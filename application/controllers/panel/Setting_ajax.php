<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Setting failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'updateSetting') {
			
			$this->updateSetting($_POST);
			
		}
		
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
	private function updateSetting($data) {
		
		$this->load->model('setting_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[2] > 0) {
					
					$setting = $this->setting_data->load();
					
					if(!empty($setting)) {
						
						foreach($setting as $key => $value) {
							
							if($value['name'] == 'Running Text') {
								
								$update = array(
									'id' => $value['id'],
									'value' => $data['runningText']
								);
								$this->setting_data->update($update);
								
							}
							
							$this->initialize['response'] = array(
								'response' => '<p>Setting successfully edited!</p>',
								'result' => true
							);
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>