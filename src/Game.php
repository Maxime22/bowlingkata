<?php
declare(strict_types=1);

namespace App;

class Game
{
    private array $rolls = [];
    private int $currentRoll = 0;

    public function roll(int $fallenPins): void
    {
        if ($this->isGameOver()) {
            throw new \Exception("Cannot roll after the game is over.");
        }

        $this->rolls[$this->currentRoll++] = $fallenPins;
    }

    private function isGameOver(): bool
    {
        if ($this->currentRoll >= 20) {
            if ($this->rolls[18] + $this->rolls[19] == 10 || $this->rolls[18] == 10) {
                return $this->currentRoll >= 21;
            }
            return true;
        }
        return false;
    }

    public function score(): int
    {
        $score = 0;
        $frameIndex = 0;
        for ($i = 0; $i < 10; $i++) {
            if ($this->isSpare($frameIndex)) {
                $score += 10 + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } elseif ($this->isStrike($frameIndex)) {
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex ++;
            } else {
                $score += $this->sumOfBallsInFrame($frameIndex);
                $frameIndex += 2;
            }
        }
        return $score;
    }

    public
    function isSpare($frameIndex): bool
    {
        return ($this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10);
    }

    public
    function isStrike($frameIndex): bool
    {
        return $this->rolls[$frameIndex] == 10;
    }

    private
    function sumOfBallsInFrame($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }

    private
    function spareBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 2];
    }

    private
    function strikeBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];
    }
}