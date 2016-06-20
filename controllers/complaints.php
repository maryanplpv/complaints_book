<?php

class Controller_Complaints extends Controller {

	function __construct() {
	
		include '/controllers/authentication.php';
		$this->model = new Model_Complaints();
		$this->view = new View();
		$this->session = new Session();
		$this->load_model('authentication');
		$this->auth = new Controller_Authentication();
		$this->model->auth = $this->auth;
		
	}
	
	
	public function index() {
		
		$data['complaints'] = $this->model->get_complaints();
		$data['total_pages'] = $this->model->total_pages;
		$data['active_page'] = $this->model->active_page;
		$data['user_name'] = $this->session->data('login');
		
		// check access for show/hide admin buttons
		($this->auth->logged_user()) ? $data['is_admin'] = true : $data['is_admin'] = false;
		
		// load view
		$this->view->load('complaints.php', 'main_template.php', $data);
		
	}
	


	public function del() {
	
		// check ajax post
		if (!isset($_POST['id'])) return false;
		
		if ($this->model->del($_POST['id'])) {
			echo 1;
		} else {
			echo 0;
		}
		
	}

	public function addnew() {

		$this->view->load('add_complaint.php', 'main_template.php'); 
		
	}
	
	
	public function update() {
	
		if ($this->model->update($_POST)) {
			echo 1;
		} else {
			echo 0;
		}	
		
	}
	
	
	public function savenew() {
		
		// get post AJAX
		if (!isset($_POST)) return false;
	
		// required inputs
		$valide = array('name','email', 'text', 'capcha');
		
		// check required inputs
		foreach ($valide as $input) {
			if (!isset($_POST[$input])) {return false;}
			
			// check capcha
			if ($input == "capcha") {
				if ($this->session->data('secpic') !== strtolower($_POST['capcha'])) return false;
			}
		}
		
		$post = array();
		// vars
		foreach ($_POST as $input=>$value) {
			$post[$input] = $value;
			//${$input} = strip_tags($value);
		}
		
		if ($this->model->savenew($post)) {
			echo 1;
		} else {
			echo 0;
		}
	
	}

}

?>