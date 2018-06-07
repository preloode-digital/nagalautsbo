<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Promotion_ajax extends CI_Controller {
	
	
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
				'response' => '<p>Promotion process failed!</p>',
				'result' => false
			)
		);
		
	}
	
	
	/* Default method */
	public function index() {
		
		$this->loadAdministrator();
		
		if($_POST['action'] == 'deletePromotion') {
			
			$this->deletePromotion($_POST);
			
		}
		
		else if($_POST['action'] == 'loadPromotionDetail') {
			
			$this->loadPromotionDetail($_POST);
			
		}
		
	}
	
	
	/* Index children method */
	private function deletePromotion($data) {
		
		$this->load->model('promotion_data');
		$this->load->model('promotion_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_promotion'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_promotion']);
				
				if($privilege[3] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$promotion = $this->promotion_data->loadBindId($load);
					
					if(!empty($promotion)) {
						
						$delete = array(
							'id' => $promotion[0]['id']
						);
						$this->promotion_data->delete($delete);
						
						$delete = array(
							'promotion_id' => $promotion[0]['id']
						);
						$this->promotion_index_data->delete($delete);
						
						$this->promotion_index_data->resetIndex();
						
						$this->initialize['response'] = array(
							'response' => '<p>Promotion successfully deleted!</p>',
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
	private function loadPromotionDetail($data) {
		
		$this->load->model('promotion_data');
		$this->load->model('promotion_index_data');
		
		if(!empty($this->initialize['administrator']['account'])) {
			
			if(!empty($this->initialize['administrator']['account'][0]['privilege_promotion'])) {
				
				$privilege = str_split($this->initialize['administrator']['account'][0]['privilege_promotion']);
				
				if($privilege[0] > 0) {
					
					$load = array(
						'id' => $data['id']
					);
					$promotion = $this->promotion_data->loadBindId($load);
					
					if(!empty($promotion)) {
						
						$load = array(
							'promotion_id' => $promotion[0]['id']
						);
						$promotionIndex = $this->promotion_index_data->loadBindPromotionIdOrderPromotionNameAsc($load);
						
						$game = '';
						
						if(!empty($promotionIndex)) {
							
							foreach($promotionIndex as $key => $value) {
								
								$game .= ', '.$value['game_name'];
								
							}
							
							$game = preg_replace('#, #', '', $game, 1);
							
						}
						
						if(!empty($promotion[0]['cap'])) {
							
							$promotion[0]['cap'] = number_format($promotion[0]['cap']);
							
						}
						
						if(!empty($promotion[0]['minimum_deposit'])) {
							
							$promotion[0]['minimum_deposit'] = number_format($promotion[0]['minimum_deposit']);
							
						}
						
						$promotion[0]['timestamp'] = new DateTime($promotion[0]['timestamp']);
						
						$this->initialize['response'] = array(
							'response' => '<p class="title">ID</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['id'].'</p>
							<div class="clearfix"></div>
							<p class="title">Name</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['name'].'</p>
							<div class="clearfix"></div>
							<p class="title">Percentage</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['percentage'].'</p>
							<div class="clearfix"></div>
							<p class="title">Minimum Deposit</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['minimum_deposit'].'</p>
							<div class="clearfix"></div>
							<p class="title">Maximum Bonus</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['cap'].'</p>
							<div class="clearfix"></div>
							<p class="title">Rollover</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['rollover'].'</p>
							<div class="clearfix"></div>
							<p class="title">Type</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['type'].'</p>
							<div class="clearfix"></div>
							<p class="title">Game</p>
							<p class="colon">:</p>
							<p class="detail">'.$game.'</p>
							<div class="clearfix"></div>
							<p class="title">Status</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['status'].'</p>
							<div class="clearfix"></div>
							<p class="title">Created Date</p>
							<p class="colon">:</p>
							<p class="detail">'.$promotion[0]['timestamp']->format('j-m-Y H:i:s').'</p>
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