<?php 
	include 'functions_get_gameboard.php';
	include 'functions_get_cell.php';
	include 'functions_get_direction.php';

	$gameboard_array = get_gameboard_array();
	$cell_array = get_cell();
	$direction = get_direction();

	$cell_current = $gameboard_array[$cell_array[0]][$cell_array[1]];
	$cell_array_to_change = get_cell_array_to_change($cell_array, $direction);
	$cell_to_change = $gameboard_array[$cell_array_to_change[0]][$cell_array_to_change[1]];

	$gameboard_array[$cell_array[0]][$cell_array[1]] = $cell_to_change;
	$gameboard_array[$cell_array_to_change[0]][$cell_array_to_change[1]] = $cell_current;

	echo json_encode(check_for_candy_crush($gameboard_array));



	
	
?>