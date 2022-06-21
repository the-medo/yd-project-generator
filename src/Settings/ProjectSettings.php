<?php

namespace Ydistri\Settings;

class ProjectSettings
{

    /**
     * Possible values: 'FROM_REGIONS'
     */
    const STORE_GENERATION_TYPE = StoreSettings::STORE_GENERATION_TYPE;
    const REGIONS = RegionSettings::REGION_LIST;
    const STORE_COUNT = StoreSettings::STORE_COUNT;
    const STORE_TYPES = StoreTypeSettings::STORE_TYPE_LIST;

    const PRODUCT_COUNT = 40000;
    const BRAND_COUNT = 3000;
    const PRODUCT_LIST_COUNT = 100;

    const LOWEST_LEVEL_CATEGORY_COUNT = 400;
    const SKU_COUNT = 1000000;


}