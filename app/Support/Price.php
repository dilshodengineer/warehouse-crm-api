<?php

namespace App\Support;

class Price 
{
    public static function parse ($value): int
    {
        return (int) str_replace(' ', '', (string) $value);
    }
}