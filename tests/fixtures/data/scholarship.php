<?php

use app\models\Scholarship;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'first_name' => 'First Name',
		'middle_name' => 'Middle Name',
		'last_name' => 'Last Name',
		'name_suffix' => 'Name Suffix',
		'birth_date' => 'Birth Date',
		'age' => 'Age',
		'course' => 'Course',
		'barangay_id' => 'Barangay ID',
		'street_address' => 'Street Address',
		'email' => 'Email',
		'alternate_email' => 'Alternate Email',
		'contact_no' => 'Contact No',
		'alternate_contact_no' => 'Alternate Contact No',
		'house_no' => 'House No',
		'guardian' => 'Guardian',
		'first_enrollment' => 'First Enrollment',
		'expected_graduation' => 'Expected Graduation',
		'current_year_level' => 'Current Year Level',
		'school_name' => 'School Name',
		'subjects' => 'Subjects',
		'units' => 'Units',
		'documents' => 'Documents',
		'photo' => 'Photo',
		'record_status' => Scholarship::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Scholarship::RECORD_INACTIVE
]);

return $model->getData();