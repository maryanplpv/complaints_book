<?php

class Model_Authentication extends Model {


	public function login($login, $pass) {
		$pass = sha1(md5($pass));
		$this->db->query_result("SELECT login,pass FROM users WHERE login='$login' AND pass='$pass'");
		
		if ($this->db->result() == true) {
			
			$this->session->set_data('login', $_POST['login']);
			$this->session->set_data('login_date', date('Y-m-d H:i:s'));
			
			return true;
		}
	
	}
	
	
	public function logged_user() {
		
		if ($this->session->exists('login')) {return true;} else {return false;}
		
	}
	
	
	public function logout() {
	
		if ($this->session()) {
			$this->session->unset_data('login');
			$this->session->unset_data('login_date');	
			return true;
		}

	}
	
	public function register($login, $pass) {
		$this->db->query("INSERT INTO users (login, pass) VALUES ('".$login."', '".$pass."')");
		if ($this->db->result() == true) {return true;}	
	}
}
?>