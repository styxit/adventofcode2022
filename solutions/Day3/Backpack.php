<?php

namespace Solutions\Day3;

use Illuminate\Support\Collection;

class Backpack
{
    public readonly Collection $contents;

    public function __construct($contents)
    {
        $this->contents = collect(str_split($contents));
    }

    public function getItemInAllCompartments(): Item
    {
        $compartments = $this->contents->split(2);
        $letter = $compartments->first()->intersect($compartments->last())->first();

        return Item::fromLetter($letter);
    }
}
