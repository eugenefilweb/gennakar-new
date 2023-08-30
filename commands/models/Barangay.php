<?php

namespace app\commands\models;

use Yii;

class Barangay extends \app\models\Barangay
{
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['created_at', 'updated_at'], 'safe'];
        return $rules;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['TimestampBehavior']);
        return $behaviors;
    }
}
