<?php
	include 'functions.php';

	function get_gameboard_array(){
		$gameboard_array = [];
		$clean_gameboard = remove_empty_from_string($_POST['gameboard']);
		$final_array = getMultiDimencialArray($clean_gameboard);
		
		return $final_array;
	}

	function getMultiDimencialArray($clean_gameboard){	
		$for_replace = ['[[', ']]', "'"];
		$temp_arr = explode('],[', str_replace($for_replace, '', $clean_gameboard));
		$temp_arr_len = sizeof($temp_arr);
		$final_gameboard = [];
		for ($i=0; $i < $temp_arr_len; $i++) { 
			$temp_arr_splitted = explode(',', $temp_arr[$i]);
			$temp_arr_splitted_len = sizeof($temp_arr_splitted);
			$final_gameboard[$i] = [];
			for ($el=0; $el < $temp_arr_splitted_len; $el++) { 
				array_push($final_gameboard[$i], $temp_arr_splitted[$el]);
			}
		}
		return $final_gameboard;
	}
?>