<?php

namespace tests\unit\models;

use app\models\PdsOrganization;

class PdsOrganizationTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'pds_id' => 'Pds ID',
            'name' => 'Name',
            'address' => 'Address',
            'from' => 'From',
            'to' => 'To',
            'no_of_hours' => 'No Of Hours',
            'position' => 'Position',
            'record_status' => PdsOrganization::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new PdsOrganization($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PdsOrganization::RECORD_INACTIVE]);

        $model = new PdsOrganization($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PdsOrganization();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PdsOrganization($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsOrganization', [
            'record_status' => PdsOrganization::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsOrganization', [
            'record_status' => PdsOrganization::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsOrganization', [
            'record_status' => PdsOrganization::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsOrganization', [
            'record_status' => PdsOrganization::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}