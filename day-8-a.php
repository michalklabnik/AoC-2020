<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-8-input.txt');

$bootCode = explode(PHP_EOL, $input);

$position = $accumulator = 0;
$positionsVisited = [];
while (true) {
	$positionsVisited[] = $position;

	list($operation, $argument) = explode(' ', $bootCode[$position]);

	if ($operation === 'acc') {
		$accumulator += $argument;
		$position++;
		if (in_array($position, $positionsVisited)) {
			break;
		}
		continue;
	}

	if ($operation === 'jmp') {
		$position += $argument;
		if (in_array($position, $positionsVisited)) {
			break;
		}
		continue;
	}

	if ($operation === 'nop') {
		$position++;
		if (in_array($position, $positionsVisited)) {
			break;
		}
		continue;
	}
}

dump($accumulator);
