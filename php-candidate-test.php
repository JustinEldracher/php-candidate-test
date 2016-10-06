<?php

// Part 1:

	/*
		I have not done any code refactoring previously, so I'm not entirely sure what you want done.
		But here is how I would have written those two commands.  "testdb" is not a very good name for
		a database table, so if that's actually supposed to be the name of the database I would replace it
		with something like: "tableone" in the existing SQL code.
	*/

	$id = $request["id"];
	$result = query($conn, "SELECT * FROM testdb WHERE id = $id");

	// To combine both statements onto one line, here is one option:
	$result = query($conn, "SELECT * FROM testdb WHERE id = " . $request["id"]);

	
	
// Part 2:
	
	function doSomething ( &$arg ) {
		$return = $arg;
		$arg += 1;
		return $return;
	}

	$a = 3;
	$b = doSomething( $a );
	
	/*
		At this point, $b == 3 and $a == 4.  Normally, $a would not change.  But the doSomething function uses reference arguments
		which means that any change inside the function effects the original variable outside the function as well. $b equals 3
		because the parameter $arg is assigned to the $return variable right away, and then the $return variable is returned without any
		additional modifications.  $a equals 4 because one is added to the reference argument on line 24, which means that one was also
		added to the $a variable outside the function.
	*/
	
	
	
// Part 3:
	/*
		See file csv-parse.php
	*/
	
	
	
// Part 4:
	/*
		See file arabic-to-roman.php
	*/
