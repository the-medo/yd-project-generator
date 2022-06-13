<?php

namespace entities;

class Region {
    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public function __toString(): string
    {
        return $this->id . ' - ' . $this->name . '<br/>';
    }
}