<?php

namespace Solutions\Day5;

use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    /**
     * Find the solution.
     */
    public function execute()
    {
        // Split input into the stack of crates and the moves.
        [$stacks, $moves] = $this->input->collection()
            ->chunkWhile(function ($line) {
                return !empty($line);
            });

        // Cleanup after chunking.
        $stacks->pop();
        $moves->shift();

        // Convert move strings into array with instructions.
        $moves->transform(function ($moveString) {
            preg_match_all('/\d{1,2}/', $moveString, $matches);

            return [
                'amount' => (int) $matches[0][0],
                'from' => (int) $matches[0][1],
                'to' => (int) $matches[0][2],
            ];
        });

        // Turn each stack string into an array of crate letters (or space if no crate).
        $stacks->transform(function ($line) {
            // Prepend space so the 4th character is always the letter (or space when nothing is there).
            $line = ' '.$line;
            // Keep every 4th character.
            $stackString = preg_replace('/(.){3}(.){1}/', '\1', $line);
            // Split characters so it becomes an array.
            return str_split($stackString);
        });

        // Turn the vertical stacks in a horizontal array. Rotate 90 degrees clockwise.
        $horizontalStacks = [];
        $stacks
            ->reverse()
            ->each(function ($stackLine) use (&$horizontalStacks) {
                foreach ($stackLine as $stackKey => $stackLetter) {
                    if ($stackLetter !== ' ') {
                        $horizontalStacks[$stackKey + 1][] = $stackLetter;
                    }
                }
            });

        // Create two versions of the stacks, for puzzle part 1 and 2.
        $stackOne = $stackTwo = $horizontalStacks;
        unset($horizontalStacks, $stacks);

        // Execute the moves.
        foreach ($moves as $move) {
            $this->applyMove($stackOne, $move['from'], $move['to'], $move['amount'], true);
            $this->applyMove($stackTwo, $move['from'], $move['to'], $move['amount']);
        }

        $this->part1 = $this->getTopCratesString($stackOne);
        $this->part2 = $this->getTopCratesString($stackTwo);
    }

    /**
     * Get the top crate of each stack and combine them into a string.
     *
     * @param array $stacks
     *
     * @return string Combined letters of the top crates.
     */
    private function getTopCratesString($stacks): string
    {
        $topCrates = array_map(function ($stack) {
            return end($stack);
        }, $stacks);

        return implode($topCrates);
    }

    /**
     * Move one or more crates from one stack to another.
     *
     * The $oneByOne param defines in which way the crates are moved.
     * When moved one-by-one, on crate at the time is removed from the stack and added to the next.
     * This means the crates that are moved will now be in reversed order.
     *
     * When one-by-one is NOT used, all crates are moved at the same time, the order they are in is kept,
     * and they are applied to the next stack in the same order.
     *
     * @param array $stacks   Array of stacks.
     * @param int   $from     Which stack to remove crates from.
     * @param int   $to       To which stack should the crates be moved.
     * @param int   $amount   The number of crates to move.
     * @param bool  $oneByOne Should the crates be moved one-by-one or all at the same time?
     */
    private function applyMove(&$stacks, int $from, int $to, int $amount, $oneByOne = false)
    {
        // Extract the crates.
        $extract = array_splice($stacks[$from], -$amount);

        if ($oneByOne) {
            // When moved one-by-one the order should be reversed.
            $extract = array_reverse($extract);
        }

        // Apply extracted crates to the new stack.
        $stacks[$to] = array_merge($stacks[$to], $extract);
    }
}
