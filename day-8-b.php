<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-8-input.txt');

$bootCodeIngot = explode(PHP_EOL, $input);
$instructionCount = count($bootCodeIngot);

for ($i = 0; $i < $instructionCount; $i++) {
	list($op, $arg) = explode(' ', $bootCodeIngot[$i]);
	$bootCode = $bootCodeIngot;
	if ($op === 'acc') {
		continue;
	} else if ($op === 'jmp') {
		$bootCode[$i] = "nop ${arg}";
	} else if ($op === 'nop') {
		$bootCode[$i] = "jmp ${arg}";
	}

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
			if ($position >= $instructionCount) {
				dump($accumulator);
				exit;
			}
			continue;
		}

		if ($operation === 'jmp') {
			$position += $argument;
			if (in_array($position, $positionsVisited)) {
				break;
			}
			if ($position >= $instructionCount) {
				dump($accumulator);
				exit;
			}
			continue;
		}

		if ($operation === 'nop') {
			$position++;
			if (in_array($position, $positionsVisited)) {
				break;
			}
			if ($position >= $instructionCount) {
				dump($accumulator);
				exit;
			}
			continue;
		}
	}
}
