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

function validData(array $data): bool
{
	// byr (Birth Year) - four digits; at least 1920 and at most 2002.
	$byr = (int)$data['byr'];
	if ($byr < 1920 || $byr > 2002) {
		return false;
	}
	// iyr (Issue Year) - four digits; at least 2010 and at most 2020.
	$iyr = (int)$data['iyr'];
	if ($iyr < 2010 || $iyr > 2020) {
		return false;
	}
	// eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
	$eyr = (int)$data['eyr'];
	if ($eyr < 2020 || $eyr > 2030) {
		return false;
	}
	// hgt (Height) - a number followed by either cm or in:
	//   If cm, the number must be at least 150 and at most 193.
	//   If in, the number must be at least 59 and at most 76.
	$unit = substr($data['hgt'], -2);
	$hgt = substr($data['hgt'], 0, -2);
	if ($unit === 'cm') {
		if ($hgt < 150 || $hgt > 193) {
			return false;
		}
	} elseif ($unit === 'in') {
		if ($hgt < 59 || $hgt > 76) {
			return false;
		}
	} else {
		return false;
	}
	// hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
	if (substr($data['hcl'], 0, 1) === '#') {
		$hcl = substr($data['hcl'], 1);
		if (strlen($hcl) !== 6) {
			return false;
		} else {
			if (!ctype_xdigit($hcl)) {
				return false;
			}
		}
	} else {
		return false;
	}
	// ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
	if (!in_array($data['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
		return false;
	}
	// pid (Passport ID) - a nine-digit number, including leading zeroes.
	if (!(strlen($data['pid']) === 9 && ctype_digit($data['pid']))) {
		return false;
	}
	// cid (Country ID) - ignored, missing or not.

	return true;
}

$availableFields = [];
$validPasswords = 0;
while (($line = fgets($handle)) !== false) {
	$line = trim($line);

	if ($line !== '') {
		$elements = explode(' ', $line);
		foreach ($elements as $element) {
			list($key, $value) = explode(':', $element);
			$availableFields[$key] = $value;
		}
	} else {
		ksort($availableFields);
		$diff = array_diff($requiredFields, array_keys($availableFields));
		if (empty($diff) && validData($availableFields)) {
			$validPasswords++;
		}
		$availableFields = [];
	}
}

ksort($availableFields);
$diff = array_diff($requiredFields, array_keys($availableFields));
if (empty($diff) && validData($availableFields)) {
	$validPasswords++;
}

fclose($handle);

dump($validPasswords);
