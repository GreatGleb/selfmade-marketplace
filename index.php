<?php

require __DIR__ . '/autoload.php';

$url = $_SERVER['REQUEST_URI'];

$urlSubstr = mb_substr($url, 1, NULL, 'UTF-8');

$sleshPos = strpos($urlSubstr, "/");
$urlBeforeSlesh = mb_substr($urlSubstr, 0, $sleshPos, 'UTF-8');
$urlAfterSlesh = mb_substr($urlSubstr, $sleshPos+1, NULL, 'UTF-8');

if($urlSubstr === '' || $urlSubstr == 'home') {
	$controller = new \App\Controllers\Pages();
	$action = 'Index';
} else if($urlSubstr == 'about') {
	$controller = new \App\Controllers\Pages();
	$action = 'About';
} else if($urlSubstr == 'delivery') {
	$controller = new \App\Controllers\Pages();
	$action = 'Delivery';
} else if($urlSubstr == 'types-of-delivery') {
	$controller = new \App\Controllers\Pages();
	$action = 'TypesOfDelivery';
} else if($urlSubstr == 'cooperation') {
	$controller = new \App\Controllers\Pages();
	$action = 'Cooperation';
} else if($urlSubstr == 'contacts') {
	$controller = new \App\Controllers\Pages();
	$action = 'Contacts';
} else if($urlSubstr == 'requisites') {
	$controller = new \App\Controllers\Pages();
	$action = 'Requisites';
} else if($urlSubstr == 'foreign-suppliers') {
	$controller = new \App\Controllers\Pages();
	$action = 'ForeignSuppliers';
} else if($urlSubstr == 'faq') {
	$controller = new \App\Controllers\Pages();
	$action = 'FAQ';
} else if($urlSubstr == 'payment') {
	$controller = new \App\Controllers\Pages();
	$action = 'Payment';
} else if($urlSubstr == 'online-payment-guarantee') {
	$controller = new \App\Controllers\Pages();
	$action = 'OnlinePaymentGuarantee';
} else if($urlSubstr == 'garantiya') {
	$controller = new \App\Controllers\Pages();
	$action = 'Garantiya';
} else if($urlSubstr == 'terms') {
	$controller = new \App\Controllers\Pages();
	$action = 'Terms';
} else if($urlSubstr == 'privacy') {
	$controller = new \App\Controllers\Pages();
	$action = 'Privacy';
} else if($urlSubstr == 'sitemap') {
	$controller = new \App\Controllers\Pages();
	$action = 'Sitemap';
} else if($urlSubstr == 'contact-with-us') {
	$controller = new \App\Controllers\Pages();
	$action = 'ContactWithUs';
} else if($urlSubstr == 'refund') {
	$controller = new \App\Controllers\Pages();
	$action = 'Refund';
}  else if($urlSubstr == 'categories' || $urlBeforeSlesh == 'categories') {
	$controller = new \App\Controllers\Categories();
	if($urlSubstr == 'categories') {
		$controller->url = "";
	} else {
		$controller->url = $urlAfterSlesh;
	}
	
	$action = 'Show';
} else if($urlSubstr == 'checkout') {
	$controller = new \App\Controllers\Pages();
	$action = 'Checkout';
} else if($urlSubstr == 'successefulOrder' || strripos($urlSubstr, 'successefulOrder') !== false) {
	$controller = new \App\Controllers\Pages();
	$action = 'SuccessefulOrder';
} else if($urlSubstr == 'account') {
	$controller = new \App\Controllers\Pages();
	$action = 'Account';
} else if($urlSubstr == 'registration') {
	$controller = new \App\Controllers\Pages();
	$action = 'Registration';
} else if($urlSubstr == 'login') {
	$controller = new \App\Controllers\Pages();
	$action = 'Login';
} else if($urlSubstr == 'logout') {
	$controller = new \App\Controllers\Pages();
	$action = 'Logout';
} else {
	$controller = new \App\Controllers\Pages();
	$controller->cellUrl = $urlSubstr;
	$controller->beforeSlashUrl = $urlBeforeSlesh;
	$controller->afterSlashUrl = $urlAfterSlesh;
	
	$action = 'Else';
}

try {
    $controller->action($action);
} catch (\App\Exceptions\Core $e) {
    echo 'Возникло исключение приложения: ' . $e->getMessage();
} catch (PDOException $e) {
  echo 'Что-то не так с базой';
}


//var_dump($urlSubstr);
