<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_url_ajax extends CI_Controller {
	
	
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
				'response' => '<p>URL process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteUrl') {
			
			$this->deleteUrl($_POST);
			
		}
		
		else if($_POST['action'] == 'loadUrlDetail') {
			
			$this->loadUrlDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteUrl($data) {
		
		$this->load->model('url_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$url = $this->url_data->loadBindId($load);
					
					if(!empty($url)) {
						
						$delete = array(
							'id' => $url[0]['id']
						);
						$this->url_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>URL successfully deleted!</p>',
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
	private function loadUrlDetail($data) {
		
		$this->load->model('url_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$url = $this->url_data->loadBindId($load);
					
					if(!empty($url)) {
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$url[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$url[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">URL</p>
							<p class="colon">:</p>
							<p class="detail">'.$url[0]['url'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$url[0]['status'].'</p>
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