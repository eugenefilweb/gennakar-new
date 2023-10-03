<?php

namespace app\modules\api\v1\models;

use app\models\Municipality;

class Barangay extends \app\models\Barangay
{
    public function getCanActivate()
    {
        return true;
    }

    public static function barangays()
    {
        return self::findAll(['municipality_id' => Municipality::MUNICIPALITY_GENERAL_NAKAR]);
    }
}