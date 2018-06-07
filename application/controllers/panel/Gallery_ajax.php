<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Gallery_ajax extends CI_Controller {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
		$this->time->setDefault();
		
		$this->initialize = array(
			'administrator' => array(
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
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deleteGallery') {
			
			$this->deleteGallery($_POST);
			
		}
		
		else if($_POST['action'] == 'loadGalleryDetail') {
			
			$this->loadGalleryDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deleteGallery($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['detail'])) {
			
			if(!empty($this->initialize['administrator']['detail'][0]['privilege_gallery'])) {
				
				$privilege = str_split($this->initialize['administrator']['detail'][0]['privilege_gallery']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$gallery = $this->gallery_data->loadBindId($load);
					
					if(!empty($gallery)) {
						
						$delete = array(
							'id' => $gallery[0]['id']
						);
						$this->gallery_data->delete($delete);
						
						$this->initialize['response'] = array(
							'response' => '<p>Gallery successfully deleted!</p>',
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
			$this->initialize['administrator']['detail'] = $this->administrator_data->loadBindId($load);
			
		}
		
	}
	
	
	/* Index children method */
	private function loadGalleryDetail($data) {
		
		$this->load->model('gallery_data');
		
		if(!empty($this->initialize['administrator']['detail'])) {
			
			if(!empty($this->initialize['administrator']['detail'][0]['privilege_gallery'])) {
				
				$privilege = str_split($this->initialize['administrator']['detail'][0]['privilege_gallery']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$gallery = $this->gallery_data->loadBindId($load);
					
					if(!empty($gallery)) {
						
						$gallery[0]['timestamp'] = new DateTime($gallery[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">URL</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['url'].'</p>
							<div class="clearfix"></div>
							<p class="title">Sequence</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['sequence'].'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$gallery[0]['timestamp']->format('j-m-Y H:i:s').'</p>
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