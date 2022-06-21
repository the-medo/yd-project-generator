<?php
require_once("../../vendor/autoload.php");

use Ydistri\Enums\CardinalDirectionType;
use Ydistri\Enums\WrapType;
use Ydistri\Helpers\A;
use Ydistri\Helpers\StaticHelpers;

date_default_timezone_set('UTC');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$baseRegionNames = [
    'Vustrya',
    'Scoisau',
    'Espeau',
    'Teswora',
    'Swey Whos',
    'Efren',
    'Oshos',
];

$cardinalDirectionArray = StaticHelpers::getCardinalDirectionArray(CardinalDirectionType::SecondaryInterCardinal16);
$cardinalDirectionArray = StaticHelpers::getCardinalDirectionArray(CardinalDirectionType::InterCardinal8);
$regionNames = StaticHelpers::combineArraysIntoNames($baseRegionNames, $cardinalDirectionArray, WrapType::Parentheses);

$i = 0;
foreach ($regionNames as $region) {
    echo '\'' . $region . '\' => ' . A::MIN_0_MAX_1000[$i] . ',<br>';
    $i++;
}