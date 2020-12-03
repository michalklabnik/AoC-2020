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
	list($positions, $char, $password) = explode(' ', $line);

	list($pos1, $pos2) = array_map('intval', explode('-', $positions));
	$char = trim($char, ':');
	$passwordChars = str_split($password);

	$char1 = $passwordChars[$pos1 - 1];
	$char2 = $passwordChars[$pos2 - 1];

	if ($char1 === $char && $char2 !== $char) {
		$validPasswords++;
	}
	if ($char1 !== $char && $char2 === $char) {
		$validPasswords++;
	}
}

dump($validPasswords);
