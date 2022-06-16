<?php

namespace Entities;

class ProjectSettings
{
    const REGION_COUNT = 30;

    const STORE_COUNT = 1000;

    /** ['Store type name' => [(int)region count, (int) project count ] */
    const STORE_TYPES = [
        'E-commerce' => [0, 1],
        'Distribution centre' => [2, 0],
        'Hypermarket' => [2, 0],
        'Supermarket' => [10, 0],
        'Store (main road)' => [0, 0],
        'Store (2nd level road)' => [0, 0],
        'Store (small)' => [0, 0],
    ];

    const PRODUCT_COUNT = 40000;
    const BRAND_COUNT = 3000;
    const PRODUCT_LIST_COUNT = 100;

    const LOWEST_LEVEL_CATEGORY_COUNT = 400;
    const SKU_COUNT = 1000000;


}