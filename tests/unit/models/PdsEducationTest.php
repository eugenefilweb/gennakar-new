<?php

namespace tests\unit\models;

use app\models\PdsEducation;

class PdsEducationTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'pds_id' => 'Pds ID',
            'level' => 'Level',
            'name' => 'Name',
            'course' => 'Course',
            'from' => 'From',
            'to' => 'To',
            'highest_level' => 'Highest Level',
            'year_graduated' => 'Year Graduated',
            'academic_honor' => 'Academic Honor',
            'record_status' => PdsEducation::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new PdsEducation($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PdsEducation::RECORD_INACTIVE]);

        $model = new PdsEducation($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PdsEducation();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PdsEducation($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsEducation', [
            'record_status' => PdsEducation::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsEducation', [
            'record_status' => PdsEducation::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsEducation', [
            'record_status' => PdsEducation::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsEducation', [
            'record_status' => PdsEducation::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}