<?php

use app\models\VehicularAccidentReport;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'control_no' => 'Control No',
		'code' => 'Code',
		'latitude' => 'Latitude',
		'longitude' => 'Longitude',
		'main_cause' => 'Main Cause',
		'vehicles_involved' => 'Vehicles Involved',
		'photos' => 'Photos',
		'other_damages' => 'Other Damages',
		'collision_type' => 'Collision Type',
		'weather_condition' => 'Weather Condition',
		'road_condition' => 'Road Condition',
		'barangay' => 'Barangay',
		'landmarks' => 'Landmarks',
		'road_type' => 'Road Type',
		'remarks' => 'Remarks',
		'preferred_by' => 'Preferred By',
		'noted_by' => 'Noted By',
		'date' => 'Date',
		'sketch' => 'Sketch',
		'record_status' => VehicularAccidentReport::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => VehicularAccidentReport::RECORD_INACTIVE
]);

return $model->getData();