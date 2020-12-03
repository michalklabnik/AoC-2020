<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-2-input.txt');

$lines = explode(PHP_EOL, $input);

$validPasswords = 0;
foreach ($lines as $line) {
	list($range, $char, $password) = explode(' ', $line);

	list($min, $max) = array_map('intval', explode('-', $range));
	$char = trim($char, ':');
	$passwordChars = str_split($password);

	$passwordCharCounter = 0;
	foreach ($passwordChars as $passwordChar) {
		if ($passwordChar === $char) {
			$passwordCharCounter++;
		}
	}

	if ($min <= $passwordCharCounter && $passwordCharCounter <= $max) {
		$validPasswords++;
	}
}

dump($validPasswords);
