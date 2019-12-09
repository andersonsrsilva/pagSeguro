<?php

namespace App\Helpers;

class Helper
{
    public static function cpf(string $cpf)
    {
        return str_replace(['.', '-'], '', $cpf);
    }
}