<?php

use app\models\Province;
use app\models\Region;
use yii\db\Expression;
use yii\helpers\Inflector;

$model = new \app\helpers\FixtureData(function($name) {
    return [
        'name' => $name,
        'region_id' => Region::getRegion4aId(),
        'no' => Province::CALABARZON,
        'record_status' => Province::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('QUEZON', 'QUEZON');
$model->add('test', 'test', [
    'no' => 101,
]);
$model->add('inactive', 'inactive', [
    'record_status' => Province::RECORD_INACTIVE,
    'no' => 98745564,
]);

return $model->getData();