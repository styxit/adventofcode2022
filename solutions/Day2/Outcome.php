<?php

namespace Solutions\Day2;

enum Outcome: int
{
    case LOSE = 0;

    case DRAW = 3;

    case WIN = 6;

    public static function fromLetter(string $letter): Outcome
    {
        return match ($letter) {
            'X' => Outcome::LOSE,
            'Y' => Outcome::DRAW,
            'Z' => Outcome::WIN,
        };
    }
}
