<?php

namespace Tests;

use MilesChou\Csphp\Policy;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeOkay()
    {
        $this->assertInstanceOf(Policy::class, Policy::create('scriptSrc'));
        $this->assertSame('scriptSrc', Policy::create('scriptSrc')->getResourceName());
    }
}
