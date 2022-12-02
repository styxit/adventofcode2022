<?php

namespace Solutions\Day2;

enum Shape: int
{
    case ROCK = 1;

    case PAPER = 2;

    case SCISSORS = 3;

    public function beats(): Shape
    {
        return match ($this) {
            Shape::ROCK => Shape::SCISSORS,
            Shape::PAPER => Shape::ROCK,
            Shape::SCISSORS => Shape::PAPER,
        };
    }

    public static function fromLetter(string $letter): Shape
    {
        return match ($letter) {
            'A' => Shape::ROCK,
            'B' => Shape::PAPER,
            'C' => Shape::SCISSORS,
            'X' => Shape::ROCK,
            'Y' => Shape::PAPER,
            'Z' => Shape::SCISSORS,
        };
    }
}
