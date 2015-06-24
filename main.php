<?php

require_once('classes/Calculator.php');
require_once('classes/Operator.php');

$calc = new Calculator;
$calc->operators[] = new Operator('+', 'blah');
$calc->loadEquation('1 + 1 * 2 + 4 / 2 * 5 blah 10');
$result = $calc->calculate();
echo $result."\n";
