<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_log_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO administrator_log SET';
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
	
	
	public function loadBindAdministratorIdAuthenticationBrowserIpOsOrderIdDesc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_log WHERE administrator_id = ? AND authentication = ? AND browser = ? AND ip = ? AND os = ? ORDER BY id DESC';
		$bind = array(
			$data['administrator_id'],
			$data['authentication'],
			$data['browser'],
			$data['ip'],
			$data['os']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindAdministratorIdBrowserIpOsOrderIdDesc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_log WHERE administrator_id = ? AND browser = ? AND ip = ? AND os = ? ORDER BY id DESC';
		$bind = array(
			$data['administrator_id'],
			$data['browser'],
			$data['ip'],
			$data['os']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
}
?>