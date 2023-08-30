<?php

namespace tests\unit\models;

use app\models\Region;
use app\models\Province;

class ProvinceTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'Name',
            'region_id' => Region::getRegion4aId(),
            'no' => 596,
            'record_status' => Province::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Province($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Province::RECORD_INACTIVE]);

        $model = new Province($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Province();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Province($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'record_status' => Province::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'name' => 'test'
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'record_status' => Province::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'record_status' => Province::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testRegionIdDontExist()
    {
        $model = new Province(['region_id' => 11111111]);
        expect_not($model->save());

        expect($model->errors)->hasKey('region_id');
    }

    public function testNameExisting()
    {
        $model = new Province([
            'name' => 'QUEZON',
            'region_id' => Region::getRegion4aId()
        ]);

        expect_not($model->validate('name'));
        expect($model->errors)->hasKey('name');
    }

    public function testNameUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'name' => 'QUEZON',
            'region_id' => Region::getRegion4aId(),
        ]);

        expect_that($model->validate('name'));
    }

    public function testNoExisting()
    {
        $model = new Province([
            'no' => Province::CALABARZON,
            'region_id' => Region::getRegion4aId()
        ]);

        expect_not($model->validate('no'));
        expect($model->errors)->hasKey('no');
    }

    public function testNoUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\Province', [
            'no' => Province::CALABARZON,
            'region_id' => Region::getRegion4aId(),
        ]);

        expect_that($model->validate('no'));
    }
}