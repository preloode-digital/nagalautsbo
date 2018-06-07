<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Promotion_entry_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Promotion failed processed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'insertPromotion') {
			
			$this->insertPromotion($_POST);
			
		}
		
		else if($_POST['action'] == 'updatePromotion') {
			
			$this->updatePromotion($_POST);
			
		}
		
		else if($_POST['action'] == 'uploadPicture') {
			
			$this->uploadPicture($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function insertPromotion($data) {
		
		$this->load->model('promotion_data');
		$this->load->model('promotion_index_data');
		
		$data['cap'] = preg_replace('#[^0-9]#', '', $data['cap']);
		
		if(empty($data['cap'])) {
			
			$data['cap'] = 0;
			
		}
		
		$data['minimumDeposit'] = preg_replace('#[^0-9]#', '', $data['minimumDeposit']);
		
		if(empty($data['minimumDeposit'])) {
			
			$data['minimumDeposit'] = 0;
			
		}
		
		$data['sequence'] = preg_replace('#[^0-9]#', '', $data['sequence']);
		
		if(empty($data['sequence'])) {
			
			$data['sequence'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_promotion'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_promotion']);
				
				if($privilege[1] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$promotion = $this->promotion_data->loadBindName($load);
					
					if(empty($promotion)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						$this->initialize['response']['response'] = '<p>Promotion name already exist!</p>';
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$insert = array(
							'cap' => $data['cap'],
							'description' => $data['description'],
							'name' => $data['name'],
							'percentage' => $data['percentage'],
							'picture' => $data['picture'],
							'minimum_deposit' => $data['minimumDeposit'],
							'rollover' => $data['rollover'],
							'sequence' => $data['sequence'],
							'status' => $data['status'],
							'type' => $data['type']
						);
						$this->promotion_data->insert($insert);
						
						if(!empty($data['game'])) {
							
							foreach($data['game'] as $key => $value) {
								
								$insert = array(
									'promotion_id' => $this->promotion_data->initialize['insert_id'],
									'game_id' => $value
								);
								$this->promotion_index_data->insert($insert);
								
							}
							
						}
						
						$this->initialize['response'] = array(
							'response' => '<p>Promotion successfully added!</p>',
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
	
	
	/* Upload picture children method */
	private function resizePicture($data) {
		
		$this->load->model('promotion_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$source['path'] = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$data['path'];
			list($source['width'], $source['height']) = getimagesize($source['path']);
			
			if($source['width'] > 1200) {
				
				$destination = array(
					'height' => (1200 / $source['width']) * $source['height'],
					'width' => 1200
				);
				
				$resize = array(
					'destinationHeight' => $destination['height'],
					'destinationPath' => '/'.$data['path'],
					'destinationX' => 0,
					'destinationWidth' => $destination['width'],
					'destinationY' => 0,
					'sourceHeight' => $source['height'],
					'sourcePath' => '/'.$data['path'],
					'sourceX' => 0,
					'sourceWidth' => $source['width'],
					'sourceY' => 0
				);
				$this->promotion_data->resizePicture($resize);
				
			}
			
		}
		
	}
	
	
	/* Index children method */
	private function updatePromotion($data) {
		
		$this->load->model('promotion_data');
		$this->load->model('promotion_index_data');
		
		$data['cap'] = preg_replace('#[^0-9]#', '', $data['cap']);
		
		if(empty($data['cap'])) {
			
			$data['cap'] = 0;
			
		}
		
		$data['minimumDeposit'] = preg_replace('#[^0-9]#', '', $data['minimumDeposit']);
		
		if(empty($data['minimumDeposit'])) {
			
			$data['minimumDeposit'] = 0;
			
		}
		
		$data['sequence'] = preg_replace('#[^0-9]#', '', $data['sequence']);
		
		if(empty($data['sequence'])) {
			
			$data['sequence'] = 0;
			
		}
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_promotion'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_promotion']);
				
				if($privilege[2] > 0) {
					
					$validation = array(
						'name' => false
					);
					
					$load = array(
						'name' => $data['name']
					);
					$promotion = $this->promotion_data->loadBindName($load);
					
					if(empty($promotion)) {
						
						$validation['name'] = true;
						
					}
					
					else {
						
						if($promotion[0]['id'] != $data['id']) {
							
							$validation['name'] = true;
							
						}
						
						else {
							
							if($promotion[0]['name'] == $data['name']) {
								
								$validation['name'] = true;
								
							}
							
							else {
								
								$this->initialize['response']['response'] = '<p>Promotion name already exist!</p>';
								
							}
							
						}
						
					}
					
					foreach($validation as $key => $value) {
						
						if($value == false) {
							
							$valid = false;
							
							break;
							
						}
						
						else {
							
							$valid = true;
							
						}
						
					}
					
					if($valid == true) {
						
						$load = array(
							'id' => $data['id']
						);
						$promotion = $this->promotion_data->loadBindId($load);
						
						if(!empty($promotion)) {
							
							$update = array(
								'cap' => $data['cap'],
								'description' => $data['description'],
								'id' => $promotion[0]['id'],
								'name' => $data['name'],
								'percentage' => $data['percentage'],
								'picture' => $data['picture'],
								'minimum_deposit' => $data['minimumDeposit'],
								'rollover' => $data['rollover'],
								'sequence' => $data['sequence'],
								'status' => $data['status'],
								'type' => $data['type']
							);
							$this->promotion_data->update($update);
							
							$delete = array(
								'promotion_id' => $data['id'],
							);
							$this->promotion_index_data->delete($delete);
							
							if(!empty($data['game'])) {
								
								foreach($data['game'] as $key => $value) {
									
									$insert = array(
										'promotion_id' => $data['id'],
										'game_id' => $value
									);
									$this->promotion_index_data->insert($insert);
									
								}
								
							}
							
							$this->promotion_index_data->resetIndex();
							
							$this->initialize['response'] = array(
								'response' => '<p>Promotion successfully edited!</p>',
								'result' => true
							);
							
						}
						
					}
					
				}
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
	/* Index children method */
	private function uploadPicture($data) {
		
		$this->load->model('promotion_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			$upload = $this->promotion_data->uploadPicture($data);
			
			if(!empty($upload['file_name'])) {
				
				$this->initialize['response'] = array(
					'picture' => 'asset/image/promotion/'.$upload['file_name'],
					'response' => '<p>Picture upload succeeded!</p>',
					'result' => true
				);
				
				$resize = array(
					'path' => 'asset/image/promotion/'.$upload['file_name']
				);
				$this->resizePicture($resize);
				
			}
			
			else {
				
				$this->initialize['response'] = array(
					'response' => $upload,
					'result' => false
				);
				
			}
			
		}
		
		echo json_encode($this->initialize['response']);
		
	}
	
	
}
?>