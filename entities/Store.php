<?php

namespace Entities;

class Store {
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public int $regionId,
    ) {}

    public function __toString(): string
    {
        return $this->id . ' [' . $this->code . '] ' . $this->name . ' (Region: ' . $this->regionId . ')<br/>';
    }
}