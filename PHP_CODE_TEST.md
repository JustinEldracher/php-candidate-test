1. Refactor the following pseudo code, correct if necessary.

    $id = $request['id'];
    $result = query($conn, "SELECT * FROM testdb WHERE id = $id");


2. Given the following, What is the value of $b, what is the value of $a, why is that the value?

    function doSomething ( &$arg )
    {
        $return = $arg;
        $arg += 1;
        return $return;
    }
    
    $a = 3;
    $b = doSomething( $a );


3. Parse the included file and output in the format below.  This should be a command line tool.   Create the parsing code as a library so that it may be used by other applications (Hint: OOP).
Bonus (optional): Design so that other file formats (xml, json) can be used in the future with ease.

Use the following format for displaying results from the command line application.

    <id> <name> (<quantity>)
    - <category 1>
    - <category 2>
    - <category n...>

Example:  

    68-OX-YH94 Carrot (5)
    - vegetable
    - green
    - orange
    - skinny


4. Implement a function to convert an integer to roman numeral function.  It should allow a custom format for 1 and 5 (e.g. 1=Z, 5=P). 
Bonus (optional) Use an object oriented approach.
