<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Player_transaction_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM player_transaction WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO player_transaction SET';
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
	
	
	public function load() {
		
		$this->load->database();
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player.id = player_transaction.player_id';
		$query = $this->db->query($sql);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player_transaction.id = ? AND player.id = player_transaction.player_id';
		$bind = array(
			$data['id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindPlayerId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player.id = player_transaction.player_id AND player.id = ?';
		$bind = array(
			$data['player_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindPlayerIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player.id = player_transaction.player_id AND player.id = ?';
		$bind = array(
			$data['player_id']
		);
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' AND '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$sql .= ' ORDER BY player_transaction.id DESC LIMIT '.$data['offset'].', '.$data['limit'];
		
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadIdBindPlayerIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT player_transaction.id AS id FROM player, player_transaction WHERE player.id = player_transaction.player_id AND player.id = ?';
		$bind = array(
			$data['player_id']
		);
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' AND '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindTimestamp($data) {
		
		$this->load->database();
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player.id = player_transaction.player_id AND player_transaction.timestamp BETWEEN ? AND ?';
		$bind = array(
			$data['timestamp'][0],
			$data['timestamp'][1]
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT player_transaction.id AS id FROM player, player_transaction WHERE player.id = player_transaction.player_id';
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' AND '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$query = (!empty($bind) ? $this->db->query($sql, $bind) : $query = $this->db->query($sql));
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT player.id AS player_id, player.bank_account_name AS player_bank_account_name, player.bank_account_number AS player_bank_account_number, player.bank_id AS player_bank_id, player.first_name AS player_first_name, player.gender AS player_gender, player.last_name AS player_last_name, player.middle_name AS player_middle_name, player.picture AS player_picture, player.recover_password AS player_recover_password, player.status AS player_status, player.timestamp AS player_timestamp, player.username AS player_username, player_transaction.id AS id, player_transaction.administrator_id AS administrator_id, player_transaction.date AS date, player_transaction.point AS point, player_transaction.rake AS rake, player_transaction.stake AS stake, player_transaction.timestamp AS timestamp, player_transaction.winlose AS winlose FROM player, player_transaction WHERE player.id = player_transaction.player_id';
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' AND '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$sql .= ' ORDER BY player_transaction.id DESC LIMIT '.$data['offset'].', '.$data['limit'];
		$query = (!empty($bind) ? $this->db->query($sql, $bind) : $query = $this->db->query($sql));
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function update($data) {
		
		$this->load->database();
		
		$sql = 'UPDATE player_transaction SET';
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