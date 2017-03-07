<?php

namespace RDIFB0\P24ExchangeRate;

class Rates
{
    const BASE_URL = 'https://api.privatbank.ua/p24api/pubinfo';
    const TYPE_CASH = 'cash';
    const TYPE_CASHLESS = 'cashless';

    /**
     * Get cash exchange rates
     * @return Rate[]
     */
    public function getCashRates()
    {
        return $this->getRates(self::TYPE_CASH);
    }

    /**
     * get cashless exchange rates
     * @return Rate[]
     */
    public function getCashlessRates()
    {
        return $this->getRates(self::TYPE_CASHLESS);
    }

    /**
     * Get exchange rates
     * @param string $type
     * @return Rate[]
     * @throws \Exception
     */
    public function getRates($type)
    {
        $query = http_build_query([
            'json' => '',
            'exchange' => '',
            'coursid' => $this->getCoursId($type),
        ]);
        $url = self::BASE_URL . '?' . $query;

        $respJson = @file_get_contents($url);
        if ($respJson === false) {
            throw new RatesException('Failed access to privatbank API');
        }

        $resp = json_decode($respJson, true);

        $rates = [];
        foreach ($resp as $r) {
            $rate = new Rate($r['base_ccy'], $r['ccy'], (double)$r['buy'], (double)$r['sale']);
            $rates[] = $rate;
        }

        return $rates;
    }

    private function getCoursId($type)
    {
        static $courses = [
            self::TYPE_CASH => 5,
            self::TYPE_CASHLESS => 11,
        ];

        if (!isset($courses[$type])) {
            throw new RatesException('Course not found for type ' . $type);
        }

        return $courses[$type];
    }
}