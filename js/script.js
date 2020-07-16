$("#btn").on("click", function(){
	let gameObject = {gameboard:$('#gameboard').val(), cell:$('#cell').val(), direction:$('#direction').val()};
	checkForEmptyInputs(gameObject);
});

$("#gameboard").on("input", checkForCorrectlyAddedGameboard);

function checkForCorrectlyAddedGameboard(){
	let gameBoard = $('#gameboard'), gameboardInput = removeEmptyElementsInGameboardInput(gameBoard.val());
	if (isGameboardInputOk(gameboardInput) == false){
		gameBoard.css('border-color', 'red');
	} else {
		gameBoard.css('border-color', 'green');
	}
}

function removeEmptyElementsInGameboardInput(gameboardInput){
	let temp = gameboardInput.split(''), len = gameboardInput.length, final = [];
	for (var i = 0; i < len; i++) {
		if (temp[i].trim().length > 0){
			final.push(temp[i]);
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
			} else if (gameboardInput[i] == ']'){
				if (squareBraketOn == false){
					return false;
				}
				squareBraketOn = false;
			} else if (gameboardInput[i] == "'"){
				if ((gameboardInput[i - 1] == '[' || gameboardInput[i - 1] == ',' || gameboardInput[i - 1] == 'R' || gameboardInput[i - 1] == 'G' || gameboardInput[i - 1] == 'B' || gameboardInput[i - 1] == 'O' || gameboardInput[i - 1] == 'P' || gameboardInput[i - 1] == 'Y' || gameboardInput[i - 1] == ',') && (gameboardInput[i + 1] == 'R' || gameboardInput[i + 1] == 'G' || gameboardInput[i + 1] == 'B' || gameboardInput[i + 1] == 'O' || gameboardInput[i + 1] == 'P' || gameboardInput[i + 1] == 'Y' || gameboardInput[i + 1] == ',' || gameboardInput[i + 1] == ']')){
					// it is ok
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
				// it is ok
			} else {
				return false;
			}
		}
	}
	return compareNumberOfElementsInEveryRow(comaCounter);
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
	$('.error').remove();
	checkForEmptyInput(gameObject.gameboard, 'gameboard');
	checkForEmptyInput(gameObject.cell, 'cell');
	checkForEmptyInput(gameObject.direction, 'direction');
}

function checkForEmptyInput(variableResult, variableName){
	if(variableResult.trim().length == 0){
		$('#' + variableName).after('<span class="error">Field Required</span>');
	}
}



