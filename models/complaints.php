<?php


class Model_Complaints extends Model {
	
	public $order_by = 'datetime DESC';	// default sorting
	public $limit = 5; // items per 1 page
	public $total_pages; // count of pages
	public $active_page = 1; // active page
	public $pagination = '0,5';
	

	public function get_complaints() {
	
		// get page number from AJAX
		if (isset($_POST['listpage'])) {
			$this->pagination = (($_POST['listpage']-1)*$this->limit).','.$this->limit; 
			$this->active_page = $_POST['listpage'];
		}
		
		// sorting from AJAX
		if (isset($_POST['sort'])) {
			if (!empty($_POST['sort'])) {$this->order_by = $_POST['sort'];}
		}
		
		// explode pages
		$this->total_pages = ceil($this->complaint_count() / $this->limit);
		
		// get data
		$this->db->query_result("SELECT * FROM complaints_list ORDER BY ".$this->order_by." LIMIT ".$this->pagination);
		
		if ($this->db->result() == true) {
	
			return $this->db->result();
			
		}	
		
	}
	

	
	public function complaint_count() {
		$this->db->query_result("SELECT COUNT(*) as count FROM complaints_list");
		$count = $this->db->result();
		return $count[0]['count'];
	}
	
	
	public function del($id) {
	
		// check access
		if ($this->auth->logged_user() == false) return false;
		
		$this->db->query("DELETE FROM complaints_list WHERE id='$id'");
		if ($this->db->result() == true) {return true;}	
		
	}
	
	
	public function update($post) {
		
		// check access
		if ($this->auth->logged_user() == false) return false;
		
		//xss
		$post = $this->xss_clean_tags($post);
		
		extract($post, EXTR_PREFIX_SAME, "dup");
		
		// update data
		$this->db->query("UPDATE complaints_list SET  email='$email', name='$name', text='$text', website='$website' WHERE id=$id");
		if ($this->db->result() == true) {return true;}			
	}
	
	
	public function savenew($post) {
		
		// check access
		if ($this->auth->logged_user() == true) {return false;}
		
		
		//xss
		$post = $this->xss_clean_tags($post);
		
		extract($post, EXTR_PREFIX_SAME, "dup");
		$datetime = date('Y-m-d H:i:s');
		$ipaddr = $_SERVER['SERVER_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		
		// insert data
		$this->db->query("INSERT INTO complaints_list (datetime, email, name, text, website, ipaddr, browser) 
						VALUES ('$datetime', '$email', '$name', '$text', '$website', '$ipaddr', '$browser')");
		if ($this->db->result() == true) {return true;}	
		
	}
	
	
}
?>