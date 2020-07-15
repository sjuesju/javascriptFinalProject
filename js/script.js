$("#btn").on("click", function(event){
	let gameObject = {gameboard:$('#gameboard').val(), cell:$('#cell').val(), direction:$('#direction').val()};
	checkForEmptyInputs(gameObject);
});

function checkForEmptyInputs(gameObject){
	const keys = Object.keys(gameObject)
	for (const key of keys) {
  		console.log(key)
  		checkForEmptyInput(gameObject.key, key);
	}


	// for (const [key, value] of Object.entries(object1)) {
 //  		console.log(`${key}: ${value}`);
	// }
	// checkForEmptyInput(gameObject.gameboard, 'gameboard');
	// checkForEmptyInput(cell, 'cell');
	// checkForEmptyInput(direction, 'direction');
}

function checkForEmptyInput(variableResult, variableName){
	if(variableResult.trim().length == 0){
		$('#' + variableName).after('<span class="error">Field Required</span>');
	}
}



