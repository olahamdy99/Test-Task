<?php

namespace App\Services\Enums;

class JournalTypeService
{
    const TYPES = ['Debit Cash', 'Credit Revenue', 'Credit Payable'];

    public static function getTypes()
    {
        return self::TYPES;
    }
}
