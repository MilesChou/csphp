<?php

namespace Tests;

use MilesChou\Csphp\Policy;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeOkayWhenCastToString()
    {
        $this->assertSame('script-src', (string)Policy::create('script-src'));
    }
}
