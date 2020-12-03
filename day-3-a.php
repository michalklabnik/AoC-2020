<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-3-input.txt');

$lines = explode(PHP_EOL, $input);
$linesCount = count($lines);
$linesToMoveCount = (int) ceil($linesCount / 2);

$area = [];
foreach ($lines as $line) {
	$area[] = str_split(str_repeat($line, $linesToMoveCount));
}

$posX = $posY = $treeCounter = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter++;
	}
	$posX += 3;
	$posY++;
}

dump($treeCounter);
