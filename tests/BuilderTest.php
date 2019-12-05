<?php

namespace Tests;

use MilesChou\Csphp\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
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
            ->setImgSrc('https:')
            ->setMediaSrc('*')
            ->setFontSrc('*')
            ->setObjectSrc('*');

        $this->assertSame("default-src *; script-src 'self'; img-src https:; media-src *; font-src *; object-src *", $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallDefaultSrcWithCallAllowAny()
    {
        $this->target->defaultSrc()
            ->allowAll();

        $this->assertSame('default-src *', $this->target->build());
    }

    /**
     * @test
     */
    public function shouldBeOkayWithCallImgSrcAndScriptSrcAndStyleSrc()
    {
        $this->target->imgSrc()
            ->allowAll();

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
            ->allowAll()
            ->scriptSrc()
            ->allowUnsafeEval()
            ->styleSrc()
            ->allowSelf()
            ->mediaSrc()
            ->allowAll()
            ->fontSrc()
            ->allowAll()
            ->objectSrc()
            ->allowAll();

        $this->assertSame("img-src *; script-src 'unsafe-eval'; style-src 'self'; media-src *; font-src *; object-src *", $this->target->build());
    }
}
