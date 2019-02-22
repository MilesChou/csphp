<?php

namespace Tests;

use MilesChou\Csphp\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
     */
    private $target;

    protected function setUp()
    {
        parent::setUp();

        $this->target = new Parser();
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
        $this->assertInstanceOf(Parser::class, $this->target);
    }
}
