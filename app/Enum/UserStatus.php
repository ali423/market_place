<?php

namespace App\Enum;

use ReflectionClass;

class UserStatus
{
    const ACTIVATE = "active";
    const DISABLE = "disable";

    static function getConstants() {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
