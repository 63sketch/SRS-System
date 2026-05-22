<?php

namespace App\Support;

class Money
{
    /**
     * Round for tax calculation (HALF_DOWN).
     */
    public static function roundTax(float $amount): float
    {
        return round($amount, 2, PHP_ROUND_HALF_DOWN);
    }

    /**
     * Round for net salary calculation (HALF_UP).
     */
    public static function roundNet(float $amount): float
    {
        return round($amount, 2, PHP_ROUND_HALF_UP);
    }
}
