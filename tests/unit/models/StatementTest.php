<?php

namespace tests\unit\models;

use app\models\Statement;

class StatementTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
            'type' => 'Type',
            'name' => 'Name',
            'statement' => 'Statement',
            'date' => 'Date',
            'plate_no' => 'Plate No',
            'signature' => 'Signature',
            'position' => 'Position',
            'address' => 'Address',
            'contact_info' => 'Contact Info',
            'record_status' => Statement::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Statement($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Statement::RECORD_INACTIVE]);

        $model = new Statement($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Statement();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Statement($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Statement', [
            'record_status' => Statement::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Statement', [
            'record_status' => Statement::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Statement', [
            'record_status' => Statement::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Statement', [
            'record_status' => Statement::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}