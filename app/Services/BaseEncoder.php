<?php

namespace App\Services;

class BaseEncoder
{
    private $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function encode(int $id): string
    {
        $base = strlen($this->chars);
        $converted = "";
        $n = $id;
        while ($n > 0) {
            $converted = substr($this->chars, ($n % $base), 1) . $converted;
            $n = floor($n / $base);
        }
        return $converted;
    }
}
