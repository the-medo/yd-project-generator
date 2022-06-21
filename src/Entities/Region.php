<?php

namespace Ydistri\Entities;

use Ydistri\Generators\RegionGenerator;

class Region {
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
    ) {}

    public function __toString(): string
    {
        return $this->id . ' [' . $this->code . '] ' . $this->name . ' [has ' . RegionGenerator::getRegionStoreCount($this->id) . ' stores]<br/>';
    }
}