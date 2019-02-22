<?php

namespace Tests;

use MilesChou\Csphp\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Builder
     */
    private $target;

    protected function setUp()
    {
        parent::setUp();

        $this->target = new Builder();
    }

    protected function tearDown()
    {
        $this->target = null;

        parent::tearDown();
    }

    /**
     * @test
     */
    public function shouldBeOkay()
    {
        $this->assertInstanceOf(Builder::class, $this->target);
    }
}
