<?php
	function check_for_candy_crush($gameboard_array){
		$lenY = sizeof($gameboard_array);
		$lenX = sizeof($gameboard_array[0]);

		for ($i=0; $i < $lenY; $i++) { 
			for ($row=1; $row < $lenX - 1; $row++) { 
				if ($gameboard_array[$i][$row] == $gameboard_array[$i][$row-1] && $gameboard_array[$i][$row] == $gameboard_array[$i][$row+1]){
					return true;
				}
			}
		}

		for ($i=0; $i < $lenX; $i++) { 
			for ($row=1; $row < $lenY - 1; $row++) { 
				if ($gameboard_array[$row][$i] == $gameboard_array[$row - 1][$i] && $gameboard_array[$row][$i] == $gameboard_array[$row + 1][$i]){
					return true;
				}
			}
		}
		
		return false;
	}

	function remove_empty_from_string($str){
		$clean_str = '';
		$temp_str = str_split($str);
		$len = sizeof($temp_str);
		for ($i=0; $i < $len; $i++) { 
			if (strlen(trim($temp_str[$i])) > 0){
				$clean_str .= trim($temp_str[$i]); 
			}
		}
		return $clean_str;
	}

	function get_cell_array_to_change($cell_array, $direction){
		if ($direction == 'U'){
			$cell_array[0]--;
		} elseif ($direction == 'R'){
			$cell_array[1]++;
		} elseif ($direction == 'D'){
			$cell_array[0]++;
		} elseif ($direction == 'L'){
			$cell_array[1]--;
		} else {
			// shouldn't reach 
		}
		return $cell_array;
	}
?>