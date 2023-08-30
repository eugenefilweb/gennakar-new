<?php

use app\models\Vehicle;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'plate_no' => 'Plate No',
		'class' => 'Class',
		'color' => 'Color',
		'make' => 'Make',
		'model' => 'Model',
		'year' => 'Year',
		'is_commercial' => 'Is Commercial',
		'driver_firstname' => 'Driver Firstname',
		'driver_middlename' => 'Driver Middlename',
		'driver_lastname' => 'Driver Lastname',
		'driver_suffix' => 'Driver Suffix',
		'driver_address' => 'Driver Address',
		'driver_email' => 'Driver Email',
		'driver_contact_no' => 'Driver Contact No',
		'driver_alt_contact_no' => 'Driver Alt Contact No',
		'company_name' => 'Company Name',
		'company_address' => 'Company Address',
		'company_contact_no' => 'Company Contact No',
		'type_of_cargo' => 'Type Of Cargo',
		'or_no' => 'Or No',
		'or_no_date_issued' => 'Or No Date Issued',
		'cr_no' => 'Cr No',
		'cr_no_date_issued' => 'Cr No Date Issued',
		'insurance_company' => 'Insurance Company',
		'insurance_type' => 'Insurance Type',
		'coverage_start_date' => 'Coverage Start Date',
		'coverage_end_date' => 'Coverage End Date',
		'insurance_status' => 'Insurance Status',
		'passengers' => 'Passengers',
		'driver_license_front' => 'Driver License Front',
		'driver_license_back' => 'Driver License Back',
		'or_photo' => 'Or Photo',
		'cr_photo' => 'Cr Photo',
		'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
		'record_status' => Vehicle::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Vehicle::RECORD_INACTIVE
]);

return $model->getData();