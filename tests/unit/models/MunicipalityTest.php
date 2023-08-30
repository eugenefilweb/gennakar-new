<?php

namespace tests\unit\models;

use app\models\Province;
use app\models\Municipality;

class MunicipalityTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'Name101',
            'province_id' => Province::getCalabarzonId(),
            'no' => 100,
            'record_status' => Municipality::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Municipality($this->data());
        $model->save();
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Municipality::RECORD_INACTIVE]);

        $model = new Municipality($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Municipality();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Municipality($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'record_status' => Municipality::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'name' => 'test'
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'record_status' => Municipality::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'record_status' => Municipality::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testProvinceIdDontExist()
    {
        $model = new Municipality(['province_id' => 11111111]);
        expect_not($model->save());

        expect($model->errors)->hasKey('province_id');
    }

    public function testNameExisting()
    {
        $model = new Municipality([
            'name' => 'REAL',
            'province_id' => Province::getCalabarzonId(),
        ]);

        expect_not($model->validate('name'));
        expect($model->errors)->hasKey('name');
    }

    public function testNameUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'name' => 'REAL',
            'province_id' => Province::getCalabarzonId(),
        ]);

        expect_that($model->validate('name'));
    }

    public function testNoExisting()
    {
        $model = new Municipality([
            'no' => Municipality::MUNICIPALITY_REAL,
            'province_id' => Province::getCalabarzonId(),
        ]);

        expect_not($model->validate('no'));
        expect($model->errors)->hasKey('no');
    }

    public function testNoUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Municipality', [
            'no' => Municipality::MUNICIPALITY_REAL,
            'province_id' => Province::getCalabarzonId(),
        ]);

        expect_that($model->validate('no'));
    }
}