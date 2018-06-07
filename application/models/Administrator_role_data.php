<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_role_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM administrator_role WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO administrator_role SET';
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
	
	
	public function loadBindId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_role WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindName($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_role WHERE name = ?';
		$bind = array(
			$data['name']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT id FROM administrator_role';
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' WHERE '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$query = (!empty($bind) ? $this->db->query($sql, $bind) : $query = $this->db->query($sql));
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindStatusOrderNameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_role WHERE status = ? ORDER BY name ASC';
		$bind = array(
			$data['status']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadOrderNameAsc() {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator_role ORDER BY name ASC';
		$query = $this->db->query($sql);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT * FROM administrator_role';
		
		$filter = array(
			'account' => $data['account'],
			'column' => $data['column'],
			'name' => $data['name']
		);
		$filter = $this->filter->load($filter);
		
		if(!empty($filter['sql'])) {
			
			$sql .= ' WHERE '.$filter['sql'];
			
			foreach($filter['bind'] as $value) {
				
				$bind[] = $value;
				
			}
			
		}
		
		$sql .= ' ORDER BY id DESC LIMIT '.$data['offset'].', '.$data['limit'];
		$query = (!empty($bind) ? $this->db->query($sql, $bind) : $query = $this->db->query($sql));
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function update($data) {
		
		$this->load->database();
		
		$sql = 'UPDATE administrator_role SET';
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