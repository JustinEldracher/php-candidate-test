<?php
	/*
		This script is meant to be run from the command line.  It takes one argument: the name of 
		a file to be processed and if the file is in CSV format it outputs the content of the file
		in a predefined format.
	*/
	
	$csvParser = new ParseCSV($argv[1]);
	print $csvParser->parseFile();
	
	
	
	
	
	
	
	
	// Class to do the dirty work:
	
	class ParseCSV {
		protected $fileToParse = "";
		
		public function __construct($filename) {
			$this->changeFile($filename);
		}
		
		public function changeFile($filename) {
			// Get the extension of the supplied file
			$fileNameSegments = explode(".", $filename);
			$fileExtension = strtolower($fileNameSegments[count($fileNameSegments) - 1]);
			// Check if the file is a CSV
			if ($fileExtension == "csv") {
				$this->fileToParse = $filename;
			} else {
				// Notify user of error
				return "Only CSV files can be parsed by this script!";
			}
		}
	
		public function parseFile($filename = null) {
			/*
				Check and see if the user wants to parse a previously checked
				file or if this function is being called directly by the user
				with a new file.
			*/
			if ($filename == null) {
				$filename = $this->fileToParse;
			}
			// Store the parsed file in a variable so it can be returned rather than only printed
			$parsedFile = "";
			// Open file input stream
			$f = fopen($filename, "r") or die("File does not exist");
			// I prefer to process CSV files by storing them in a matrix first:
			while ($row = fgetcsv($f)) {
				// Assign each column of the CSV file to a variable
				$id = $row[0];
				$name = $row[1];
				$quantity = $row[2];
				// Check if the row is empty and if so skip it:
				if ($id == "" && $name == "" && $quantity == "") {
					continue;
				}
				// Make an array of the categories
				$categories = explode(";", $row[3]);
				$parsedFile .= "$id $name ($quantity)\r\n";
				// Loop through all the categories
				foreach ($categories as $cat) {
					// Check for empty categories
					if ($cat != "") {
						$parsedFile .= "- $cat\r\n";
					}
				}
				// Add an extra line break to create an empty line between entries
				$parsedFile .= "\r\n";
			}
			fclose($f);
			return $parsedFile;
		}
	}
	
	/*
		Here is the output I got:
		
		C:\xampp\htdocs\php-candidate-test>php csv-parse.php items.csv
		73-ou-XW46 Apple (1)
		- a

		67-VI-yW05 Apricot (7)
		- a
		- b

		42-bV-BM29 Banana (34)
		- x

		10-Dx-tU76 Cherry (94)
		- x

		33-tL-TG49 Coconut Pie (3)

		76-KM-iP14 Grape (123)
		- category 1
		- category 2
		- category 3

		72-Bx-hb21 Lemon (645)
		- category 1
		- category2
		- my long category name

		23-jo-Db50 Lime Juice (2)
		- xx

		45-fU-oJ52 Apple (64984654)
		- a
		- k
		- x

		75-AQ-Tj43 Melon on a stick! (231)
		- a
		- b

		67-VI-yW05 Onion (7)
		- category 1

		33-tL-TG49 Lime Juice (7)
		- o
		- x
		- y

		80Gw-xT97 Pear (920)
		- a

		30-$o-hk99 Peach (321)
		- ok
		- xz

		 Peach (321)
		- ok
		- xz

		03-AI-fez9 Pepper (31)
		- wz

		02-hy-nb81  (5)

		81-Xw-Le86 Watermelon ()
		- a
		- b

		99-eJ-rz01 Apple Pie (0)
		- oi
		- xz

		71-DU-jw55 Fish (-28)
		- zip
		- zam

		40-Sb-OL50 Pineapple (5.23)
		- foo
		- bar
	*/
?>