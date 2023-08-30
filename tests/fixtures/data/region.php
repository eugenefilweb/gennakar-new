<?php

use app\models\Country;
use app\models\Region;
use yii\db\Expression;
use yii\helpers\Inflector;

$model = new \app\helpers\FixtureData(function($name) {
    return [
       'name' => $name,
        'country_id' => Country::getPhilippinesId(),
        'no' => 4,
        'record_status' => Region::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('4a', 'IVA - SOUTHERN TAGALOG (CALABARZON)');
$model->add('test', 'test', [
    'no' => 101,
]);
$model->add('inactive', 'inactive', [
    'record_status' => Region::RECORD_INACTIVE,
    'no' => 98745564,
]);

return $model->getData();