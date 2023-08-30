<?php

namespace tests\unit\models;

use app\models\Barangay;
use app\models\Municipality;

class BarangayTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'Name',
            'municipality_id' => Municipality::getRealId(),
            'no' => 19,
            'record_status' => Barangay::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Barangay($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Barangay::RECORD_INACTIVE]);

        $model = new Barangay($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Barangay();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Barangay($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'record_status' => Barangay::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'name' => 'Tagumpay'
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'record_status' => Barangay::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'record_status' => Barangay::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testMunicipalityIdDontExist()
    {
        $model = new Barangay(['municipality_id' => 11111111]);
        expect_not($model->save());

        expect($model->errors)->hasKey('municipality_id');
    }

    public function testNameExisting()
    {
        $model = new Barangay([
            'name' => 'Poblacion I (Barangay 1)',
            'municipality_id' => Municipality::getRealId(),
        ]);

        expect_not($model->validate('name'));
        expect($model->errors)->hasKey('name');
    }

    public function testNameUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'name' => 'Poblacion I (Barangay 1)',
            'municipality_id' => Municipality::getRealId(),
        ]);

        expect_that($model->validate('name'));
    }

    public function testNoExisting()
    {
        $model = new Barangay([
            'no' => 1,
            'municipality_id' => Municipality::getRealId(),
        ]);

        expect_not($model->validate('no'));
        expect($model->errors)->hasKey('no');
    }

    public function testNoUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Barangay', [
            'municipality_id' => Municipality::getRealId(),
        ]);

        expect_that($model->validate('no'));
    }
}