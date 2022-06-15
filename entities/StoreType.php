<?php

namespace Entities;

class StoreType {
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
    ) {}

    public function __toString(): string
    {
        return $this->id . ' [' . $this->code . '] ' . $this->name . ' [has ' . StoreTypeGenerator::getStoreTypeStoreCount($this->id) . ' stores]<br/>';
    }
}