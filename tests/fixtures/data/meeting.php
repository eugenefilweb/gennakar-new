<?php

use app\models\Meeting;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'description' => 'Description',
		'remarks' => 'Remarks',
		'minutes' => 'Minutes',
		'minutes_files' => 'Minutes Files',
		'attendance' => 'Attendance',
		'attendance_files' => 'Attendance Files',
		'resolutions' => 'Resolutions',
		'resolutions_file' => 'Resolutions File',
		'photos' => 'Photos',
		'record_status' => Meeting::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Meeting::RECORD_INACTIVE
]);

return $model->getData();