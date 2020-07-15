<!DOCTYPE html>
<html>
<head>
	<title>Final Exam - Javascript Vratsa Software</title>
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<h1>Javascript Vratsa Software - Final Exam</h1>
	<h3>CandyCrush</h3>
	<p>Let candyCrush1 be a boolean function that returns true if the gameboard contains a set of three or more consecutive candies of the same color in a row or in a column, and false otherwise.</p>
	<p>Your task is to check if a move from the given cell in the given direction is valid, such that after the move is made candyCrush1(newGameboard) will be true. It's guaranteed that the move is made inside the gameboard, so you don't have to handle test cases like moving from cell [0,0] to the left. It's also guaranteed that there's no set of 3 candies of the same color in a row or a column, i.e. candyCrush1(gameboard) is false.</p>

	<h4>Example</h4>
	<p>For gameboard = [['R','G','G','B'], 
             ['B','O','G','G'], 
             ['P','O','B','P'], 
             ['Y','B','Y','O']]

     cell = [0, 1] and direction = 'D', the output should be candyCrush2(gameboard, cell, direction) = true.
 	</p>
 	<p>After the move, the gameboard will look like the following:  [['R','O','G','B'], 
 ['B','G','G','G'], 
 ['P','O','B','P'], 
 ['Y','B','Y','O']]
  There's a row of three consecutive Gs in the first (0-based) row, so the answer is true.
    </p>
    <p>
    	For gameboard = [['R','G','G','B'], 
             ['B','O','G','G'], 
             ['P','O','B','P'], 
             ['Y','B','Y','O']]
              cell = [1, 1] and direction = 'U', the output should be
 candyCrush2(gameboard, cell, direction) = true.

 This test case is similar to the previous one, and produces the same resulting gameboard, so the answer is true.
 	</p>
 	<p>
 		For

 gameboard = [['R','G','G','B'], 
             ['B','O','G','G'], 
             ['P','O','B','P'], 
             ['Y','B','Y','O']]


 cell = [2, 2] and direction = 'L', the output should be
 candyCrush2(gameboard, cell, direction) = false.
	</p>

	<form method="post">
		<div>
			Insert gameboard: <input type="text" name="gameboard" id="gameboard">
		</div>
		<div>
			Insert cell: <input type="text" name="cell" id="cell">
		</div>
		<div>
			Insert direction: <input type="text" name="direction" id="direction">
		<div>
		<input type="button" name="btn" id="btn" value="Go">
	</form>
<script src="js/script.js"></script>
</body>
</html>