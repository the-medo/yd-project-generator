<?php

namespace Entities;

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
        return RegionGenerator::getStoreRegionId($storeId);
    }

}