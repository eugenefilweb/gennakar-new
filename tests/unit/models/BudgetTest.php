<?php

namespace tests\unit\models;

use app\models\Budget;
use app\models\Transaction;

class BudgetTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'year' => 2012,
            'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
            'budget' => 5000,
            'record_status' => Budget::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = Budget::initial();
        $model->delete();

        $model = new Budget($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Budget::RECORD_INACTIVE]);

        $model = new Budget($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Budget();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Budget($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = Budget::initial();
        $model->delete();

        $model = $this->tester->grabRecord('app\models\Budget', [
            'record_status' => Budget::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Budget', [
            'record_status' => Budget::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = Budget::initial();
        $model->delete();

        $model = $this->tester->grabRecord('app\models\Budget', [
            'record_status' => Budget::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Budget', [
            'record_status' => Budget::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testTypeInvalid()
    {
        $model = new Budget($this->data([
            'type' => 9999
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('type');
    }

    public function testYearInvalid()
    {
        $model = new Budget($this->data([
            'year' => 99999
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('year');
    }

    public function testActionInvalid()
    {
        $model = new Budget($this->data([
            'action' => 99999
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('action');
    }

    public function testSpecificInvalid()
    {
        $model = new Budget($this->data([
            'specific_to' => 99999
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('specific_to');
    }

    public function testAlreadyHaveBudget()
    {
        $model = new Budget($this->data());
        expect_not($model->save());
        expect($model->errors)->hasKey('year');
    }
}