<?php

namespace Ydistri\Generators;

use Ydistri\Entities\Region;
use Ydistri\Helpers\A;
use Ydistri\Helpers\StaticHelpers;
use Ydistri\Settings\ProjectSettings;

class RegionGenerator
{
    static array $regionStores = [];
    static array $storeRegion = [];

    static array $regionNames = [];

    /**
     * @return Region[]
     */
    public function generateRegions(): array
    {
        $regions = [];
        for ($id = 1; $id <= self::getRegionCount(); $id++) {
            $regions[] = $this->getRegionById($id);
        }

        return $regions;
    }

    public static function getRegionById(int $id): Region
    {
        $randomizer = ($id * $id - $id);
        $array = A::MIN_3_MAX_10;

        $nameLength = $array[$randomizer % count($array)];
        $nameTemplate = StaticHelpers::getWordTemplate($nameLength, $randomizer);
        $name = StaticHelpers::getWordFromTemplate($nameTemplate, $randomizer);

        $code = 'R-' . $id . '-' . strtoupper(substr($name, 0, 3));

        return new Region($id, $code, $name);
    }

    public static function getRegionStoresCombinations(): void
    {
        if (count(self::$storeRegion) === 0) {
            for ($storeId = 1; $storeId <= ProjectSettings::STORE_COUNT; $storeId++) {
                $regionId = StoreGenerator::getStoreRegionId($storeId);
                self::$regionStores[$regionId][] = $storeId;
                self::$storeRegion[$storeId] = $regionId;
            }
        }
    }

    public static function getRegionStoreIds(int $regionId): array
    {
        self::getRegionStoresCombinations();
        return self::$regionStores[$regionId];
    }

    public static function getRegionStoreCount(int $regionId): int
    {
        self::getRegionStoresCombinations();
        return count(self::getRegionStoreIds($regionId));
    }


    public static function getRegionsFromSettings(): void
    {
        if (count(self::$regionNames) === 0) {
            $array = array_keys(ProjectSettings::REGIONS);
            $i = 0;
            foreach ($array as $regionName) {
                $i++;
                self::$regionNames[$i] = $regionName;
            }
        }
    }

    public static function getRegionCount(): int {
        self::getRegionsFromSettings();
        return count(self::$regionNames);
    }

}