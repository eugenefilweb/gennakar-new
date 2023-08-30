<?php

namespace tests\unit\models;

use app\models\PdsCivilService;

class PdsCivilServiceTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'pds_id' => 'Pds ID',
            'career_service' => 'Career Service',
            'rating' => 'Rating',
            'date_of_examination' => 'Date Of Examination',
            'place_of_examination' => 'Place Of Examination',
            'license' => 'License',
            'record_status' => PdsCivilService::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new PdsCivilService($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PdsCivilService::RECORD_INACTIVE]);

        $model = new PdsCivilService($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PdsCivilService();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PdsCivilService($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsCivilService', [
            'record_status' => PdsCivilService::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PdsCivilService', [
            'record_status' => PdsCivilService::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsCivilService', [
            'record_status' => PdsCivilService::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PdsCivilService', [
            'record_status' => PdsCivilService::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}