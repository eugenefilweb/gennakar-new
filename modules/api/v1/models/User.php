<?php

namespace app\modules\api\v1\models;

use Yii;
use app\modules\api\v1\helpers\Url;

class User extends \app\models\User
{
    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset(
            $fields['auth_key'], 
            $fields['password_hash'], 
            $fields['password_reset_token'],
            $fields['password_hint'],
        );

        $fields['userPhotoIcon'] = fn ($model) => Url::image($model->photo, ['w' => 30], true);
        $fields['userPhotoLink'] = fn ($model) => Url::image($model->photo, ['w' => 200], true);
        $fields['firstname'] = 'firstname';
        $fields['lastname'] = 'lastname';
        $fields['isDeveloper'] = 'isDeveloper';
        $fields['lastname_initial'] = fn ($model) => $model->lastname[0] ?? '';
        $fields['position'] = fn ($model) => $model->profile->position;


        return $fields;
    }
}