$("#btn").on("click", function(){
	let gameObject = {gameboard:$('#gameboard').val(), cell:$('#cell').val(), direction:$('#direction').val()};
	checkForEmptyInputs(gameObject);
});

$("#gameboard").on("input", checkForCorrectlyAddedGameboard);

function checkForCorrectlyAddedGameboard(){

	if (isGameboardInputOk($('#gameboard').val().trim().split('')) == false){
		console.log('False');
	}	
}

function isGameboardInputOk(gameboardInput){
	let len = gameboardInput.length, squareBraketOn = false;
	removeEmptyElementsInGameboardInput();

	if (gameboardInput[0] != '[' || gameboardInput[len - 1] != ']'){
		console.log(gameboardInput[0])
		return false;
	}
	for (var i = 1; i < len - 1; i++) {
		if (gameboardInput[i].length > 0){			
			if (gameboardInput[i] == '['){
				if (squareBraketOn == true){
					return false;
				}
				squareBraketOn = true;
			} else if (gameboardInput[i] == ']'){
				if (squareBraketOn == false){
					return false;
				}
				squareBraketOn = false;
			} else if (gameboardInput[i] == "'"){
				if((gameboardInput[i - 1] == '[' || gameboardInput[i - 1] == ',') && (gameboardInput[i + 1] == 'R' || gameboardInput[i + 1] == 'G' || gameboardInput[i + 1] == 'B' || gameboardInput[i + 1] == 'O' || gameboardInput[i + 1] == 'P' || gameboardInput[i + 1] == 'Y' || gameboardInput[i + 1] == ',' || gameboardInput[i + 1] == ']')){
					// it is ok
				} else {
					return false;
				}
			}
		}
	}
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



