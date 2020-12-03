<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-1-input.txt');

$expenses = array_map('intval', explode(PHP_EOL, $input));

for ($i = 0; $i < count($expenses); $i++) {
	for ($j = 0; $j < count($expenses); $j++) {
		if (($expenses[$i] + $expenses[$j]) === 2020) {
			echo "{$expenses[$i]} * {$expenses[$j]} = " . $expenses[$i] * $expenses[$j] . '<br>';
			break 2;
		}
	}
}
