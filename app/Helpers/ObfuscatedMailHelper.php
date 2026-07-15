<?php

namespace App\Helpers;

class ObfuscatedMailHelper
{
    public static function encode(string $value): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($value));
    }

    public static function decode(string $value): string
    {
        $padding = strlen($value) % 4;
        if ($padding) {
            $value .= str_repeat('=', 4 - $padding);
        }

        $value = str_replace(['-', '_'], ['+', '/'], $value);

        return base64_decode($value);
    }
}
