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

$products = Models\ShopProduct::findAll();

foreach($products as $product) {
	if($data == $product->url) {
		$isAvailableLink = 0;
	}
}

echo($isAvailableLink);

?>