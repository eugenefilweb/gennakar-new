<?php

namespace tests\unit\models;

use app\models\Watershed;

class WatershedTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'watershed Name',
            'description' => 'Description',
            'map' => 'Map',
            'record_status' => Watershed::RECORD_ACTIVE
        ], $replace);
    }

    public function testDuplicateName()
    {
        $model = new Watershed($this->data([
            'name' => 'Name'
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('name');
    }

    public function testCreateSuccess()
    {
        $model = new Watershed($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Watershed::RECORD_INACTIVE]);

        $model = new Watershed($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Watershed();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Watershed($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Watershed', [
            'record_status' => Watershed::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Watershed', [
            'record_status' => Watershed::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Watershed', [
            'record_status' => Watershed::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Watershed', [
            'record_status' => Watershed::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}