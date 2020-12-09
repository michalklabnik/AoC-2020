<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-9-input.txt');
$input = array_map('intval', explode(PHP_EOL, $input));

$preambleInit = 25;
$preamble = array_slice($input, 0, $preambleInit);
$numbers = array_splice($input, $preambleInit);

function isValidNextNumber(int $number, array $preamble): bool {
	for ($i = 0; $i < count($preamble); $i++) {
		for ($j = $i + 1; $j < count($preamble); $j++) {
			if ($preamble[$i] + $preamble[$j] === $number) {
				return true;
			}
		}
	}

	return false;
}

foreach ($numbers as $number) {
	if (!isValidNextNumber($number, $preamble)) {
		dump($number);
		exit;
	}
	array_shift($preamble);
	$preamble[] = array_shift($numbers);
}
