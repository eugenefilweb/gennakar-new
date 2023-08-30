<?php

namespace app\modules\api\v1\models;

class HazardMap extends \app\models\HazardMap
{
    public function getCanActivate()
    {
        return true;
    }

    public static function watersheds()
    {
        return self::findAll(['type' => self::WATERSHED]);
    }
}