<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Promotion_index_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM promotion_index WHERE promotion_id = ?';
		$bind = array(
			$data['promotion_id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO promotion_index SET';
		$bind = array();
		
		foreach($data as $key => $value) {
			
			$sql .= ', '.$key.' = ?';
			$bind[] = $value;
			
		}
		
		$sql = preg_replace('#,#', '', $sql, 1);
		$this->db->query($sql, $bind);
		
		$this->initialize['insert_id'] = $this->db->insert_id();
		
		$this->db->close();
		
	}
	
	
	public function loadBindGameIdOrderPromotionNameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.credit AS game_credit, game.name AS game_name, game.picture AS game_picture, game.status AS game_status, game.timestamp AS game_timestamp, promotion.id AS promotion_id, promotion.cap AS promotion_cap, promotion.minimum_deposit AS promotion_minimum_deposit, promotion.name AS promotion_name, promotion.picture AS promotion_picture, promotion.percentage AS promotion_percentage, promotion.rollover AS promotion_rollover, promotion.status AS promotion_status, promotion.timestamp AS promotion_timestamp, promotion.type AS promotion_type, promotion_index.id AS id FROM game, promotion, promotion_index WHERE promotion.id = promotion_index.promotion_id AND promotion_index.game_id = game.id AND game.id = ? ORDER BY promotion.name ASC';
		$bind = array(
			$data['game_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindPromotionIdOrderPromotionNameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.credit AS game_credit, game.name AS game_name, game.picture AS game_picture, game.status AS game_status, game.timestamp AS game_timestamp, promotion.id AS promotion_id, promotion.cap AS promotion_cap, promotion.minimum_deposit AS promotion_minimum_deposit, promotion.name AS promotion_name, promotion.picture AS promotion_picture, promotion.percentage AS promotion_percentage, promotion.rollover AS promotion_rollover, promotion.status AS promotion_status, promotion.timestamp AS promotion_timestamp, promotion.type AS promotion_type, promotion_index.id AS id FROM game, promotion, promotion_index WHERE promotion.id = promotion_index.promotion_id AND promotion.id = ? AND promotion_index.game_id = game.id ORDER BY promotion.name ASC';
		$bind = array(
			$data['promotion_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function resetIndex() {
		
		$this->load->database();
		
		$sql = 'ALTER TABLE promotion_index DROP id';
		$query = $this->db->query($sql);
		
		$sql = 'ALTER TABLE promotion_index ADD id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST';
		$query = $this->db->query($sql);
		
		$this->db->close();
		
	}
	
	
}
?>