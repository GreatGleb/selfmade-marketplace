<?php

require __DIR__ . '/autoload.php';

$url = $_SERVER['REQUEST_URI'];

$urlSubstr = mb_substr($url, 7, NULL, 'UTF-8');

if($urlSubstr === '' || $urlSubstr == 'home') {
	$controller = new \App\Controllers\Pages();
	$action = 'Index';
} else if($urlSubstr == 'profile') {
	$controller = new \App\Controllers\Profile();
	$action = 'Profile';
} else if($urlSubstr == 'account') {
	$controller = new \App\Controllers\Account();
	$action = 'Account';
} else if($urlSubstr == 'users') {
	$controller = new \App\Controllers\Pages();
	$action = 'Users';
} else if($urlSubstr == 'categories') {
	$controller = new \App\Controllers\Pages();
	$action = 'Categories';
} else if($urlSubstr == 'sellers') {
	$controller = new \App\Controllers\Pages();
	$action = 'Sellers';
} else if($urlSubstr == 'shops') {
	$controller = new \App\Controllers\Pages();
	$action = 'Shops';
} else if($urlSubstr == 'stockrooms') {
	$controller = new \App\Controllers\Pages();
	$action = 'Stockrooms';
} else if($urlSubstr == 'goods') {
	$controller = new \App\Controllers\Pages();
	$action = 'Goods';
} else if($urlSubstr == 'logout') {
	$controller = new \App\Controllers\Pages();
	$action = 'Logout';
} else {
	$controller = new \App\Controllers\Pages();
	$action = 'Index';
}

try {
    $controller->action($action);
} catch (\App\Exceptions\Core $e) {
    echo 'Возникло исключение приложения: ' . $e->getMessage();
} catch (PDOException $e) {
  echo 'Что-то не так с базой';
}