<?php

namespace tests\unit\models;

use app\models\Library;

class LibraryTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'family' => 'Family',
            'genus' => 'Genus',
            'species' => 'Species',
            'sub_species' => 'Sub Species',
            'varieta_and_infra_var_name' => 'Varieta And Infra Var Name',
            'common_name' => 'Common Name',
            'taxonomic_group' => 'Taxonomic Group',
            'conservation_status' => 'Conservation Status',
            'residency_status' => 'Residency Status',
            'distribution' => 'Distribution',
            'record_status' => Library::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Library($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Library::RECORD_INACTIVE]);

        $model = new Library($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Library();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Library($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Library', [
            'record_status' => Library::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Library', [
            'record_status' => Library::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Library', [
            'record_status' => Library::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Library', [
            'record_status' => Library::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}