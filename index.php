<?php

session_start();
require __DIR__ . '/autoload.php';

$name = $_GET['controller'] ?? 'IndexController';
$class = 'App\Controllers\\' . $name;

$controller = new $class;
$controller->dispatch();
