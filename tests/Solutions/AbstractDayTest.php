<?php

namespace Tests\Solutions;

use PHPUnit\Framework\TestCase;

abstract class AbstractDayTest extends TestCase
{
    /**
     * Classname of the solution to test.
     * Should be overwritten by the test class.
     */
    protected static $class;

    /**
     * Assert solution.
     */
    public function testSolution()
    {
        $solution = $this->getSolutionClass();
        $solution->execute();

        $this->assertSame($this->solutionPart1, $solution->part1, 'Part 1 failed.');
        $this->assertSame($this->solutionPart2, $solution->part2, 'Part 2 failed.');
    }

    /**
     * Assert examples.
     */
    public function testExample()
    {
        $solution = $this->getSolutionClass();
        $solution->loadExampleInput();
        $solution->execute();

        $this->assertSame($this->exampleSolution1, $solution->part1, 'Example part 1 failed.');
        $this->assertSame($this->exampleSolution2, $solution->part2, 'Example part 2 failed.');
    }

    private function getSolutionClass()
    {
        $solutionClassName = str_replace(
            [
                'Tests',
                'Test',
            ],
            [
                '',
                '\Solution',
            ],
            $this::class
        );

        return new $solutionClassName();
    }
}
