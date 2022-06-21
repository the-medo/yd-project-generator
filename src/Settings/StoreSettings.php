<?php /** @noinspection ALL */

namespace Ydistri\Settings;

use Ydistri\Enums\StoreGenerationType;

class StoreSettings
{
//    const STORE_GENERATION_TYPE = StoreGenerationType::RegionComparedToOtherRegionsAndStoreCountIsUsed;
    const STORE_GENERATION_TYPE = StoreGenerationType::RegionContainsStoreCountForGivenRegion;

    const STORE_COUNT = 1000;

}