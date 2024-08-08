<?php
namespace App\Services\Enums;

class ShipmentStatusService
{
    const STATUSES = ['Pending', 'Progress', 'Done'];

    public static function getStatuses()
    {
        return self::STATUSES;
    }
}
