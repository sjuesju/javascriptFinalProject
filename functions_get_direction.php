<?php 
	function get_direction(){
		$for_replace = array('"', "'");
		return remove_empty_from_string(str_replace($for_replace, '', $_POST['direction']));
	}
?>