<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-9-input.txt');
$numbers = array_map('intval', explode(PHP_EOL, $input));

$preambleSum = 556543474;

for ($i = 0; $i < count($numbers); $i++) {
	$sum = $numbers[$i];
	for ($j = $i + 1; $j < count($numbers); $j++) {
		$sum += $numbers[$j];

		if ($sum === $preambleSum) {
			break 2;
		} else if ($sum > $preambleSum) {
			break;
		}
	}
}

$numbersRange = array_slice($numbers, $i, $j - $i);
$minMaxSum = min($numbersRange) + max($numbersRange);

dump($minMaxSum);
