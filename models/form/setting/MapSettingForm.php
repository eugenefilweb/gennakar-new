<?php

namespace app\models\form\setting;

use Yii;

class MapSettingForm extends SettingForm
{
    const NAME = 'map-settings';

    /* EMAIL */
    public $url;
    public $param_name;
    public $key;

    public $longitude;
    public $latitude;
    public $altitude;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['url', 'param_name', 'key', 'longitude', 'latitude', 'altitude'], 'required'],
            [['url', 'param_name', 'key', 'longitude', 'latitude', 'altitude'], 'string', 'max' => 225],
        ];
    }

    public function default()
    {
        return [
            'url' => [
                'name' => 'url',
                'default' => 'https://maps.googleapis.com/maps/api/js'
            ],
            'param_name' => [
                'name' => 'param_name',
                'default' => 'key'
            ],
            'key' => [
                'name' => 'key',
                'default' => 'AIzaSyDDsziO7yBi_o0dmCucMAUgqUKp8o3ldNY'
            ],
            'longitude' => [
                'name' => 'longitude',
                'default' => 121.0457006883423
            ],
            'latitude' => [
                'name' => 'latitude',
                'default' => 14.352017583753188
            ],
            'altitude' => [
                'name' => 'altitude',
                'default' => 14.352017583753188
            ]
        ];
    }
}