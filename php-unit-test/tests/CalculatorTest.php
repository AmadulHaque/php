<?php

use PHPUnit\Framework\TestCase;
use App\Calculator;


class CalculatorTest extends TestCase {

    protected $calculator;

    public function setUp(): void {
        $this->calculator = new Calculator();
    }



    public function testAdd()
    {
       $result = $this->calculator->add(20, 10);
        $this->assertEquals(30, $result);
    }

    public function testSubtract()
    {
        $result = $this->calculator->subtract(20, 10);
        $this->assertEquals(10, $result);
    }



    public function testMultiply()
    {
        $result = $this->calculator->multiply(20, 10);
        $this->assertEquals(200, $result);
    }


    
}