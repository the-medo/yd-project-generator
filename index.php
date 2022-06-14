<?php

use Entities\RegionGenerator;
use Entities\StoreGenerator;

require_once("vendor/autoload.php");

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