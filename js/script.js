$("#btn").on("click", function(){
	let gameObject = {gameboard:$('#gameboard').val(), cell:$('#cell').val(), direction:$('#direction').val()};
	if (checkForEmptyInputs(gameObject) == false){
		return false;
	}
	// php validation
	if (checkIsMoveWithinArray(gameObject) == false){
		return false;
	}

});

$("#gameboard").on("input", checkForCorrectlyAddedGameboard);
$("#cell").on("input", checkForCorrectlyAddedCell);
$("#direction").on("input", checkForCorrectlyAddedDirection);

function checkIsMoveWithinArray(gameObject){
	let arraySize = getArraySize(gameObject.gameboard);
}

function getArraySize(gameboard){
	let splittedGameboard = gameboard.split('['), splittedGameboardElement = splittedGameboard[2].split(','), final = [];
	final.push(splittedGameboard.length - 2);
	final.push(splittedGameboardElement.length - 1);
	return final;
}

function checkForCorrectlyAddedDirection(){
	let direction = $('#direction'), directionInput = removeEmptyElementsInInputReturnString(direction.val());
	if (directionInput == 'R' || directionInput == 'L' || directionInput == 'U' || directionInput == 'D'){
			direction.css('border-color', 'green');
	} else {
		direction.css('border-color', 'red');
	}
}

function checkForCorrectlyAddedGameboard(){
	let gameBoard = $('#gameboard'), gameboardInput = removeEmptyElementsInInput(gameBoard.val());
	if (isGameboardInputOk(gameboardInput) == false){
		gameBoard.css('border-color', 'red');
	} else {
		gameBoard.css('border-color', 'green');
	}
}

function checkForCorrectlyAddedCell(){
	let cell = $('#cell'), cellInput = removeEmptyElementsInInputReturnString(cell.val());
	if (isCellInputOk(cellInput) == false){
		cell.css('border-color', 'red');
	} else {
		cell.css('border-color', 'green');
	}
}

function isCellInputOk(cellInput){
	var regex = /^\[\d{1,}\,\d{1,}\]$/;
	return regex.test(cellInput);
}

function removeEmptyElementsInInput(input){
	let temp = input.split(''), len = input.length, final = [];
	for (var i = 0; i < len; i++) {
		if (temp[i].trim().length > 0){
			final.push(temp[i]);
		}
	}
	return final;
}

function removeEmptyElementsInInputReturnString(input){
	let temp = input.split(''), len = input.length, final = "";
	for (var i = 0; i < len; i++) {
		if (temp[i].trim().length > 0){
			final += temp[i];
		}
	}
	return final;
}

function isGameboardInputOk(gameboardInput){
	let len = gameboardInput.length, squareBraketOn = false, comaCounter = [], colorCounter = [], colonCounter = [], comaIndex = -1, colorIndex = -1, colonIndex = -1;	

	if (gameboardInput[0] != '[' || gameboardInput[len - 1] != ']'){
		return false;
	}
	for (var i = 1; i < len - 1; i++) {
		if (gameboardInput[i].length > 0){			
			if (gameboardInput[i] == '['){
				if (squareBraketOn == true){
					return false;
				}
				squareBraketOn = true;
				comaIndex++;
				colorIndex++;
				colonIndex++;
			} else if (gameboardInput[i] == ']'){
				if (squareBraketOn == false){
					return false;
				}
				squareBraketOn = false;
			} else if (gameboardInput[i] == "'"){
				if ((gameboardInput[i - 1] == '[' || gameboardInput[i - 1] == ',' || gameboardInput[i - 1] == 'R' || gameboardInput[i - 1] == 'G' || gameboardInput[i - 1] == 'B' || gameboardInput[i - 1] == 'O' || gameboardInput[i - 1] == 'P' || gameboardInput[i - 1] == 'Y' || gameboardInput[i - 1] == ',') && (gameboardInput[i + 1] == 'R' || gameboardInput[i + 1] == 'G' || gameboardInput[i + 1] == 'B' || gameboardInput[i + 1] == 'O' || gameboardInput[i + 1] == 'P' || gameboardInput[i + 1] == 'Y' || gameboardInput[i + 1] == ',' || gameboardInput[i + 1] == ']')){
					if (typeof colonCounter[colonIndex] == 'undefined'){
						colonCounter[colonIndex] = 1;
					} else {					
						colonCounter[colonIndex]++;
					}
				} else {
					return false;
				}
			} else if (gameboardInput[i] == ","){
				if ((gameboardInput[i - 1] == "'" || gameboardInput[i - 1] == "]") && (gameboardInput[i + 1] == "'" || gameboardInput[i + 1] == "[") ){
					// it is ok
				} else {
					return false;
				}
				if (gameboardInput[i - 1] && gameboardInput[i + 1] == "'"){
					if (typeof comaCounter[comaIndex] == 'undefined'){
						comaCounter[comaIndex] = 1;
					} else {					
						comaCounter[comaIndex]++;
					}
				}			

			} else if (gameboardInput[i] == "R" || gameboardInput[i] == "G" || gameboardInput[i] == "B" || gameboardInput[i] == "O" || gameboardInput[i] == "P" || gameboardInput[i] == "Y"){
				if (typeof colorCounter[colorIndex] == 'undefined'){
						colorCounter[colorIndex] = 1;
					} else {					
						colorCounter[colorIndex]++;
					}
			} else {
				return false;
			}
		}
	}
	if (compareNumberOfElementsInEveryRow(comaCounter) == false){
		return false;
	}
	if (compareNumberOfElementsInEveryRow(colonCounter) == false){
		return false;
	}
	if (compareNumberOfElementsInEveryRow(colorCounter) == false){
		return false;
	}
	return true;
}

function compareNumberOfElementsInEveryRow(comaCounter){
	let len = comaCounter.length, numberOfElements = 0;
	if (len == 0){
		return true;
	}
	numberOfElements = comaCounter[0];
	for (var i = 1; i < len; i++) {
		if (comaCounter[i] != numberOfElements){
			return false;
		}
	}
	return true;
}

function checkForEmptyInputs(gameObject){
	let flag = true;
	$('.error').remove();
	if (checkForEmptyInput(gameObject.gameboard, 'gameboard') == false){
		flag = false;
	}
	if (checkForEmptyInput(gameObject.cell, 'cell') == false){
		flag = false;
	}

	if (checkForEmptyInput(gameObject.direction, 'direction') == false){
		flag = false;
	}
	return flag;
}

function checkForEmptyInput(variableResult, variableName){
	if(variableResult.trim().length == 0){
		$('#' + variableName).after('<span class="error">Field Required</span>');
		return false;
	}
}



