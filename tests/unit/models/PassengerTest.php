<?php

namespace tests\unit\models;

use app\models\Passenger;

class PassengerTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
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
            'record_status' => Passenger::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Passenger($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Passenger::RECORD_INACTIVE]);

        $model = new Passenger($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Passenger();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Passenger($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Passenger', [
            'record_status' => Passenger::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Passenger', [
            'record_status' => Passenger::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Passenger', [
            'record_status' => Passenger::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Passenger', [
            'record_status' => Passenger::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}