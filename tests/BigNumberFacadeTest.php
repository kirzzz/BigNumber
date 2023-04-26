<?php

require_once('../vendor/autoload.php');

use bignumber\src\BigNumberFacade;
use PHPUnit\Framework\TestCase;


class BigNumberFacadeTest extends TestCase
{
    protected BigNumberFacade $bigNumberFacadeTest;

    public function setUp(): void
    {
        $this->bigNumberFacadeTest = new BigNumberFacade('12345', '12345');
    }

    public function testAdd()
    {
        $val = $this->bigNumberFacadeTest->operation('+');
        $this->assertEquals('24690', $val->getValue());
    }

    public function testSubtract()
    {
        $val = $this->bigNumberFacadeTest->operation('-');
        $this->assertEquals('0', $val->getValue());
    }

    public function testMultiplications()
    {
        $val = $this->bigNumberFacadeTest->operation('*');
        $this->assertEquals('152399025', $val->getValue());
    }

    public function testDivisions()
    {
        $val = $this->bigNumberFacadeTest->operation('/');
        $this->assertEquals('1', $val->getValue());
    }
}