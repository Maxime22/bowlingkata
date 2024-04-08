<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{

    /** @test **/
    public function first(): void
    {
        $this->assertTrue(true);
    }


}