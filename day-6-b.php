<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$handle = fopen(__DIR__ . '/day-6-input.txt', 'r');
if (!$handle) {
	echo 'File trouble!';
	exit;
}

$questionsGrouped = [];
$questionsSum = $personsCount = 0;
while (($line = fgets($handle)) !== false) {
	$line = trim($line);

	if ($line !== '') {
		$personsCount++;
		$questions = str_split($line);
		foreach ($questions as $question) {
			if (!isset($questionsGrouped[$question])) {
				$questionsGrouped[$question] = 1;
			} else {
				$questionsGrouped[$question] += 1;
			}
		}
	} else {
		foreach ($questionsGrouped as $question => $questionsGroup) {
			if ($questionsGrouped[$question] < $personsCount) {
				unset($questionsGrouped[$question]);
			}
		}
		$questionsSum += count($questionsGrouped);
		$questionsGrouped = [];
		$personsCount = 0;
	}
}

foreach ($questionsGrouped as $question => $questionsGroup) {
	if ($questionsGrouped[$question] < $personsCount) {
		unset($questionsGrouped[$question]);
	}
}
$questionsSum += count($questionsGrouped);

fclose($handle);

dump($questionsSum);
