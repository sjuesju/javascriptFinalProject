<?php
	function get_cell(){
		$cell_array = [];
		$clean_cell = remove_empty_from_string($_POST['cell']);
		preg_match("/^\[(?<first>[0-9]{1,}),(?<second>[0-9]{1,})\]$/", $clean_cell, $cell_data);
		array_push($cell_array, $cell_data['first']);
		array_push($cell_array, $cell_data['second']);
		return $cell_array;
	}
?>