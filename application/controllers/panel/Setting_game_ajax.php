<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_game_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Game failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'updateGame') {
			
			$this->updateGame($_POST);
			
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
	private function updateGame($data) {
		
		$this->load->model('page_data');
		$this->load->model('page_index_data');
		$this->load->model('url_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_setting'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_setting']);
				
				if($privilege[2] > 0) {
					
					$load = array(
						'name' => 'Game'
					);
					$page = $this->page_data->loadBindName($load);
					
					if(!empty($page)) {
						
						$update = array(
							'id' => $page[0]['id'],
							'content' => $data['content']
						);
						$this->page_data->update($update);
						
						$load = array(
							'status' => 'Active'
						);
						$url = $this->url_data->loadBindStatusOrderNameAsc($load);
						
						if(!empty($url)) {
							
							$delete = array(
								'page_id' => $page[0]['id']
							);
							$this->page_index_data->delete($delete);
							
							for($i = 0; $i < count($url); $i++) {
								
								$insert = array(
									'description' => $data['description'][$i],
									'meta_description' => $data['metaDescription'][$i],
									'meta_keyword' => $data['metaKeyword'][$i],
									'meta_title' => $data['metaTitle'][$i],
									'og_description' => $data['ogDescription'][$i],
									'og_title' => $data['ogTitle'][$i],
									'page_id' => $page[0]['id'],
									'title' => $data['title'][$i],
									'url_id' => $url[$i]['id']
								);
								$this->page_index_data->insert($insert);
								
							}
							
							$this->page_index_data->resetIndex();
							
							$this->initialize['response'] = array(
								'response' => '<p>Game successfully edited!</p>',
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