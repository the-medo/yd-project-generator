<?php

namespace Ydistri\Enums;

enum StoreGenerationType: int {
    case RegionComparedToOtherRegionsAndStoreCountIsUsed = 1;
    case RegionContainsStoreCountForGivenRegion = 2;
}