<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page {
	
	
	/* Jump to specified page */
	public function jump($data) {
		
		$page = preg_replace('#[^0-9]#', '', $data['page']);
		$result = $data['url'].'page-'.$page;
		$result = ($page < 1 ? $data['url'] : $result);
		
		header('Location: '.$result.'');
		
	}
	
	
}
?>