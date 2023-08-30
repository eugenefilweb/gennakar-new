<?php

namespace tests\unit\models;

use app\models\LocalGovernmentUnit;

class LocalGovernmentUnitTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'lgu_name' => 'Lgu Name',
            'lgu_address' => 'Lgu Address',
            'lgu_classification' => 'Lgu Classification',
            'lgu_region' => 'Lgu Region',
            'name' => 'Name',
            'position' => 'Position',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'date_of_assessment' => 'Date Of Assessment',
            'date_submitted' => 'Date Submitted',
            'record_status' => LocalGovernmentUnit::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new LocalGovernmentUnit($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => LocalGovernmentUnit::RECORD_INACTIVE]);

        $model = new LocalGovernmentUnit($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new LocalGovernmentUnit();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new LocalGovernmentUnit($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\LocalGovernmentUnit', [
            'record_status' => LocalGovernmentUnit::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\LocalGovernmentUnit', [
            'record_status' => LocalGovernmentUnit::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\LocalGovernmentUnit', [
            'record_status' => LocalGovernmentUnit::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\LocalGovernmentUnit', [
            'record_status' => LocalGovernmentUnit::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}