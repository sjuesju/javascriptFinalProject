<?php
	include 'functions.php';

	function get_gameboard_array(){
		$clean_gameboard = remove_empty_from_string($_POST['gameboard']);
		if (checkForCorrectlyAddedGameboard($clean_gameboard) == false){
			return false;
		}
		$gameboard_array = [];				
		$final_array = getMultiDimencialArray($clean_gameboard);
		
		return $final_array;
	}

	function checkForCorrectlyAddedGameboard($gameboardInput){
		$len = strlen($gameboardInput);
		$squareBraketOn = false;
		$comaCounter = [];
		$colorCounter = [];
		$colonCounter = [];
		$comaIndex = -1;
		$colorIndex = -1;
		$colonIndex = -1;

		if ($gameboardInput[0] != '[' || $gameboardInput[$len - 1] != ']'){
			return false;
		}

		for ($i=1; $i < $len - 1; $i++) { 
			if (strlen($gameboardInput[$i]) > 0){			
				if ($gameboardInput[$i] == '['){
					if ($squareBraketOn == true){
						return false;
					}
					$squareBraketOn = true;
					$comaIndex++;
					$colorIndex++;
					$colonIndex++;
				} else if ($gameboardInput[$i] == ']'){
					if ($squareBraketOn == false){
						return false;
					}
					$squareBraketOn = false;
				} else if ($gameboardInput[$i] == "'"){
					if (($gameboardInput[$i - 1] == '[' || $gameboardInput[$i - 1] == ',' || $gameboardInput[$i - 1] == 'R' || $gameboardInput[$i - 1] == 'G' || $gameboardInput[$i - 1] == 'B' || $gameboardInput[$i - 1] == 'O' || $gameboardInput[$i - 1] == 'P' || $gameboardInput[$i - 1] == 'Y' || $gameboardInput[$i - 1] == ',') && ($gameboardInput[$i + 1] == 'R' || $gameboardInput[$i + 1] == 'G' || $gameboardInput[$i + 1] == 'B' || $gameboardInput[$i + 1] == 'O' || $gameboardInput[$i + 1] == 'P' || $gameboardInput[$i + 1] == 'Y' || $gameboardInput[$i + 1] == ',' || $gameboardInput[$i + 1] == ']')){
							if (isset($colonCounter[$colonIndex]) == false){
								$colonCounter[$colonIndex] = 1;
							} else {					
								$colonCounter[$colonIndex]++;
							}
					} else {
						return false;
					}
				} else if ($gameboardInput[$i] == ","){
					if (($gameboardInput[$i - 1] == "'" || $gameboardInput[$i - 1] == "]") && ($gameboardInput[$i + 1] == "'" || $gameboardInput[$i + 1] == "[") ){
						// it is ok
					} else {
						return false;
					}
					if ($gameboardInput[$i - 1] && $gameboardInput[$i + 1] == "'"){
						if (isset($comaCounter[$comaIndex]) == false){
							$comaCounter[$comaIndex] = 1;
						} else {					
							$comaCounter[$comaIndex]++;
						}
					}
				} else if ($gameboardInput[$i] == "R" || $gameboardInput[$i] == "G" || $gameboardInput[$i] == "B" || $gameboardInput[$i] == "O" || $gameboardInput[$i] == "P" || $gameboardInput[$i] == "Y"){
					if (isset($colorCounter[$colorIndex]) == false){
							$colorCounter[$colorIndex] = 1;
						} else {					
							$colorCounter[$colorIndex]++;
						}
				} else {
					return false;
				}
			}
		}

		if (compareNumberOfElementsInEveryRow($comaCounter) == false){
			return false;
		}
		if (compareNumberOfElementsInEveryRow($colonCounter) == false){
			return false;
		}
		if (compareNumberOfElementsInEveryRow($colorCounter) == false){
			return false;
		}
		return true;
	}

	function compareNumberOfElementsInEveryRow($comaCounter){
		$len = sizeof($comaCounter);
		$numberOfElements = 0;
		if ($len == 0){
			return true;
		}
		$numberOfElements = $comaCounter[0];
		for ($i = 1; $i < $len; $i++) {
			if ($comaCounter[$i] != $numberOfElements){
				return false;
			}
		}
		return true;
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