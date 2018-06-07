<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page_index_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM page_index WHERE page_id = ?';
		$bind = array(
			$data['page_id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO page_index SET';
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
	
	
	public function loadBindPageId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT page.id AS page_id, page.content AS page_content, page.name AS page_name, page_index.description AS description, page_index.meta_description AS meta_description, page_index.meta_keyword AS meta_keyword, page_index.meta_title AS meta_title, page_index.og_description AS og_description, page_index.og_title AS og_title, page_index.title AS title, url.id AS url_id, url.name AS url_name, url.status AS url_status, url.url AS url_url FROM page, page_index, url WHERE page.id = page_index.page_id AND page_index.page_id = ? AND page_index.url_id = url.id';
		$bind = array(
			$data['page_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindPageIdUrlId($data) {
		
		$this->load->database();
		
		$sql = 'SELECT page.id AS page_id, page.content AS page_content, page.name AS page_name, page_index.description AS description, page_index.meta_description AS meta_description, page_index.meta_keyword AS meta_keyword, page_index.meta_title AS meta_title, page_index.og_description AS og_description, page_index.og_title AS og_title, page_index.title AS title, url.id AS url_id, url.name AS url_name, url.status AS url_status, url.url AS url_url FROM page, page_index, url WHERE page.id = page_index.page_id AND page_index.page_id = ? AND page_index.url_id = url.id';
		$bind = array(
			$data['page_id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function resetIndex() {
		
		$this->load->database();
		
		$sql = 'ALTER TABLE page_index DROP id';
		$query = $this->db->query($sql);
		
		$sql = 'ALTER TABLE page_index ADD id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST';
		$query = $this->db->query($sql);
		
		$this->db->close();
		
	}
	
	
}
?>