<?php

namespace tests\unit\models;

use app\models\AmbulanceDispatchReport;

class AmbulanceDispatchReportTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
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
            'record_status' => AmbulanceDispatchReport::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new AmbulanceDispatchReport($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => AmbulanceDispatchReport::RECORD_INACTIVE]);

        $model = new AmbulanceDispatchReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new AmbulanceDispatchReport();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new AmbulanceDispatchReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\AmbulanceDispatchReport', [
            'record_status' => AmbulanceDispatchReport::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\AmbulanceDispatchReport', [
            'record_status' => AmbulanceDispatchReport::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\AmbulanceDispatchReport', [
            'record_status' => AmbulanceDispatchReport::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\AmbulanceDispatchReport', [
            'record_status' => AmbulanceDispatchReport::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}