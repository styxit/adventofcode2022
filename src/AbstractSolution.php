<?php

namespace Styxit;

abstract class AbstractSolution
{
    /**
     * @var mixed The solution to part 1 of the day.
     */
    public int $part1 = 0;

    /**
     * @var mixed The solution to part 2 of the day.
     */
    public int $part2 = 0;

    /**
     * @var \Styxit\Input The input to pass to the solution.
     */
    public readonly Input $input;

    /**
     * @var string Define where all the inputs are located.
     */
    private string $inputRoot = __DIR__.'/../puzzles/';

    /**
     * AbstractSolution constructor.
     */
    public function __construct(bool $exampleInput = false)
    {
        $this->input = new Input($this->getInputFilePath($exampleInput));
    }

    /**
     * Get the input file based on the current Solution instance.
     *
     * @param bool $example Load example input.
     *
     * @return string The full path where the input file should be located.
     */
    private function getInputFilePath(bool $example = false)
    {
        // Explode the solutions namespace.
        $namespaceSections = explode('\\', get_class($this));

        // Extract the day from the solution namespace.
        $day = $namespaceSections[1];
        // Construct the full path to the input file.
        $inputFile = $example ? 'example.txt' : 'input.txt';

        return $this->inputRoot.$day.'/'.$inputFile;
    }
}
