<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @testdox 2 + 2 = 4
     */
    public function testTwoPlusTwoIsFour(): void
    {
        $this->assertEquals(4, (2 + 2));
    }
}
