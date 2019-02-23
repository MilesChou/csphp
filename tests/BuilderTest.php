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
    public function shouldReturnEmptyWhenBuildWithEmptyPolicies()
    {
        $this->assertSame('', $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallSetDefaultSrc()
    {
        $this->target->setDefaultSrc('*');

        $this->assertSame('default-src *', $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallSetScriptSrc()
    {
        $this->target->setScriptSrc("'self'");

        $this->assertSame("script-src 'self'", $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithManyPolicies()
    {
        $this->target->setDefaultSrc('*')
            ->setScriptSrc("'self'");

        $this->assertSame("default-src *; script-src 'self'", $this->target->build());
    }
}
