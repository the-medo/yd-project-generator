<?php
require_once("../../../vendor/autoload.php");

use Ydistri\Generators\StoreGenerator;

date_default_timezone_set('UTC');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$storeGenerator = new StoreGenerator();
$stores = $storeGenerator->generateStores();
foreach ($stores as $store) {
    echo $store;
}