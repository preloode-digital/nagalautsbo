<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administrator_data extends CI_Model {
	
	
	public $initialize;
	
	
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	public function delete($data) {
		
		$this->load->database();
		
		$sql = 'DELETE FROM administrator WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$this->db->query($sql, $bind);
		
		$this->db->close();
		
	}
	
	
	public function insert($data) {
		
		$this->load->database();
		
		$sql = 'INSERT INTO administrator SET';
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
		
		$sql = 'SELECT * FROM administrator WHERE id = ?';
		$bind = array(
			$data['id']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadBindUsername($data) {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator WHERE username = ?';
		$bind = array(
			$data['username']
		);
		$query = $this->db->query($sql, $bind);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadIdPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT id FROM administrator';
		
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
	
	
	public function loadOrderUsernameAsc() {
		
		$this->load->database();
		
		$sql = 'SELECT * FROM administrator ORDER BY username ASC';
		$query = $this->db->query($sql);
		
		return $query->result_array();
		
		$this->db->close();
		
	}
	
	
	public function loadPagination($data) {
		
		$this->load->database();
		$this->load->library('filter');
		
		$sql = 'SELECT * FROM administrator';
		
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
	
	
	public function resizePicture($data) {
		
		$source['path'] = dirname(dirname(dirname(__FILE__))).$data['sourcePath'];
		$destination['path'] = dirname(dirname(dirname(__FILE__))).$data['destinationPath'];
		
		$file = explode('.', $data['sourcePath']);
		$file[1] = strtolower($file[1]);
		
		if($file[1] == 'gif') {
			
			$source['image'] = imagecreatefromgif($source['path']);
			
		}
		
		else if($file[1] == 'png') {
			
			$source['image'] = imagecreatefrompng($source['path']);
			
		}
		
		else {
			
			$source['image'] = imagecreatefromjpeg($source['path']);
			
		}
		
		$destination['image'] = imagecreatetruecolor($data['destinationWidth'], $data['destinationHeight']);
		
		imagecopyresampled($destination['image'], $source['image'], $data['destinationX'], $data['destinationY'], $data['sourceX'], $data['sourceY'], $data['destinationWidth'], $data['destinationHeight'], $data['sourceWidth'], $data['sourceHeight']);
		
		if($file[1] == 'gif') {
			
			imagegif($destination['image'], $destination['path']);
			
		}
		
		else if($file[1] == 'png') {
			
			imagepng($destination['image'], $destination['path'], 9);
			
		}
		
		else {
			
			imagejpeg($destination['image'], $destination['path'], 100);
			
		}
		
	}
	
	
	public function update($data) {
		
		$this->load->database();
		
		$sql = 'UPDATE administrator SET';
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
	
	
	public function uploadPicture($data) {
		
		$this->load->library('upload');
		
		$file = preg_replace('#[^0-9A-Za-z\s._-]#', '', $_FILES['file']['name'][0]);
		$file = preg_replace('#[\s]#', '_', $file);
		$file = strtolower($file);
		
		$upload = array(
			'upload_path' => dirname(dirname(dirname(__FILE__))).'/asset/image/panel/administrator',
			'allowed_types' => 'gif|jpeg|jpg|png',
			'max_size'	=> '10240'
		);
		$_FILES['file_1'] = array(
			'name' => $file,
			'type' => $_FILES['file']['type'][0],
			'tmp_name' => $_FILES['file']['tmp_name'][0],
			'error' => $_FILES['file']['error'][0],
			'size' => $_FILES['file']['size'][0]
		);
		$this->upload->initialize($upload);
		
		if(!$this->upload->do_upload('file_1')) {
			
			$result = $this->upload->display_errors();
			
			if($result == '<p>The filetype you are attempting to upload is not allowed.</p>') {
				
				return '<p>Cannot handle your file type!</p>';
				
			}
			
			else if($result == '<p>The file you are attempting to upload is larger than the permitted size.</p>') {
				
				return '<p>Cannot handle your file size!</p>';
				
			}
			
			else if($result == '<p>The upload path does not appear to be valid.</p>') {
				
				return '<p>Path file doesn\'t exist!</p>';
				
			}
			
		}
		
		else {
			
			return $this->upload->data();
			
		}
		
	}
	
	
}
?>