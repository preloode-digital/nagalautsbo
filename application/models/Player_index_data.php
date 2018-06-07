<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_index_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM player_index WHERE player_id = ?';
		$bind = array(
			$data['player_id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	public function loadBindGameIdStatusOrderUsernameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND game.id = ? AND player.id = player_index.player_id AND player_index.status = ? ORDER BY game.name ASC';
		$bind = array(
			$data['game_id'],
			$data['status']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindGameIdPlayerId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND game.id = ? AND player.id = player_index.player_id AND player.id = ?';
		$bind = array(
			$data['game_id'],
			$data['player_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindGameIdStatusUsername($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND game.id = ? AND player.id = player_index.player_id AND player_index.status = ? AND player_index.username = ? ORDER BY game.name ASC';
		$bind = array(
			$data['game_id'],
			$data['status'],
			$data['username']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindPlayerIdOrderGameNameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND player.id = player_index.player_id AND player.id = ? ORDER BY game.name ASC';
		$bind = array(
			$data['player_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindStatusOrderUsernameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND player.id = player_index.player_id AND player_index.status = ? ORDER BY game.name ASC';
		$bind = array(
			$data['status']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindUsername($data) {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND player.id = player_index.player_id AND player_index.username = ? ORDER BY game.name ASC';
		$bind = array(
			$data['username']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadOrderPlayerUsernameAsc() {
		
		$this->load->database();
		
		$sql = 'SELECT game.id AS game_id, game.name AS game_name, game.status AS game_status, game.timestamp AS game_timestamp, player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.phone AS player_phone, player.password AS player_password, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_index.id AS id, player_index.credit AS credit, player_index.status AS status, player_index.timestamp AS timestamp, player_index.username AS username FROM game, player, player_index WHERE game.id = player_index.game_id AND player.id = player_index.player_id ORDER BY player.username ASC';
		$query = $this->db->query($sql);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO player_index SET';
		$bind = array();
		
		foreach($data as $key => $value) {
			
			$sql .= ', '.$key.' = ?';
			$bind[] = $value;
			
		}
		
		$sql = preg_replace('#,#', '', $sql, 1);
		$this->db->query($sql, $bind);
		
		$this->initialize['insertId'] = $this->db->insert_id();
		
		$this->db->close();
		
	}
	
	
	public function resetIndex() {
		
		$this->load->database();
		
		$sql = 'ALTER TABLE player_index DROP id';
		$query = $this->db->query($sql);
		
		$sql = 'ALTER TABLE player_index ADD id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST';
		$query = $this->db->query($sql);
		
		$this->db->close();
		
	}
	
	
	public function update($data) {
		
		$this->load->database();
		
		$sql = 'UPDATE player_index SET';
		$bind = array();
		
		foreach($data as $key => $value) {
			
			if($key != 'id') {
				
				$sql .= ', '.$key.' = ?';
				$bind[] = $value;
				
			}
			
		}
		
		$sql .= ' WHERE id = ?';
		$sql = preg_replace('#,#', '', $sql, 1);
		$bind[] = $data['id'];
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
}
?>