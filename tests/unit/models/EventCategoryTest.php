<?php

namespace tests\unit\models;

use app\models\EventCategory;

class EventCategoryTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'name' => 'Name',
            'value' => 'Name',
            'sort_order' => EventCategory::TYPE_DEFAULT
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new EventCategory($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => EventCategory::RECORD_INACTIVE]);

        $model = new EventCategory($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new EventCategory();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new EventCategory($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'record_status' => EventCategory::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'slug' => 'disaster-response-and-recovery'
        ]);
        expect_that($model->delete());
    }

    public function testDeleteFailed()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'slug' => 'disaster-mitigation-and-preparedness'
        ]);
        expect_not($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'record_status' => EventCategory::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'record_status' => EventCategory::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testNameExisting()
    {
        $model = new EventCategory([
            'name' => 'Disaster Mitigation and Preparedness',
        ]);

        expect_not($model->validate('name'));
        expect($model->errors)->hasKey('name');
    }

    public function testNameUpdateExisting()
    {
        $model = $this->tester->grabRecord('app\models\EventCategory', [
            'name' => 'Disaster Mitigation and Preparedness',
        ]);

        expect_that($model->validate('name'));
    }
}