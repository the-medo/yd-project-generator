<?php
require_once("vendor/autoload.php");

use Ydistri\Generators\RegionGenerator;
use Ydistri\Generators\StoreGenerator;
use Ydistri\Generators\StoreTypeGenerator;

date_default_timezone_set('UTC');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$storeTypeGenerator = new StoreTypeGenerator();
$storeTypes = $storeTypeGenerator->generateStoreTypes();

foreach ($storeTypes as $storeType) {
    echo $storeType;
}
echo '<hr/>';

$regionGenerator = new RegionGenerator();
$regions = $regionGenerator->generateRegions();
foreach ($regions as $region) {
    echo $region;
}

echo '<hr/>';

$storeGenerator = new StoreGenerator();
$stores = $storeGenerator->generateStores();
foreach ($stores as $store) {
    echo $store;
}