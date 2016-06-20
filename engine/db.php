<?php

class Db {

	protected $db_host = 'localhost';
	protected $db_user = 'root';
	protected $db_pass = '';
	protected $db_name = 'complaints';
	protected $db_result;


	public function connect() {
	
		$link = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
			if (!isset($link)) {
				die('Connection error: ' . mysql_error());
			} else {
				mysql_select_db($this->db_name, $link) or die('Could not select database.');
				return $link;
			}
		mysql_close($link);	
		
	}
	
	
	public function query_result($q_ext) {
	
		$this->connect();
		$q = mysql_query($q_ext);
		if (!$q){ echo('Database error: ' . mysql_error());}
		while($r[] = mysql_fetch_assoc($q));
		$this->db_result = $r;
		mysql_free_result($q);
		
	}
	
	
	public function query($q_ext) {
	
		$this->connect();
		$q = mysql_query($q_ext);
		if (!$q){ exit('Database error: ' . mysql_error());}
		$this->db_result = $q;
		$this->last_insert_ids = mysql_insert_id();
		
	}
	

	public function result() {
	
		if (is_array($this->db_result)) {
			return array_filter($this->db_result);
		} else {
			return $this->db_result;
		}
		
	}
	
	
}


	
?>