<?php

namespace RDIFB0\P24ExchangeRate;

final class Rate
{
    /**
     * @var string
     */
    public $baseCurrency;
    /**
     * @var string
     */
    public $currency;
    /**
     * @var double
     */
    public $buy;
    /**
     * @var double
     */
    public $sale;

    public function __construct($baseCurrency, $currency, $buy, $sale)
    {
        $this->baseCurrency = $baseCurrency;
        $this->currency = $currency;
        $this->buy = $buy;
        $this->sale = $sale;
    }
}