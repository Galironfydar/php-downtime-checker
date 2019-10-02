<?php

require __DIR__.'/../vendor/autoload.php';

$check = new \Galironfydar\PhpDowntimeChecker\Checker();

$url = 'http://duck.com';


var_dump($check->isDown($url));