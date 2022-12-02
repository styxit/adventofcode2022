<?php

namespace Solutions\Day2;

use Styxit\AbstractSolution;

class Solution extends AbstractSolution
{
    /**
     * Find the solution.
     */
    public function execute()
    {
        $this->part1 = $this->input->collection()
            ->map(function ($roundInput) {
                return Game::play(
                    Shape::fromLetter($roundInput[-1]),
                    Shape::fromLetter($roundInput[0])
                );
            })
            ->sum();

        $this->part2 = $this->input->collection()
            ->map(function ($roundInput) {
                $opponentShape = Shape::fromLetter($roundInput[0]);
                $expectedOutcome = Outcome::fromLetter($roundInput[-1]);
                $myShape = $this->getShapeForOutcome($opponentShape, $expectedOutcome);

                return Game::play(
                    $myShape,
                    $opponentShape
                );
            })
            ->sum();
    }

    /**
     * Find which shape to use to ensure the wanted outcome.
     *
     * @param Shape   $opponent The shape opponent is playing.
     * @param Outcome $outcome  The wanted outcome.
     *
     * @return Shape The shape to play.
     */
    private function getShapeForOutcome(Shape $opponent, Outcome $outcome): Shape
    {
        return match ($outcome) {
            Outcome::DRAW => $opponent,
            Outcome::LOSE => $opponent->beats(),
            Outcome::WIN => $opponent->beats()->beats(),
        };
    }
}
