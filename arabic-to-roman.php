<?php
	/*
		This script is meant to be run from the command line.  It takes three optional arguments: a number to
		be converted from arabic $outputs to roman $outputs, a custom character for the number 1, and 
		a custom character for the number 5.
	*/
	
	$numToConvert = isset($argv[1]) ? $argv[1] : null;
	$customI = isset($argv[2]) ? $argv[2] : "I";
	$customV = isset($argv[3]) ? $argv[3] : "V";
	
	$ARparser = new ArabicToRoman($numToConvert, $customI, $customV);
	print $ARparser->convertAR();
	
	
	
	
	
	
	
	
	// Class to do the dirty work:
	
	class ArabicToRoman {
		protected $number = 0;
		protected $romanNumerals = array("M", "CM", "D", "CD", "C", "XC", "L", "XL", "X", "IX", "V", "IV", "I");
		protected $romanValues = array(1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1);
		
		public function __construct($number = null, $customI = null, $customV = null) {
			$this->setUp($number, $customI, $customV);
		}
		
		public function setUp($number = null, $customI = "I", $customV = "V") {
			// Check if the user supplied a number, if not use a random one.
			if ($number == null) {
				$number = rand(1, 1000);
			}
			$this->number = $number;
			// Replace the original numerals with custom ones.
			$this->romanNumerals[12] = $customI;
			$this->romanNumerals[11] = $customI . $customV;
			$this->romanNumerals[10] = $customV;
			$this->romanNumerals[9] = $customI . "X";
			// 
			// Check if the user supplied a custom character for 5, and if so replace the original.
			$this->romanNumerals[5] = $customV;
		}
		
		public function reset() {
			$this->romanNumerals[6] = "I";
			$this->romanNumerals[5] = "V";
		}
		
		public function convertAR() {
			// Use shorter name for variable
			$num = $this->number;
			// Variable to store the output
			$output = "";
			// Convert the number to Roman Numerals
			for ($i = 0; $i < count($this->romanValues); $i++) {
				// How many times the arabic number fits inside the current Roman Numeral
				$quotient = $num / $this->romanValues[$i];
				// The number left over
				$num = $num % $this->romanValues[$i];
				// Add current Roman values to the output
				$output .= str_repeat($this->romanNumerals[$i], $quotient);
			}
			//return $output;
			return strtoupper($output);
		}
	}
?>