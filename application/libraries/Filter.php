<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter {
	
	
	/* Load filter value */
	public function load($data) {
		
		$result = array(
			'bind' => array(),
			'sql' => ''
		);
		
		if(!empty($_COOKIE[$data['name']])) {
			
			$cookie = (array) json_decode($_COOKIE[$data['name']]);
			
			if(!empty($cookie)) {
				
				$filter = '';
				
				foreach($cookie as $key => $value) {
					
					if($key == $data['account']) {
						
						$filter = (array) $value;
						
					}
					
				}
				
				if(!empty($filter)) {
					
					foreach($filter as $key => $value) {
						
						if(!empty($value[0]) && !empty($data['column'][$key])) {
							
							if(count($value) > 1) {
								
								$result['sql'] .= ' AND '.$data['column'][$key].' BETWEEN ? AND ?';
								$result['bind'][] = $value[0];
								$result['bind'][] = $value[1];
								
							}
							
							else {
								
								$result['sql'] .= ' AND '.$data['column'][$key].' LIKE ?';
								$result['bind'][] = '%'.$value[0].'%';
								
							}
													
						}
						
					}
					
				}
				
				$result['sql'] = preg_replace('# AND #', '', $result['sql'], 1);
				
			}
			
		}
		
		return $result;
		
	}
	
	
	/* Remove filter value */
	public function remove($data) {
		
		if(!empty($_COOKIE[$data['name']])) {
			
			$cookie = (array) json_decode($_COOKIE[$data['name']]);
			
			if(!empty($cookie)) {
				
				foreach($cookie as $key => $value) {
					
					$filter[$key] = (array) $value;
					
				}
				
			}
			
			if(!empty($filter[$data['account']])) {
				
				foreach($filter[$data['account']] as $key => $value) {
					
					$filter[$data['account']][$key][0] = '';
					
					if(count($filter[$data['account']][$key]) > 1) {
						
						$filter[$data['account']][$key][1] = '';
						
					}
					
				}
				
			}
			
			$filter = json_encode($filter);
			
			setcookie($data['name'], $filter, time() + (86400 * 1), $data['path']);
			
		}
		
	}
	
	
	/* Update filter value */
	public function write($data) {
		
		$filter = array();
		
		if(!empty($_COOKIE[$data['name']])) {
			
			$cookie = (array) json_decode($_COOKIE[$data['name']]);
			
			if(!empty($cookie)) {
				
				foreach($cookie as $key => $value) {
					
					$filter[$key] = (array) $value;
					
				}
				
				if(!empty($filter[$data['account']])) {
					
					if(!empty($data['input'])) {
						
						$filter[$data['account']] = $data['input'];
						
					}
					
				}
				
			}
			
		}
		
		else {
			
			$filter[$data['account']] = $data['input'];
			
		}
		
		$filter = json_encode($filter);
		
		setcookie($data['name'], $filter, time() + (86400 * 1), $data['path']);
		
	}
	
	
}
?>