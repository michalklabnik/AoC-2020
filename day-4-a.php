<?php

declare(strict_types=1);

use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

$input = file_get_contents(__DIR__ . '/day-4-input.txt');

$handle = fopen(__DIR__ . '/day-4-input.txt', 'r');
if (!$handle) {
	echo 'File trouble!';
	exit;
}

$requiredFields = [
	'byr', // (Birth Year)
	'iyr', // (Issue Year)
	'eyr', // (Expiration Year)
	'hgt', // (Height)
	'hcl', // (Hair Color)
	'ecl', // (Eye Color)
	'pid', // (Passport ID)
	//'cid', // (Country ID)
];
sort($requiredFields);

$availableFields = [];
$validPasswords = 0;
while (($line = fgets($handle)) !== false) {
	$line = trim($line);

	if ($line !== '') {
		$elements = explode(' ', $line);
		foreach ($elements as $element) {
			list($key, $value) = explode(':', $element);
			$availableFields[] = $key;
		}
	} else {
		sort($availableFields);
		$diff = array_diff($requiredFields, $availableFields);
		if (empty($diff)) {
			$validPasswords++;
		}
		$availableFields = [];
	}
}

sort($availableFields);
$diff = array_diff($requiredFields, $availableFields);
if (empty($diff)) {
	$validPasswords++;
}

fclose($handle);

dump($validPasswords);
