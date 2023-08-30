<?php

use app\models\Passenger;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'last_name' => 'Last Name',
		'middle_name' => 'Middle Name',
		'first_name' => 'First Name',
		'address' => 'Address',
		'email' => 'Email',
		'contact_no' => 'Contact No',
		'alternate_contact_no' => 'Alternate Contact No',
		'age' => 'Age',
		'sex' => 'Sex',
		'health_condition' => 'Health Condition',
		'medical_complaint' => 'Medical Complaint',
		'condition' => 'Condition',
		'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
		'vehicle_id' => 'Vehicle ID',
		'record_status' => Passenger::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Passenger::RECORD_INACTIVE
]);

return $model->getData();