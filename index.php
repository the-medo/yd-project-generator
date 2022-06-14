<?php

use Entities\StaticHelpers;
use Entities\RegionGenerator;
use Entities\StoreGenerator;

require_once("vendor/autoload.php");

//echo StaticHelpers::seeminglyRandomArrayGenerator(3, 10, 100);


$regionGenerator = new RegionGenerator();
$regions = $regionGenerator->generateRegions();
foreach ($regions as $region) {
    echo $region;
}

echo '<hr/>';
echo StoreGenerator::getStoreById(587);
echo '<hr/>';

$storeGenerator = new StoreGenerator();
$stores = $storeGenerator->generateStores();
foreach ($stores as $store) {
    echo $store;
}

// test comment