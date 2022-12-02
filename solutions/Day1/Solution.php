<?php

namespace Solutions\Day1;

use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    /**
     * Find the solution.
     */
    public function execute()
    {
        $elves = $this->input->collection()
            // Make groups of food per elf.
            ->chunkWhile(function ($foodCalories) {
                return !empty($foodCalories);
            })
            // Turn food groups into summed calories.
            ->map(function ($elf) {
                return $elf->sum(function ($foodCalories) {
                    return (int) $foodCalories;
                });
            })
            ->sortDesc();

        $this->part1 = $elves->first();
        $this->part2 = $elves->take(3)->sum();
    }
}
