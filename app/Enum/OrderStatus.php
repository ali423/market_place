<?php

namespace App\Enum;

use ReflectionClass;

class OrderStatus
{
    const WAITING = 'waiting';
    const PAID = 'paid';
    const REJECTED = 'rejected';
    const EXPIRED = 'expired';

    static function getConstants()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

}
