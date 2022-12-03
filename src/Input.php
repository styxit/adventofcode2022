<?php

namespace Styxit;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Collection;

class Input
{
    /**
     * @var string The plain text input.
     */
    private string $plain = '';

    /**
     * @var string The plain text input.
     */
    private array $lines = [];

    /**
     * Loader constructor.
     *
     * @param string $input The full path to the input file to load.
     */
    public function __construct($input)
    {
        if (!file_exists($input)) {
            throw new FileNotFoundException('Input file does not exists.');
        }

        $this->plain = trim(file_get_contents($input));
        $this->lines = explode(PHP_EOL, $this->plain);
    }

    /**
     * Input as an array.
     *
     * @return string[] The input separated by line.
     */
    public function lines()
    {
        return $this->lines;
    }

    /**
     * Undocumented function.
     *
     * @return Collection Collection with each line as an item.
     */
    public function collection()
    {
        return new Collection($this->lines());
    }

    /**
     * Get plain text input.
     *
     * @return string
     */
    public function plain()
    {
        return $this->plain;
    }
}
