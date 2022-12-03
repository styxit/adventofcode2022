<?php

namespace Tests\Solutions;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
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
        $solution = $this->getSolutionClass(true);
        $solution->execute();

        $this->assertSame($this->exampleSolution1, $solution->part1, 'Example part 1 failed.');
        $this->assertSame($this->exampleSolution2, $solution->part2, 'Example part 2 failed.');
    }

    private function getSolutionClass(bool $withExampleInput = false)
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

        try {
            return new $solutionClassName($withExampleInput);
        } catch (FileNotFoundException $exception) {
            $this->markTestSkipped('Skipping test; Input unavailable.');
        }
    }
}
