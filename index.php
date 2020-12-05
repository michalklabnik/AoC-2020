<?php

declare(strict_types=1);

use Nette\Utils\Finder;
use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

Debugger::$strictMode = true;
Debugger::enable(Debugger::DEVELOPMENT, __DIR__ . '/log');

echo '<h1>Advent of Code 2020</h1>';

echo '<div><p><ul>';
foreach (Finder::findFiles('day-*-*.php')->from(__DIR__) as $key => $file) {
	echo '<li><a href="' . $file->getBasename() . '">' . $file->getBasename() . '</a></li>';
}
echo '</ul></p></div>';
