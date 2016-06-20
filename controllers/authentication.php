<?php

class Controller_Authentication extends Controller {
	

	function __construct() {
		$this->model = new Model_Authentication();
		$this->view = new View();
	}
	
	function index() {	
		$this->view->load('login.php', 'main_template.php');
	}


	public function register() {
		// check post data
		/*if (!isset($post['login']) || !isset($post['pass'])) return false;
		
		// xss
		$login = strip_tags($post['login']);
		$pass = strip_tags($post['pass']);
		$pass = sha1(md5($pass));
		
		// register new user
		if ($this->register($login, $pass)) return true;
		*/
	}
	
	
	public function logout() {
		
		// logout
		if ($this->model->logout()) {
			echo 1; // for AJAX
			return true;
		}
	}
	
	
	public function logged_user() {
		
		return $this->model->logged_user();
		
	}


	public function login() {
		
		// check post data AJAX
		if (!isset($_POST['login']) || !isset($_POST['pass'])) return false;
		
		// login
		if ($this->model->login($_POST['login'], $_POST['pass'])) {

			echo 1; // for AJAX
			return true;
		} 
	}
	
	
	
}

?>