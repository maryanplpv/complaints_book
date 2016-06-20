<?php


class Controller extends Session {
	
	public $model;
	public $view;
	
	function __construct() {
		$this->view = new View();
		$this->db = new Db();
	}
	
	
	public function load_model($name) {
		$file = ABSPATH . '/models/'.$name.'.php';
			if (file_exists($file)) include $file;
	}
	
	public function load_library($url) {
		$file = ABSPATH . '/libs/'.$url;
			if (file_exists($file)) include $file;
	}
	
	

		
}

?>