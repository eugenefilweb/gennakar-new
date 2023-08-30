<?php

use app\models\Watershed;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'description' => 'Description',
		'map' => 'Map',
		'slug' => 'name',
		'record_status' => Watershed::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'name' => 'inactive',
	'slug' => 'inactive',
	'record_status' => Watershed::RECORD_INACTIVE
]);

return $model->getData();