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
    public function shouldReturnSelfStringWhenCallAllowUnsafeInline()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeInline();

        $this->assertSame("script-src 'unsafe-inline'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSelfStringWhenCallAllowUnsafeEval()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval();

        $this->assertSame("script-src 'unsafe-eval'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSelfStringWhenCallAllowUnsafeEvalAndAllowSelf()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval()
            ->allowSelf();

        $this->assertSame("script-src 'self' 'unsafe-eval'", (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnSelfStringWhenCallAllowUnsafeEvalAndAllowSelfAndAllowAny()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->allowUnsafeEval()
            ->allowSelf()
            ->allowAny();

        $this->assertSame('script-src *', (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnNoneStringWhenCallDenyAll()
    {
        $actual = Policy::create($this->getMock(Builder::class), 'script-src')
            ->denyAll();

        $this->assertSame("script-src 'none'", (string)$actual);
    }
}
