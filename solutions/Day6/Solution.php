<?php

namespace Solutions\Day6;

use Illuminate\Support\Collection;
use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    public const PACKET_MARKER_SIZE = 4;
    public const MESSAGE_MARKER_SIZE = 14;

    /**
     * Find the solution.
     */
    public function execute()
    {
        $letters = collect(str_split($this->input->collection()->first()));

        $this->part1 = $this->findUniqueWindowPosition($letters, self::PACKET_MARKER_SIZE);
        $this->part2 = $this->findUniqueWindowPosition($letters, self::MESSAGE_MARKER_SIZE);
    }

    /**
     * Find the first window that has all unique characters.
     *
     * @param Collection $letters    Collection of input letters.
     * @param int        $windowSize How big is the window?
     *
     * @return int The number of characters after which the unique window is found.
     */
    private function findUniqueWindowPosition(Collection $letters, int $windowSize): int
    {
        $uniqueWindow = $letters->sliding($windowSize)
            ->firstWhere(function (Collection $window) use ($windowSize) {
                return $windowSize === $window->unique()->count();
            });

        return $uniqueWindow->keys()->first() + $windowSize;
    }
}
