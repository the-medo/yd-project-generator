<?php

use Entities\StaticHelpers;
use Entities\RegionGenerator;

require_once("vendor/autoload.php");

//echo StaticHelpers::seeminglyRandomArrayGenerator(3, 10, 100);


$regionGenerator = new RegionGenerator();
$regions = $regionGenerator->generateRegions();
foreach ($regions as $region) {
    echo $region;
}

// test comment