<?php 
	include 'functions_get_gameboard.php';
	include 'functions_get_cell.php';
	include 'functions_get_direction.php';

	$errors = [];

	$gameboard_array = get_gameboard_array();
	if ($gameboard_array == false){		
		$errors['gameboard_error'] = "Incorrect input for the gameboard! Please try again!";
		echo json_encode($errors);
		return false;
	}
	$cell_array = get_cell();
	if ($cell_array == false){
		$errors['cell_error'] = "Incorrect input for the cell! Please try again!";
		echo json_encode($errors);
		return false;
	} 
	$direction = get_direction();
	if ($direction == false){
		$errors['direction_error'] = "Incorrect input for the direction! Please try again!";
		echo json_encode($errors);
		return false;
	}
	if (isset($gameboard_array[$cell_array[0]][$cell_array[1]])){
		$cell_current = $gameboard_array[$cell_array[0]][$cell_array[1]];
	} else {
		$errors['wrong_move'] = "The called cell is outside of the gameboard";
		echo json_encode($errors);
		return false;
	}
		
	$cell_array_to_change = get_cell_array_to_change($cell_array, $direction);
	$initial_gameboard_array = $gameboard_array;
	if (isset($gameboard_array[$cell_array_to_change[0]][$cell_array_to_change[1]])){
		$cell_to_change = $gameboard_array[$cell_array_to_change[0]][$cell_array_to_change[1]];
	} else {
		$errors['wrong_move'] = "Your move is outside of the border";
		echo json_encode($errors);
		return false;
	}
	$gameboard_array[$cell_array[0]][$cell_array[1]] = $cell_to_change;
	$gameboard_array[$cell_array_to_change[0]][$cell_array_to_change[1]] = $cell_current;

	if (sizeof($errors) > 0){
		echo json_encode($errors);
	} else {
		$temp_array = check_for_candy_crush($gameboard_array);
		$final_array = [];
		$final_array[0] = $temp_array[0];
		$final_array[1] = $initial_gameboard_array;
		$final_array[2] = $gameboard_array;
		if (isset($temp_array[1])){
			$final_array[3] = $temp_array[1];
		}
		echo json_encode($final_array);
	}		
?>