<?php

/**
 * Calculator object
 * 
 * Does the calculations
 */
class Calculator {
	
	/**
	 * Operators available in calculator
	 * @var array
	 */
	public $operators = Array();
	
	/**
	 * Stored equation for processing
	 * @var array
	 */
	private $equation = Array();
	
	/**
	 * Constructor
	 */
	public function __construct() {		
		//Set up default operators, order of operation is preserved.
		$this->operators = Array(
			new Operator('*', '*'),
			new Operator('/', '/'),
			new Operator('+', '+'),
			new Operator('-', '-')
		);
	}
	
	/**
	 * Check if a passed operator exists in operators array
	 * @param type $passedOperator
	 * @return boolean
	 */
	private function hasOperator($passedOperator){
		foreach($this->operators as $operator){
			if ($operator->customIdentifier == $passedOperator){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Parse and validate equation
	 * @param type $equationString
	 * @throws Exception
	 */
	public function loadEquation($equationString){
		$equationItems = explode(" ", $equationString);
		if (count($equationItems) % 2 == 0){
			throw new Exception ("Equation has invalid number of items.");
		}
		for($i=0;$i<count($equationItems);$i++){
			if ($i % 2 == 0 && !is_numeric($equationItems[$i])){
				throw new Exception("Invalid operator: ".$equationItems[$i]);
			}
			if ($i % 2 == 1 && !$this->hasOperator($equationItems[$i])){
				throw new Exception("Invalid number: ".$equationItems[$i]);
			}
			$this->equation[] = $equationItems[$i];		
		}
	}
	
	/**
	 * Calculate answer
	 * @return numeric
	 */
	public function calculate(){
		$currentEquation = $this->equation;
		foreach($this->operators as $operator){
			while (in_array($operator->customIdentifier, $currentEquation)){
				for($i=0;$i<count($currentEquation);$i++){
					if ($currentEquation[$i] == $operator->customIdentifier){
						$calculated = $operator->calculate($currentEquation[$i-1], $currentEquation[$i+1]);
						$currentEquation = array_merge(array_slice($currentEquation, 0, $i-1), Array($calculated), array_slice($currentEquation, $i+2));
						break;
					}
				}
			}
		}
		return $currentEquation[0];
	}
	
}