<?php

namespace Entities;

class StoreTypeGenerator
{
    static array $stStores = [];
    static array $storeSt = [];

    /**
     * @return Region[]
     */
    public function generateStoreTypes(): array
    {
        $storeTypes = [];
        for ($id = 1; $id <= ProjectSettings::STORE_TYPE_COUNT; $id++) {
            $storeTypes[] = $this->getStoreTypeById($id);
        }

        return $storeTypes;
    }

    public static function getStoreTypeById(int $id): StoreType
    {
        $randomizer = ($id);
        $array = A::MIN_3_MAX_10;

        $nameLength = $array[$randomizer % count($array)];
        $nameTemplate = StaticHelpers::getWordTemplate($nameLength, $randomizer);
        $name = StaticHelpers::getWordFromTemplate($nameTemplate, $randomizer);

        $code = 'ST-' . $id . '-' . strtoupper(substr($name, 0, 3));

        return new StoreType($id, $code, $name);
    }

    public static function getStoreTypeStoresCombinations(): void
    {
        if (count(self::$storeSt) === 0) {
            for ($storeId = 1; $storeId <= ProjectSettings::STORE_COUNT; $storeId++) {
                $storeTypeId = StoreGenerator::getStoreStoreTypeId($storeId);
                self::$stStores[$storeTypeId][] = $storeId;
                self::$storeSt[$storeId] = $storeTypeId;
            }
        }
    }

    public static function getStoreTypeStoreIds(int $regionId): array
    {
        self::getStoreTypeStoresCombinations();
        return self::$stStores[$regionId];
    }

    public static function getStoreTypeStoreCount(int $storeId): int
    {
        self::getStoreTypeStoresCombinations();
        return count(self::getStoreTypeStoreIds($storeId));
    }

}