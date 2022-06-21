<?php

use Ydistri\Helpers\StaticHelpers;

require_once("vendor/autoload.php");

echo StaticHelpers::seeminglyRandomArrayGenerator(3, 10, 100);