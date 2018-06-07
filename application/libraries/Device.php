<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Device {
	
	
	/* Get OS information */
	public function getOs() {
		
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		
		$osSupported = array(
			'/windows nt 10/i' => 'Windows 10',
			'/windows nt 6.3/i' => 'Windows 8.1',
			'/windows nt 6.2/i' => 'Windows 8',
			'/windows nt 6.1/i' => 'Windows 7',
			'/windows nt 6.0/i' => 'Windows Vista',
			'/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
			'/windows nt 5.1/i' => 'Windows XP',
			'/windows xp/i' => 'Windows XP',
			'/windows nt 5.0/i' => 'Windows 2000',
			'/windows me/i' => 'Windows ME',
			'/win98/i' => 'Windows 98',
			'/win95/i' => 'Windows 95',
			'/win16/i' => 'Windows 3.11',
			'/macintosh|mac os x/i' => 'Mac OS X',
			'/mac_powerpc/i' => 'Mac OS 9',
			'/linux/i' => 'Linux',
			'/ubuntu/i' => 'Ubuntu',
			'/iphone/i' => 'iPhone',
			'/ipod/i' => 'iPod',
			'/ipad/i' => 'iPad',
			'/android/i' => 'Android',
			'/blackberry/i' => 'BlackBerry',
			'/webos/i' => 'Mobile'
		);
		
		$result  = 'Unknown OS';
		
		foreach($osSupported as $key => $value) {
			
			if(preg_match($key, $userAgent)) {
				
				$result = $value;
				
			}
			
		}
		
		return $result;
		
	}
	
	
	/* Get browser information */
	public function getBrowser() {
		
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		
		$browserSupported = array(
			'/msie/i' => 'Internet Explorer',
			'/firefox/i' => 'Firefox',
			'/safari/i' => 'Safari',
			'/chrome/i' => 'Chrome',
			'/edge/i' => 'Edge',
			'/opera/i' => 'Opera',
			'/netscape/i' => 'Netscape',
			'/maxthon/i' => 'Maxthon',
			'/konqueror/i' => 'Konqueror',
			'/mobile/i' => 'Handheld Browser'
		);
		
		$result = 'Unknown Browser';
		
		foreach($browserSupported as $key => $value) {
			
			if(preg_match($key, $userAgent)) {
				
				$result = $value;
				
			}
			
		}
		
		return $result;
		
	}
	
	
}
?>