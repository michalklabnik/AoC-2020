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

$posX = $posY = 0;
$treeCounter = [];
// Right 1, down 1.
$posX = $posY = 0;
$treeCounter[0] = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter[0]++;
	}
	$posX += 1;
	$posY += 1;
}
// Right 3, down 1.
$posX = $posY = 0;
$treeCounter[1] = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter[1]++;
	}
	$posX += 3;
	$posY += 1;
}
// Right 5, down 1.
$posX = $posY = 0;
$treeCounter[2] = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter[2]++;
	}
	$posX += 5;
	$posY += 1;
}
// Right 7, down 1.
$posX = $posY = 0;
$treeCounter[3] = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter[3]++;
	}
	$posX += 7;
	$posY += 1;
}
// Right 1, down 2.
$posX = $posY = 0;
$treeCounter[4] = 0;
while ($posY < $linesCount) {
	if ($area[$posY][$posX] === '#') {
		$treeCounter[4]++;
	}
	$posX += 1;
	$posY += 2;
}

dump($treeCounter);

$multiplied = 1;
foreach ($treeCounter as $counter) {
	$multiplied *= $counter;
}

dump($multiplied);
