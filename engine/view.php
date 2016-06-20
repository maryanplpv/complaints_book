<?php

class View {
	
	public $template_view = 'main_template'; // default template name
	
	public function load($content_view, $template_view, $data = null) {
		
		// convert array to vars
		extract($data, EXTR_PREFIX_SAME, "dup");
		
		//load view
		include './views/templates/' . $template_view;
	}
}

?>