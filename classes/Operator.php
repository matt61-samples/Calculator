<?php

/**
 * Operator to use in calculator
 */
class Operator {

	/**
	 * Native PHP operator
	 * @var string
	 */
	public $nativeIdentifier;
	
	/**
	 * Custom identifer for operator
	 * @var string
	 */
	public $customIdentifier;
	
	/**
	 * Construtor for operator
	 * @param type $nativeIdentifier
	 * @param type $customIdentifier
	 * @throws Exception
	 */
	public function __construct($nativeIdentifier, $customIdentifier) {
		$acceptableNativeIdentifiers = Array('+','-','*','/');
		if (!in_array($nativeIdentifier, $acceptableNativeIdentifiers)){
			throw new Exception("Bad identifier passed");
		}
		if (preg_match("/\s+/", $customIdentifier)){
			throw new Exception("Spaces not permitted in custom idenifier");
		}
		$this->nativeIdentifier = $nativeIdentifier;
		$this->customIdentifier = $customIdentifier;
	}
	
	/**
	 * Calculate result of 2 numbers using operator
	 * @param number $numberA
	 * @param number $numberB
	 * @return number
	 */
	public function calculate($numberA, $numberB){
		switch ($this->nativeIdentifier){
			case '+':
				return $numberA + $numberB;
			case '-':
				return $numberA - $numberB;
			case '*':
				return $numberA * $numberB;
			case '/':
				return $numberA / $numberB;
		}
	}
}
