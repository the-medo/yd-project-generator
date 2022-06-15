<?php

use Entities\RegionGenerator;
use Entities\StoreGenerator;
use Entities\StoreTypeGenerator;

require_once("vendor/autoload.php");

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