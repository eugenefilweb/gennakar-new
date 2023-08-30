<?php

use app\models\PdsEducation;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'pds_id' => 'Pds ID',
		'level' => 'Level',
		'name' => 'Name',
		'course' => 'Course',
		'from' => 'From',
		'to' => 'To',
		'highest_level' => 'Highest Level',
		'year_graduated' => 'Year Graduated',
		'academic_honor' => 'Academic Honor',
		'record_status' => PdsEducation::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => PdsEducation::RECORD_INACTIVE
]);

return $model->getData();