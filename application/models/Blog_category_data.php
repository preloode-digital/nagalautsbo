<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_category_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM blog_category WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO blog_category SET';
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
	
	
	public function loadAutoIncrement() {
		
		$this->load->database();
		
		$sql = 'SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?';
		$bind = array(
			$this->db->database,
			'blog_category'
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindName($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category WHERE name = ?';
		$bind = array(
			$data['name']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindStatusOrderNameAsc($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category WHERE status = ? ORDER BY name ASC';
		$bind = array(
			$data['status']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindStatusUrl($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category WHERE status = ? AND url = ?';
		$bind = array(
			$data['status'],
			$data['url']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindUrl($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category WHERE url = ?';
		$bind = array(
			$data['url']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT id FROM blog_category';
		
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
	
	
	public function loadOrderNameAsc() {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM blog_category ORDER BY name ASC';
		$query = $this->db->query($sql);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT * FROM blog_category';
		
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
		
		$sql = 'UPDATE blog_category SET';
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