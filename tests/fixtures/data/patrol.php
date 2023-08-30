<?php

use app\models\Patrol;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'user_id' => 'User ID',
		'watershed' => 'Watershed',
		'coordinates' => 'Coordinates',
		'date' => 'Date',
		'notes' => 'Notes',
		'distance' => 'Distance',
		'record_status' => Patrol::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Patrol::RECORD_INACTIVE
]);

return $model->getData();