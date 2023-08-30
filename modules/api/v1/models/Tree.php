<?php

namespace app\modules\api\v1\models;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\helpers\Url;

class Tree extends \app\models\Tree
{
	public function fields()
    {
        $fields = parent::fields();
        $fields['ago'] = 'ago';
        $fields['tablePhotoUrl'] = fn($model) => Url::image($model->photos['fullheight'][0] ?? '', ['w' => 50], true);
        $fields['largePhotoUrl'] = fn($model) => Url::image($model->photos['fullheight'][0] ?? '', ['w' => 400], true);
        $fields['photoUrls'] = function ($model)  {
            $data = [];

            foreach (Tree::PHOTO_KEYS as $attribute => $label) {
                $data[$attribute] = App::foreach($model->photos[$attribute] ?? [], function ($token) {
                    return $token ? Url::image($token, ['w' => 400], true): '';
                }, false);
            }

            return $data;
        };

        return $fields;
    }

    public function getCanActivate()
    {
        return true;
    }
}