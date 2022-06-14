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

        $regionId = (A::MIN_0_MAX_10000[$id % count(A::MIN_0_MAX_10000)] % ProjectSettings::REGION_COUNT) + 1;

        return new Store($id, $code, $name, $regionId);
    }


}