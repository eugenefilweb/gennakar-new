<?php

use app\models\AmbulanceDispatchReport;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'date_time' => 'Date Time',
		'requester_name' => 'Requester Name',
		'requester_contact' => 'Requester Contact',
		'requester_relation' => 'Requester Relation',
		'patient_name' => 'Patient Name',
		'patient_contact' => 'Patient Contact',
		'patient_age' => 'Patient Age',
		'patient_gender' => 'Patient Gender',
		'incident_location' => 'Incident Location',
		'incident_nature' => 'Incident Nature',
		'incident_level' => 'Incident Level',
		'unit_id' => 'Unit ID',
		'dispatched_time' => 'Dispatched Time',
		'arrival_time' => 'Arrival Time',
		'departure_time' => 'Departure Time',
		'arrival_time_facility' => 'Arrival Time Facility',
		'patient_condition' => 'Patient Condition',
		'heart_rate' => 'Heart Rate',
		'blood_pressure' => 'Blood Pressure',
		'spo2' => 'Spo2',
		'description_of_symptoms' => 'Description Of Symptoms',
		'treatment_administered' => 'Treatment Administered',
		'facility_name' => 'Facility Name',
		'facility_contact' => 'Facility Contact',
		'facility_receiver' => 'Facility Receiver',
		'ert_names' => 'Ert Names',
		'roles' => 'Roles',
		'vehicle_id' => 'Vehicle ID',
		'vehicle_type' => 'Vehicle Type',
		'vehicle_mileage' => 'Vehicle Mileage',
		'notes' => 'Notes',
		'prepared_by' => 'Prepared By',
		'noted_by' => 'Noted By',
		'photos' => 'Photos',
		'attachments' => 'Attachments',
		'record_status' => AmbulanceDispatchReport::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => AmbulanceDispatchReport::RECORD_INACTIVE
]);

return $model->getData();