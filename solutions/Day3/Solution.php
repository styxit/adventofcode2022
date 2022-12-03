<?php

namespace Solutions\Day3;

use Illuminate\Support\Collection;
use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    /**
     * Find the solution.
     */
    public function execute()
    {
        $backpacks = $this->input->collection()->mapInto(Backpack::class);

        $this->part1 = $backpacks
            ->map->getItemInAllCompartments()
            ->sum->value;

        $this->part2 = $backpacks
            ->chunk(3)
            ->map(function (Collection $group) {
                [$backpack1, $backpack2, $backpack3] = $group->values();
                $commonItems = array_intersect(
                    $backpack1->contents->toArray(),
                    $backpack2->contents->toArray(),
                    $backpack3->contents->toArray()
                );

                return Item::fromLetter(reset($commonItems));
            })
            ->sum->value;
    }
}
