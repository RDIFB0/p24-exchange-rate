<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use RDIFB0\P24ExchangeRate\Rate;
use RDIFB0\P24ExchangeRate\Rates;
use RDIFB0\P24ExchangeRate\RatesException;

class RatesTest extends TestCase
{
    /**
     * @var Rates
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Rates();
    }

    public function testGetCashRates()
    {
        $rates = $this->subject->getCashRates();

        $this->assertCount(3, $rates);
        $this->assertInstanceOf(Rate::class, $rates[0]);
    }

    public function testGetCashlessRates()
    {
        $rates = $this->subject->getCashlessRates();

        $this->assertCount(3, $rates);
        $this->assertInstanceOf(Rate::class, $rates[0]);
    }

    public function testGetInvalidRates()
    {
        $this->expectException(RatesException::class);
        $this->subject->getRates('invalid');
    }
}
