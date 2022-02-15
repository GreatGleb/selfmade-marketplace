<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');
require_once realpath(__DIR__ . '/../../phpQuery/phpQuery/phpQuery.php');

use \phpQuery;
use App\Models;
use App\Models\Seller;
use App\MultiException;

$data = file_get_contents( "php://input" );
$data = json_decode( $data );

$urlNewShop = '/' . $data;

$pathToFile = realpath(__DIR__ . '/../../../App/templates/sitemap.php');

$page = file_get_contents($pathToFile);

$document = phpQuery::newDocument($page);

$objectLinks = $document->find('a[href]');
$isAvailableLink = 1;

foreach($objectLinks as $value) {
	if($urlNewShop == pq($value)->attr('href') ) {
		$isAvailableLink = 0;
	}
}
if ($urlNewShop == '/admin') {
	$isAvailableLink = 0;
} else if ($urlNewShop == '/categories') {
	$isAvailableLink = 0;
} else if ($urlNewShop == '/blog') {
	$isAvailableLink = 0;
}

$shops = Models\Shop::findAll();

foreach($shops as $shop) {
	if($data == $shop->url) {
		$isAvailableLink = 0;
	}
}

$brands = Models\ShopProductBrand::findAll();

foreach($brands as $brand) {
	if($data == $brand->url) {
		$isAvailableLink = 0;
	}
}

echo($isAvailableLink);

?>