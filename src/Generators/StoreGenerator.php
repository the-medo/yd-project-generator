<?php

namespace Ydistri\Generators;

use Ydistri\Entities\Store;
use Ydistri\Enums\StoreGenerationType;
use Ydistri\Helpers\A;
use Ydistri\Helpers\StaticHelpers;
use Ydistri\Settings\ProjectSettings;

class StoreGenerator
{

    /**
     * @return Store[]
     */
    public function generateStores(): array
    {
        $stores = [];
        for ($id = 1; $id <= self::getStoreCount(); $id++) {
            $stores[] = $this->getStoreById($id);
        }

        return $stores;
    }

    public static function getStoreById(int $id): Store
    {
        $randomizer = ($id);
        $array = A::MIN_4_MAX_12;

        $nameLength = $array[$randomizer % count($array)];
        $nameTemplate = StaticHelpers::getWordTemplate($nameLength, $randomizer);
        $name = StaticHelpers::getWordFromTemplate($nameTemplate, $randomizer);

        $code = 'S-' . $id . '-' . strtoupper(substr($name, 0, 3));

        $regionId = self::getStoreRegionId($id);
        $storeTypeId = self::getStoreStoreTypeId($id);

        return new Store($id, $code, $name, $regionId, $storeTypeId);
    }

    public static function getStoreRegionId(int $storeId): int
    {
        return RegionGenerator::getStoreRegionId($storeId);
    }

    public static function getStoreStoreTypeId(int $storeId): int
    {
        return StoreTypeGenerator::getStoreStoreTypeId($storeId);
    }

    public static function getStoreCount(): int {
        if (ProjectSettings::STORE_GENERATION_TYPE === StoreGenerationType::RegionComparedToOtherRegionsAndStoreCountIsUsed) {
            return ProjectSettings::STORE_COUNT;
        } else if (ProjectSettings::STORE_GENERATION_TYPE === StoreGenerationType::RegionContainsStoreCountForGivenRegion) {
            return array_sum(ProjectSettings::REGIONS);
        }
        return 0;
    }

}