<?php

use Entities\StaticHelpers;

require_once("vendor/autoload.php");

echo StaticHelpers::seeminglyRandomArrayGenerator(3, 10, 100);