<?php

//require_once dirname(__DIR__) . '/Controllers/PayU.php';
require_once __DIR__ . '/PayU.php';

//TODO Вынести в конфиг или базу данных
$payu = new PayU('', 'dvtgrfhy', 'c5+P3=GB6?h9#D2]0(9P');

$object = json_decode($_POST["orderJSON"]);

$order_pnames = $object->order_pnames;
$order_pninfos = $object->order_pninfos;

$order_pcodes = $object->order_pcodes;

$order_prices = $object->order_prices;

$order_qtys = $object->order_pnumbers;

$order_vats = [];
foreach($order_qtys as $qty) {
    $order_vats[] = 0;
}

$order_ptype = [];
foreach($order_qtys as $qty) {
    $order_ptype[] = "NET";
}


$order_mplcmerchant = $object->order_mplase_merchant;

$formData = $payu->initLiveUpdateFormData(array(
    // Данные заказа
    'ORDER_REF' => $object->clientOrderNumber,
    'ORDER_DATE' => date('Y-m-d H:i:s'),
    'ORDER_PNAME[]' => $order_pnames,
    'ORDER_PCODE[]' => $order_pcodes,
    'ORDER_PINFO[]' => $order_pninfos,
    'ORDER_PRICE[]' => $order_prices,
    'ORDER_QTY[]' => $order_qtys,
    'ORDER_VAT[]' => $order_vats,
    'PRICES_CURRENCY' => 'RUB',
    'PAY_METHOD' => $object->pay_method,
    'ORDER_PRICE_TYPE[]' => $order_ptype,
    'ORDER_MPLACE_MERCHANT[]' => $order_mplcmerchant,
    
    // Данные плательщика
    'BILL_FNAME' => $object->bill_fname,
    'BILL_LNAME' => $object->bill_lname,
    'BILL_EMAIL' => $object->bill_email,
    'BILL_PHONE' => $object->bill_phone,
    'BILL_ADDRESS' => $object->bill_city,
    'BILL_CITY' => $object->bill_city,
    //'BILL_COUNTRYCODE' => $object->bill_countrycode,
    
    'LANGUAGE' => 'RU',
    // Данные получателя
    //'DELIVERY_PHONE' => $object->bill_fname,
    
    'DEBUG' => 0,
    
    /*'TESTORDER' => 'FALSE',*/
), 'https://saterno.ru/successefulOrder', 'PAY_BY_CLICK');


function makeString ($name, $val)
{	
	if (!is_array($val)) 
		echo $name.'|,|'.htmlspecialchars($val).']]]';
	else
		foreach ($val as $v) makeString($name, $v);
}

foreach ($formData as $formDataKey => $formDataValue)
    makeString($formDataKey, $formDataValue);

?>