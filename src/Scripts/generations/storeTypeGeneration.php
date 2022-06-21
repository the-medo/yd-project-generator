<?php
require_once("../../../vendor/autoload.php");

use Ydistri\Generators\StoreTypeGenerator;

date_default_timezone_set('UTC');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$storeTypeGenerator = new StoreTypeGenerator();
$storeTypes = $storeTypeGenerator->generateStoreTypes();
foreach ($storeTypes as $storeType) {
    echo $storeType;
}