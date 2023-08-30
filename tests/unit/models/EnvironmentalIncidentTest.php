<?php

namespace tests\unit\models;

use app\models\EnvironmentalIncident;

class EnvironmentalIncidentTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'user_id' => 'User ID',
            'date_time' => 'Date Time',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'watershed' => 'Watershed',
            'description' => 'Description',
            'additional_details' => 'Additional Details',
            'photos' => 'Photos',
            'record_status' => EnvironmentalIncident::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new EnvironmentalIncident($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => EnvironmentalIncident::RECORD_INACTIVE]);

        $model = new EnvironmentalIncident($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new EnvironmentalIncident();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new EnvironmentalIncident($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EnvironmentalIncident', [
            'record_status' => EnvironmentalIncident::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EnvironmentalIncident', [
            'record_status' => EnvironmentalIncident::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\EnvironmentalIncident', [
            'record_status' => EnvironmentalIncident::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\EnvironmentalIncident', [
            'record_status' => EnvironmentalIncident::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}