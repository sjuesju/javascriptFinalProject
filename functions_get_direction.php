<?php 
	function get_direction(){
		$for_replace = array('"', "'");
		$directionInput = remove_empty_from_string(str_replace($for_replace, '', $_POST['direction']));
		return check_for_correctly_added_direction($directionInput);
	}

	function check_for_correctly_added_direction($directionInput){
		if ($directionInput == 'R' || $directionInput == 'L' || $directionInput == 'U' || $directionInput == 'D'){
			return $directionInput;
		} else {
			return false;
		}
	}
?>