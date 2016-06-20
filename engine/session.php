<?php
@session_start();


class Session {
		
	private $session;
	
	public function __construct() {
	
		if (isset($_SESSION)) {
			$this->session = $_SESSION;
		} 
	}
	
	public function session() {
		
		if (isset($_SESSION)) return true;
		
	}
	
	
	public function exists($param) {
	
		return (isset($_SESSION[$param])) ? true : false;
	
	}
	
	public function data($param) {

		if ($this->exists($param)) {return $this->session[$param];}
		
	}
	
	public function unset_data($param) {
	
		if (is_array($param)) {
			foreach ($param as $session_params) {
				unset($_SESSION[$session_params]);
			}
		} else {
			unset($_SESSION[$param]);
		}
		
	}
	
	
	public function set_data($param, $value) {
		
		$_SESSION[$param] = $value;
	
	}
	
	
}


	
?>