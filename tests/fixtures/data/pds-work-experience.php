<?php

use app\models\PdsWorkExperience;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'pds_id' => 'Pds ID',
		'from' => 'From',
		'to' => 'To',
		'position' => 'Position',
		'company' => 'Company',
		'salary' => 'Salary',
		'salary_increment' => 'Salary Increment',
		'appointment_status' => 'Appointment Status',
		'government_service' => 'Government Service',
		'record_status' => PdsWorkExperience::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => PdsWorkExperience::RECORD_INACTIVE
]);

return $model->getData();