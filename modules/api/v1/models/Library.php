<?php

namespace app\modules\api\v1\models;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\helpers\Url;

class Library extends \app\models\Library
{
    public function fields()
    {
        $fields = parent::fields();
        $fields['tablePhotoUrl'] = fn($model) => Url::image($model->photo, ['w' => 50], true);
        $fields['galleryUrl'] = fn($model) => App::foreach($model->gallery, fn ($token) => Url::image($token, ['w' => 400], true), false);

        $fields['common_name'] = fn ($model) => App::formatter()->asUcWords($model->common_name);
        $fields['species'] = fn ($model) => App::formatter()->asUcWords($model->species);

        unset($fields['location_data']);

        return $fields;
    }
}