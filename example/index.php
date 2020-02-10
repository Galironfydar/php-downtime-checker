<?php

use Galironfydar\PhpDowntimeChecker\Checker;

require __DIR__.'/../vendor/autoload.php';

$check = new Checker();

$url = 'http://duck.com';

echo "Is Down? : " . ($check->isDown($url) ? 'true' : 'false') . "\n";