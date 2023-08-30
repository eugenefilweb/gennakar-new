<?php

namespace app\commands\models;

use Yii;

class Role extends \app\models\Role
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
