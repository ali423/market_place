<?php

namespace App\Enum;

use ReflectionClass;

class SellerStatus
{
    const ACTIVATE = "active";
    const DISABLE = "disable";
    const PENDING = "pending";
    const WAITING = "waiting_approval";

    static function getConstants()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

}
