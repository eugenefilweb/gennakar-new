<?php

use app\models\HazardMap;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'type' => 'Type',
		'description' => 'Description',
		'photo' => 'Photo',
		'record_status' => HazardMap::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => HazardMap::RECORD_INACTIVE
]);

return $model->getData();