<?php

namespace app\models\form\setting;

use Yii;
use app\modules\api\v1\helpers\Url;

class MobileAppSettingForm extends SettingForm
{
    const NAME = 'mobile-app-settings';

    public $coordinate_frequency_tracking;
    public $coordinate_radius_tracking;
    public $app_name;
    public $icon;
    public $login_background;
    public $photos_per_category;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['coordinate_frequency_tracking', 'coordinate_radius_tracking', 'app_name'], 'required'],
            [['coordinate_frequency_tracking', 'coordinate_radius_tracking'], 'integer', 'min' => 0],
            [['photos_per_category'], 'integer', 'min' => 1],
            [['app_name'], 'string', 'max' => 128],
            [['icon', 'login_background'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'coordinate_frequency_tracking' => 'Coordinate Frequency Tracking (seconds)',
            'coordinate_radius_tracking' => 'Coordinate Radius Tracking (meters)',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['iconUrl'] = fn ($model) => Url::image($model->icon, ['w' => 73], true);
        $fields['loginBackgroundUrl'] = fn ($model) => Url::image($model->login_background, ['w' => 500], true);

        return $fields;
    }

    public function default()
    {
        return [
            'login_background' => [
                'name' => 'login_background',
                'default' => 'token-default-image_200'
            ],
            'icon' => [
                'name' => 'icon',
                'default' => 'token-default-image_200'
            ],
            'app_name' => [
                'name' => 'app_name',
                'default' => 'GAWA'
            ],
            'coordinate_frequency_tracking' => [
                'name' => 'coordinate_frequency_tracking',
                'default' => 10 // seconds
            ],
            'coordinate_radius_tracking' => [
                'name' => 'coordinate_radius_tracking',
                'default' => 5 // meters
            ],
            'photos_per_category' => [
                'name' => 'photos_per_category',
                'default' => 4 // meters
            ],
        ];
    }
}