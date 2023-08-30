<?php

namespace tests\unit\models;

use app\models\VehicularAccidentReport;

class VehicularAccidentReportTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
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
            'record_status' => VehicularAccidentReport::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new VehicularAccidentReport($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => VehicularAccidentReport::RECORD_INACTIVE]);

        $model = new VehicularAccidentReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new VehicularAccidentReport();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new VehicularAccidentReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\VehicularAccidentReport', [
            'record_status' => VehicularAccidentReport::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\VehicularAccidentReport', [
            'record_status' => VehicularAccidentReport::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\VehicularAccidentReport', [
            'record_status' => VehicularAccidentReport::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\VehicularAccidentReport', [
            'record_status' => VehicularAccidentReport::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}