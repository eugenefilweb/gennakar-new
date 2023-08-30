<?php

namespace tests\unit\models;

use app\models\TransactionLog;

class TransactionLogTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'transaction_id' => 1,
            'status' => 1,
            'remarks' => 'Remarks',
            'record_status' => TransactionLog::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new TransactionLog($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => TransactionLog::RECORD_INACTIVE]);

        $model = new TransactionLog($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new TransactionLog();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new TransactionLog($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\TransactionLog', [
            'record_status' => TransactionLog::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\TransactionLog', [
            'record_status' => TransactionLog::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\TransactionLog', [
            'record_status' => TransactionLog::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\TransactionLog', [
            'record_status' => TransactionLog::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testTransactionIdInvalid()
    {
        $model = new TransactionLog($this->data(['transaction_id' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testTransactionIdNotExisting()
    {
        $model = new TransactionLog($this->data(['transaction_id' => 99999999]));
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testStatusInvalid()
    {
        $model = new TransactionLog($this->data(['status' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }

    public function testStatusNotExisting()
    {
        $model = new TransactionLog($this->data(['status' => 99999999]));
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }
}