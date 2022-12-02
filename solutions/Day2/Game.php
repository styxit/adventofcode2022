<?php

namespace Solutions\Day2;

class Game
{
    public static function play(Shape $myShape, Shape $opponentShape): int
    {
        $outcome = self::getOutcome($myShape, $opponentShape);

        return $outcome->value + $myShape->value;
    }

    private static function getOutcome(Shape $myShape, Shape $opponentShape): Outcome
    {
        // Same shape -> draw.
        if ($myShape === $opponentShape) {
            return Outcome::DRAW;
        }

        return $myShape->beats() === $opponentShape ? Outcome::WIN : Outcome::LOSE;
    }
}
