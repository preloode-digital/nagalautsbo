<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_log_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO player_log SET';
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
	
	
	public function loadBindPlayerId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM player_log WHERE player_id = ?';
		$bind = array(
			$data['player_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindAuthenticationPlayerId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM player_log WHERE authentication = ? AND player_id = ?';
		$bind = array(
			$data['authentication'],
			$data['player_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
}
?>