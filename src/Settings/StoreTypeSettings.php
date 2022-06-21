<?php /** @noinspection ALL */

namespace Ydistri\Settings;

use Ydistri\Enums\StoreGenerationType;

class StoreTypeSettings
{
    /**
     * All of these store types are going to be available.
     * It is possible to set up maximum count of stores for given type per region and project
     *
     * Definition:
     * ['Store type name' => [(int)region count, (int) project count ]
     * 0 means no maximum
     */

    const STORE_TYPE_LIST = [
        'E-commerce' => [0, 1],
        'Distribution centre' => [2, 0],
        'Hypermarket' => [2, 0],
        'Supermarket' => [10, 0],
        'Store (main road)' => [0, 0],
        'Store (2nd level road)' => [0, 0],
        'Store (small)' => [0, 0],
    ];


}