<?php

namespace Ydistri\Generators;

use Ydistri\Entities\StoreType;
use Ydistri\Helpers\A;
use Ydistri\Settings\ProjectSettings;

class StoreTypeGenerator
{
    static array $stStores = [];
    static array $storeSt = [];

    static array $storeTypeNames = [];

    /**
     * @return StoreType[]
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

            $storeTypesToGoThrough = [
                'projectMaximum' => [],
                'regionMaximum' => [],
                'noMaximum' => [],
            ];

            for ($storeTypeId = 1; $storeTypeId <= count(ProjectSettings::STORE_TYPES); $storeTypeId++) {
                $storeTypeInfo = ProjectSettings::STORE_TYPES[static::$storeTypeNames[$storeTypeId]];
                $storeTypeProjectCount = $storeTypeInfo[1];
                $storeTypeRegionCount = $storeTypeInfo[0];

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
                $projectMaximum = ProjectSettings::STORE_TYPES[$storeTypeName][1];
                $storesSet = 0;

                if ($projectMaximum > 0) {
                    for ($storeId = 1; $storeId <= StoreGenerator::getStoreCount(); $storeId++) {
                        if (!isset(self::$storeSt[$storeId])) {
                            self::makeStoreAndStoreTypeCombination($storeId, $storeTypeId);
                            $storesSet++;
                            if ($storesSet === $projectMaximum) {
                                break;
                            }
                        }
                    }
                }
                unset($storesSet);
            }

            for ($i = 0; $i < count($storeTypesToGoThrough['regionMaximum']); $i++) {
                $storeTypeId = $storeTypesToGoThrough['regionMaximum'][$i];
                $storeTypeName = static::$storeTypeNames[$storeTypeId];
                $regionMaximum = ProjectSettings::STORE_TYPES[$storeTypeName][0];
                $storesSet = [];

                if ($regionMaximum > 0) {
                    for ($storeId = 1; $storeId <= StoreGenerator::getStoreCount(); $storeId++) {
                        $regionId = StoreGenerator::getStoreRegionId($storeId);

                        if (!isset(static::$storeSt[$storeId])) {
                            if (isset($storesSet[$regionId])) {
                                if ($storesSet[$regionId] >= $regionMaximum) {
                                    continue;
                                } else {
                                    self::makeStoreAndStoreTypeCombination($storeId, $storeTypeId);
                                    $storesSet[$regionId]++;
                                }
                            } else {
                                self::makeStoreAndStoreTypeCombination($storeId, $storeTypeId);
                                $storesSet[$regionId] = 1;
                            }
                        }
                    }
                }
                unset($storesSet);
            }

            $unassignedStoreCounter = 0;
            for ($storeId = 1; $storeId <= StoreGenerator::getStoreCount(); $storeId++) {
                if (!isset(static::$storeSt[$storeId])) {
                    $unassignedStoreCounter++;
                    $storeTypeId = $storeTypesToGoThrough['noMaximum'][($unassignedStoreCounter + A::MIN_0_MAX_1000[$storeId % count(A::MIN_0_MAX_1000)]) % count($storeTypesToGoThrough['noMaximum'])];
                    self::makeStoreAndStoreTypeCombination($storeId, $storeTypeId);
                }
            }
        }
    }

    public static function makeStoreAndStoreTypeCombination(int $storeId, int $storeTypeId): void
    {
        static::$stStores[$storeTypeId][] = $storeId;
        static::$storeSt[$storeId] = $storeTypeId;
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