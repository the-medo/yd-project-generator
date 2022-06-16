<?php

namespace Entities;

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

        $name = self::$storeTypeNames[$id-1];

        $code = 'ST-' . $id . '-' . strtoupper(substr($name, 0, 3));

        return new StoreType($id, $code, $name);
    }

    public static function getStoreTypeStoresCombinations(): void
    {
        if (count(self::$storeSt) === 0) {
            self::getStoreTypesFromSettings();
            //go through project maximum

            $storeTypesToGoThrough = [
                'projectMaximum' => [],
                'regionMaximum' => [],
                'noMaximum' => [],
            ];

            for ($storeTypeId = 1; $storeTypeId <= count(ProjectSettings::STORE_TYPES); $storeTypeId++) {
                $storeTypeInto = ProjectSettings::STORE_TYPES[self::$storeTypeNames[$storeTypeId]];
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

            for ($i = 0; $i <= count($storeTypesToGoThrough['projectMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['projectMaximum'][$i];
                $storeTypeName = self::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }

            for ($i = 0; $i <= count($storeTypesToGoThrough['regionMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['regionMaximum'][$i];
                $storeTypeName = self::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }

            for ($i = 0; $i <= count($storeTypesToGoThrough['noMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['noMaximum'][$i];
                $storeTypeName = self::$storeTypeNames[$storeTypeId];
                $storeTypeInfo = ProjectSettings::STORE_TYPES[$storeTypeName];
            }




            /*for ($storeId = 1; $storeId <= ProjectSettings::STORE_COUNT; $storeId++) {
                $storeTypeId = StoreGenerator::getStoreStoreTypeId($storeId);
                self::$stStores[$storeTypeId][] = $storeId;
                self::$storeSt[$storeId] = $storeTypeId;
            }*/
        }
    }

    public static function getStoreTypesFromSettings(): void
    {
        if (count(self::$storeTypeNames) === 0) {
            $array = array_keys(ProjectSettings::STORE_TYPES);
            self::$storeTypeNames[] = '';
            foreach ($array as $storeTypeName) {
                self::$storeTypeNames[] = $storeTypeName;
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