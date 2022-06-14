<?php

require __DIR__ . '/autoload.php';

$name = $_GET['controller'] ?? 'IndexController';
$class = 'App\Controllers\\' . $name;

session_start();
$controller = new $class;
$controller->dispatch();
