<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Restricted_access extends CI_Controller {
	
	
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
			)
		);
		
	}
	
	
	/* Index children method */
	private function bottomView() {
		
		$this->load->view('panel/footer');
		
	}
	
	
	/* Index children method */
	private function checkAccount() {
		
		$this->load->model('administrator_data');
		$this->load->model('administrator_log_data');
		
		if(!empty($_COOKIE['administrator'])) {
			
			$administrator = json_decode($_COOKIE['administrator']);
			
			$load = array(
				'administrator_id' => $administrator->id,
				'authentication' => $administrator->authentication
			);
			$log = $this->administrator_log_data->loadBindAdministratorIdAuthentication($load);
			
			if(!empty($log)) {
				
				$load = array(
					'id' => $administrator->id
				);
				$this->initialize['administrator']['detail'] = $this->administrator_data->loadBindId($load);
				
			}
			
			else {
				
				header('Location: '.$this->config->item('panel_url').'login/');
				
				exit();
				
			}
			
		}
		
		else {
			
			header('Location: '.$this->config->item('panel_url').'login/');
			
			exit();
			
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
				'administrator' => $this->initialize['administrator']
			)
		);
		$this->load->view('panel/restricted_access', $data);
		
	}
	
	
	/* Index children method */
	private function topView() {
		
		$data = array(
			'data' => array(
				'administrator' => $this->initialize['administrator']['detail'],
				'css' => array(
					'restricted_access'
				),
				'description' => 'Indo Poker League, komunitas online poker pppoker terbesar di indonesia!',
				'javascript' => array(
					'restricted_access'
				),
				'keyword' => 'indo,poker,league,indo poker,indo poker league,indopokerleague,komunitas,online,poker,komunitas online,pppoker,komunitas online,komunitas online poker,komunitas online poker pppoker',
				'name' => 'Restricted Access'
			)
		);
		$this->load->view('panel/head', $data);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/sidebar', $data);
		
	}
	
	
}
?>