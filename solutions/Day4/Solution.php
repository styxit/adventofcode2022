<?php

namespace Solutions\Day4;

use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    /**
     * Find the solution.
     */
    public function execute()
    {
        // Turn each line into an array of two pairs.
        // Each pair is an array with a 'min' and 'max'.
        $pairs = $this->input->collection()
            ->map(function ($pairString) {
                $pairs = explode(',', $pairString);

                return array_map(function ($pair) {
                    [$min, $max] = explode('-', $pair);

                    return ['min' => (int) $min, 'max' => (int) $max];
                }, $pairs);
            });

        // Solution to part 1; Only keep pairs that fully overlap.
        $this->part1 = $pairs
            ->filter(function ($pair) {
                return $this->pairOverlap($pair[0], $pair[1], true);
            })
            ->count();

        // Solution to part 2; Keep pairs that (fully or partially) overlap.
        $this->part2 = $pairs
            ->filter(function ($pair) {
                return $this->pairOverlap($pair[0], $pair[1]);
            })
            ->count();
    }

    private function pairOverlap($pairA, $pairB, $fullOverlap = false)
    {
        $lastKey = $fullOverlap ? 'max' : 'min';

        if ($pairA['min'] <= $pairB['min'] && $pairA['max'] >= $pairB[$lastKey]) {
            return true;
        }

        // Check the other way around.
        return $pairB['min'] <= $pairA['min'] && $pairB['max'] >= $pairA[$lastKey];
    }
}
