<?php

namespace tests\unit\models;

use app\models\Refbrgy;

class RefbrgyTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'brgyCode' => 'Brgy Code',
            'brgyDesc' => 'Brgy Desc',
            'regCode' => 'Reg Code',
            'provCode' => 'Prov Code',
            'citymunCode' => 'Citymun Code',
            'record_status' => Refbrgy::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Refbrgy($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Refbrgy::RECORD_INACTIVE]);

        $model = new Refbrgy($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Refbrgy();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Refbrgy($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Refbrgy', [
            'record_status' => Refbrgy::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Refbrgy', [
            'record_status' => Refbrgy::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Refbrgy', [
            'record_status' => Refbrgy::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Refbrgy', [
            'record_status' => Refbrgy::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}