<?php
use PHPUnit\Framework\TestCase;
use Amadul\TestingPhp\Calculator;

class CalculatorTest   extends TestCase
{
    public function testCanAdd()
    {
        $calculator  = new Calculator();
        $sum = $calculator->addNumber(50,60);
        $this->assertSame(120, $sum); 
    }







    
}