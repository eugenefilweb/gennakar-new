<?php

use app\models\EnvironmentalIncident;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'user_id' => 'User ID',
		'date_time' => 'Date Time',
		'longitude' => 'Longitude',
		'latitude' => 'Latitude',
		'watershed' => 'Watershed',
		'description' => 'Description',
		'additional_details' => 'Additional Details',
		'photos' => 'Photos',
		'record_status' => EnvironmentalIncident::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => EnvironmentalIncident::RECORD_INACTIVE
]);

return $model->getData();