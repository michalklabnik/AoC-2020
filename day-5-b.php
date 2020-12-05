<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-5-input.txt');

$boardingPasses = explode(PHP_EOL, $input);

$seatIdsTaken = [];
foreach ($boardingPasses as $boardingPass) {
	$rowsFrom = 0;
	$rowsTo = 127;
	$columnsFrom = 0;
	$columnsTo = 7;

	$directions = str_split($boardingPass);
	foreach ($directions as $direction) {
		// Back
		if ($direction === 'B') {
			$rowsFrom = $rowsFrom + (int)ceil(($rowsTo - $rowsFrom) / 2);
		}
		// Front
		if ($direction === 'F') {
			$rowsTo = $rowsFrom + ((int)floor(($rowsTo - $rowsFrom) / 2));
		}

		// Left
		if ($direction === 'L') {
			$columnsTo = $columnsFrom + ((int)floor(($columnsTo - $columnsFrom) / 2));
		}
		// Right
		if ($direction === 'R') {
			$columnsFrom = $columnsFrom + (int)ceil(($columnsTo - $columnsFrom) / 2);
		}
	}

	$seatIdsTaken[] = $rowsFrom * 8 + $columnsFrom;
}

sort($seatIdsTaken);

$seatsAvailable = [];
for ($i = 0; $i <= max($seatIdsTaken); $i++) {
	if (!in_array($i, $seatIdsTaken)) {
		$seatsAvailable[] = $i;
	}
}
dump($seatsAvailable);
