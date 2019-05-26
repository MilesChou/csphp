<?php

namespace Tests;

use MilesChou\Csphp\Builder;
use MilesChou\Csphp\Policy;

class PolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeOkayWhenCastToString()
    {
        $this->assertSame('', (string)Policy::create($this->getMock(Builder::class), 'script-src'));
    }

    /**
     * @test
     */
    public function shouldReturnSelfStringWhenCallAllowSelf()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowSelf();

        $this->assertSame("script-src 'self'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnUnsafeInlineStringWhenCallAllowUnsafeInline()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeInline();

        $this->assertSame("script-src 'unsafe-inline'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnUnsafeEvalStringWhenCallAllowUnsafeEval()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval();

        $this->assertSame("script-src 'unsafe-eval'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSelfStringAndUnsafeEvalStringWhenCallAllowUnsafeEvalAndAllowSelf()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval()
            ->allowSelf();

        $this->assertSame("script-src 'self' 'unsafe-eval'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnStarStringWhenCallAllowUnsafeEvalAndAllowSelfAndAllowAll()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval()
            ->allowSelf()
            ->allowAll();

        $this->assertSame('script-src *', (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnNoneStringWhenCallDenyAll()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval()
            ->allowSelf()
            ->denyAll();

        $this->assertSame("script-src 'none'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnNoneStringWhenCallAllowAllAndDenyAll()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowAll()
            ->denyAll();

        $this->assertSame("script-src 'none'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnStarStringWhenCallDenyAllAndAllowAll()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->denyAll()
            ->allowAll();

        $this->assertSame('script-src *', (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSamePolicyWhenCreateFromStarString()
    {
        $expectedPolicy = '*';

        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', $expectedPolicy);

        $this->assertSame("script-src ${expectedPolicy}", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSamePolicyWhenCreateFromNoneString()
    {
        $expectedPolicy = "'none'";

        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', $expectedPolicy);

        $this->assertSame("script-src ${expectedPolicy}", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSamePolicyWhenCreateFromSelfString()
    {
        $expectedPolicy = "'self'";

        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', $expectedPolicy);

        $this->assertSame("script-src ${expectedPolicy}", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnNoneWhenCreateFromComplexStringWithNoneString()
    {
        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', "* 'self' 'none'");

        $this->assertSame("script-src 'none'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnStarWhenCreateFromComplexStringWithStarString()
    {
        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', "* 'self' 'unsafe-eval'");

        $this->assertSame('script-src *', (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnComplexStringWhenCreateFromComplexStringWithStarString()
    {
        $actual = Policy::createFromString($this->getMock(Builder::class), 'script-src', "'self' 'unsafe-eval'");

        $this->assertSame("script-src 'self' 'unsafe-eval'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnComplexStringWhenCreateFromFullString()
    {
        $actual = Policy::createFromFullString($this->getMock(Builder::class), "script-src 'self' 'unsafe-eval'");

        $this->assertSame("script-src 'self' 'unsafe-eval'", (string)$actual);
    }
}
