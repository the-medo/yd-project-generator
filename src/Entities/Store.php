<?php

namespace Ydistri\Entities;

class Store {
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public int $regionId,
        public int $storeTypeId,
    ) {}

    public function __toString(): string
    {
        return $this->id . ' [' . $this->code . '] ' . $this->name . ' (Region: ' . $this->regionId . ') (StoreType: ' . $this->storeTypeId . ')<br/>';
    }
}