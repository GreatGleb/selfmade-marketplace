<?php

namespace App\Controllers;

require realpath(__DIR__ . '/../../autoload.php');

use App\Models;
use App\MultiException;

\App\Models\PaidOrder::setValueToTable($_POST['orderNumber'], 'orderId', $_POST['orderId']);
\App\Models\PaidOrder::setValueToTable($_POST['orderNumber'], 'providerNumber', $_POST['providerNumber']);
\App\Models\PaidOrder::setValueToTable($_POST['orderNumber'], 'message', $_POST['message']);

echo 1;

?>