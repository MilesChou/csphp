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
    public function shouldBeOkayWithCallSetStyleSrc()
    {
        $this->target->setStyleSrc("'self' http://example.com");

        $this->assertSame("style-src 'self' http://example.com", $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallSetImgSrc()
    {
        $this->target->setImgSrc('https:');

        $this->assertSame('img-src https:', $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithManyPolicies()
    {
        $this->target->setDefaultSrc('*')
            ->setScriptSrc("'self'")
            ->setImgSrc('https:');

        $this->assertSame("default-src *; script-src 'self'; img-src https:", $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallDefaultSrcWithCallAllowAny()
    {
        $this->target->defaultSrc()
            ->allowAny();

        $this->assertSame('default-src *', $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallImgSrcAndScriptSrcAndStyleSrc()
    {
        $this->target->imgSrc()
            ->allowAny();

        $this->target->scriptSrc()
            ->allowUnsafeEval();

        $this->target->styleSrc()
            ->allowSelf();

        $this->assertSame("img-src *; script-src 'unsafe-eval'; style-src 'self'", $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWhenCallImgSrcAndScriptSrcAndStyleSrcWithFluentCall()
    {
        $this->target->imgSrc()
            ->allowAny()
            ->scriptSrc()
            ->allowUnsafeEval()
            ->styleSrc()
            ->allowSelf();

        $this->assertSame("img-src *; script-src 'unsafe-eval'; style-src 'self'", $this->target->build());
    }
}
