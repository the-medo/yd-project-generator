<?php

namespace Ydistri\Generators;

use Ydistri\Entities\Store;
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
        for ($id = 1; $id <= ProjectSettings::STORE_COUNT; $id++) {
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

        return new Store($id, $code, $name, $regionId);
    }

    public static function getStoreRegionId(int $storeId): int
    {
        return (A::MIN_0_MAX_10000[$storeId % count(A::MIN_0_MAX_10000)] % RegionGenerator::getRegionCount()) + 1;
    }

    public static function getStoreStoreTypeId(int $storeId): int
    {
        $storeTypeCount = StoreTypeGenerator::getStoreTypeCount();
        return (A::MIN_0_MAX_10000[($storeId * $storeTypeCount) % count(A::MIN_0_MAX_10000)] % $storeTypeCount) + 1;
    }

}