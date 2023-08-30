<?php

namespace tests\unit\models;

use app\models\Region;
use app\models\Country;

class RegionTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'Name',
            'country_id' => Country::getPhilippinesId(),
            'no' => 495,
            'record_status' => Region::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Region($this->data());
        $model->save();
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Region::RECORD_INACTIVE]);

        $model = new Region($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Region();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Region($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'record_status' => Region::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'name' => 'test'
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'record_status' => Region::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'record_status' => Region::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testCountryIdDontExist()
    {
        $model = new Region(['country_id' => 11111111]);
        expect_not($model->save());

        expect($model->errors)->hasKey('country_id');
    }

    public function testNameExisting()
    {
        $model = new Region([
            'name' => 'IVA - SOUTHERN TAGALOG (CALABARZON)',
            'country_id' => Country::getPhilippinesId()
        ]);

        expect_not($model->validate('name'));
        expect($model->errors)->hasKey('name');
    }

    public function testNameUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'name' => 'IVA - SOUTHERN TAGALOG (CALABARZON)',
            'country_id' => Country::getPhilippinesId(),
        ]);

        expect_that($model->validate('name'));
    }

    public function testNoExisting()
    {
        $model = new Region([
            'no' => Region::REGION_4A,
            'country_id' => Country::getPhilippinesId()
        ]);

        expect_not($model->validate('no'));
        expect($model->errors)->hasKey('no');
    }

    public function testNoUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Region', [
            'no' => Region::REGION_4A,
            'country_id' => Country::getPhilippinesId(),
        ]);

        expect_that($model->validate('no'));
    }
}