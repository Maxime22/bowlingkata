<?php
declare(strict_types=1);

use App\Game;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    #[Test]
    public function scoreReturns9AfterOneRollOf9(): void
    {
        $game = new Game();
        $game->roll(9);
        $score = $game->score();
        $this->assertEquals(9, $score);
    }

    #[Test]
    public function scoreReturns8AfterOneRollOf7AndOneRollOf1(): void
    {
        $game = new Game();
        $game->roll(7);
        $game->roll(1);
        $score = $game->score();
        $this->assertEquals(8, $score);
    }

    #[Test]
    public function scoreReturns16AfterASpare(): void
    {
        $game = new Game();
        $game->roll(7);
        $game->roll(3);
        $game->roll(3);
        $score = $game->score();
        $this->assertEquals(16, $score);
    }

    #[Test]
    public function scoreReturns22AfterAStrike(): void
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(3);
        $game->roll(3);
        $score = $game->score();
        $this->assertEquals(22, $score);
    }

    #[Test]
    public function playerCannotLaunchAnotherTimeIfNoStrikeOrSpareAtLastTurn(): void
    {
        $this->expectException(\Exception::class);
        $game = new Game();
        for($i=0;$i<10;$i++){
            $game->roll(8);
            $game->roll(1);
        }
        $game->roll(1);
    }

    #[Test]
    public function playerCanLaunchAnotherTimeIfStrikeOrSpareAtLastTurn(): void
    {
        $game = new Game();
        for($i=0;$i<10;$i++){
            $game->roll(9);
            $game->roll(1);
        }
        $game->roll(9);
        $score = $game->score();
        $this->assertEquals(190, $score);
    }

    #[Test]
    public function scoreReturns300AfterPerfectGame(): void
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $game->roll(10);
        $score = $game->score();
        $this->assertEquals(300, $score);
    }


}