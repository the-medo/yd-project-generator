<?php

namespace Ydistri\Generators;

use Ydistri\Entities\Region;
use Ydistri\Entities\StoreType;
use Ydistri\Settings\ProjectSettings;

class StoreTypeGenerator
{
    static array $stStores = [];
    static array $storeSt = [];

    static array $storeTypeNames = [];

    /**
     * @return Region[]
     */
    public function generateStoreTypes(): array
    {
        $storeTypes = [];
        for ($id = 1; $id <= count(ProjectSettings::STORE_TYPES); $id++) {
            $storeTypes[] = $this->getStoreTypeById($id);
        }

        return $storeTypes;
    }

    public static function getStoreTypeById(int $id): StoreType
    {
        self::getStoreTypesFromSettings();

        $name = static::$storeTypeNames[$id];

        $code = 'ST-' . $id . '-' . strtoupper(substr($name, 0, 3));

        return new StoreType($id, $code, $name);
    }

    public static function getStoreTypeStoresCombinations(): void
    {
        if (count(static::$storeSt) === 0) {
            self::getStoreTypesFromSettings();
            //go through project maximum


            $storeTypesToGoThrough = [
                'projectMaximum' => [],
                'regionMaximum' => [],
                'noMaximum' => [],
            ];



            for ($storeTypeId = 1; $storeTypeId <= count(ProjectSettings::STORE_TYPES); $storeTypeId++) {
                $storeTypeInto = ProjectSettings::STORE_TYPES[static::$storeTypeNames[$storeTypeId]];
                $storeTypeProjectCount = $storeTypeInto[1];
                $storeTypeRegionCount = $storeTypeInto[0];

                if ($storeTypeProjectCount > 0) {
                    $storeTypesToGoThrough['projectMaximum'][] = $storeTypeId;
                } else if ($storeTypeRegionCount > 0) {
                    $storeTypesToGoThrough['regionMaximum'][] = $storeTypeId;
                } else {
                    $storeTypesToGoThrough['noMaximum'][] = $storeTypeId;
                }
            }



            for ($i = 0; $i < count($storeTypesToGoThrough['projectMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['projectMaximum'][$i];
                $storeTypeName = static::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }

            for ($i = 0; $i < count($storeTypesToGoThrough['regionMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['regionMaximum'][$i];
                $storeTypeName = static::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }

            for ($i = 0; $i < count($storeTypesToGoThrough['noMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['noMaximum'][$i];
                $storeTypeName = static::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }




            /*for ($storeId = 1; $storeId <= ProjectSettings::STORE_COUNT; $storeId++) {
                $storeTypeId = StoreGenerator::getStoreStoreTypeId($storeId);
                self::$stStores[$storeTypeId][] = $storeId;
                self::$storeSt[$storeId] = $storeTypeId;
            }*/
        }
    }
    public static function getStoreTypeStoreIds(int $regionId): array
    {
        self::getStoreTypeStoresCombinations();
        return static::$stStores[$regionId] ?? [];
    }

    public static function getStoreTypeStoreCount(int $storeId): int
    {
        self::getStoreTypeStoresCombinations();
        return count(static::getStoreTypeStoreIds($storeId));
    }


    public static function getStoreTypesFromSettings(): void
    {
        if (count(static::$storeTypeNames) === 0) {
            $array = array_keys(ProjectSettings::STORE_TYPES);
            $i = 0;
            foreach ($array as $storeTypeName) {
                $i++;
                static::$storeTypeNames[$i] = $storeTypeName;
            }
        }
    }

    public static function getStoreTypeCount(): int {
        self::getStoreTypesFromSettings();
        return count(static::$storeTypeNames);
    }
}