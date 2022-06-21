<?php

namespace Ydistri\Generators;

use Ydistri\Entities\Region;
use Ydistri\Enums\StoreGenerationType;
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
        self::getRegionStoresCombinations();

        $name = static::$regionNames[$id];
        $code = 'R-' . $id . '-' . strtoupper(substr($name, 0, 3));

        return new Region($id, $code, $name);
    }

    public static function getRegionStoresCombinations(): void
    {
        if (count(self::$storeRegion) === 0) {
            $regionStoreCountArray = [];
            $storeCount = StoreGenerator::getStoreCount();

            $id = 0;
            foreach (ProjectSettings::REGIONS as $regionName => $regionInfo) {
                static::$regionNames[++$id] = $regionName;
            }

            if (ProjectSettings::STORE_GENERATION_TYPE === StoreGenerationType::RegionContainsStoreCountForGivenRegion) {
                $i = 0;
                foreach (ProjectSettings::REGIONS as $regionStoreCount) {
                    $regionStoreCountArray[++$i] = $regionStoreCount;
                }
            } else if (ProjectSettings::STORE_GENERATION_TYPE === StoreGenerationType::RegionComparedToOtherRegionsAndStoreCountIsUsed) {
                $sum = array_sum(ProjectSettings::REGIONS);

                $total = 0;

                $i = 0;
                foreach (ProjectSettings::REGIONS as $regionSize) {
                    $i++;
                    $regionStoreCount = 0;

                    if ($i < $storeCount) {
                        $regionStoreCount = round($regionSize / $sum * $storeCount);
                    } else {
                        $regionStoreCount += $storeCount - $total;
                    }
                    $total += $regionStoreCount;

                    $regionStoreCountArray[$i] = $regionStoreCount;
                }
            }

            $regionStartStoreId = 1;
            $currentRegionId = 1;
            for ($storeId = 1; $storeId <= $storeCount; $storeId++) {
                if ($storeId > $regionStartStoreId + $regionStoreCountArray[$currentRegionId]) {
                    $regionStartStoreId += $regionStoreCountArray[$currentRegionId];
                    $currentRegionId++;
                }

                self::$regionStores[$currentRegionId][] = $storeId;
                self::$storeRegion[$storeId] = $currentRegionId;
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

    public static function getStoreRegionId(int $storeId): int
    {
        self::getRegionStoresCombinations();
        return static::$storeRegion[$storeId];
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