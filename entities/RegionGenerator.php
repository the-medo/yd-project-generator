<?php

namespace entities;

use Entities\A;
use Entities\StaticHelpers;
use Entities\Region;

class RegionGenerator
{

    /**
     * @return Region[]
     */
    public function generateRegions(): array
    {
        $regions = [];
        for ($i = 1; $i <= ProjectSettings::REGION_COUNT; $i++) {
            $regions[] = $this->generateRegion($i);
        }

        return $regions;
    }

    public function generateRegion(int $id): Region
    {
        $randomizer = ($id * $id - $id);
        $array = A::MIN_3_MAX_10;
        $nameLength = $array[$randomizer % count($array)];
        $nameTemplate = StaticHelpers::getWordTemplate($nameLength, $randomizer);

        $name = StaticHelpers::getWordFromTemplate($nameTemplate, $randomizer);
        $id = 'R-' . strtoupper(substr($name, 0, 3)) . '-' . $id;

        return new Region($id, $name);
    }
}