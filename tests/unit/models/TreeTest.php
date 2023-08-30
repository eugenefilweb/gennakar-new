<?php

namespace tests\unit\models;

use app\models\Tree;

class TreeTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'common_name' => 'Common Name',
            'kingdom' => 'Kingdom',
            'family' => 'Family',
            'genus' => 'Genus',
            'species' => 'Species',
            'sub_species' => 'Sub Species',
            'varieta_and_infra_var_name' => 'Varieta And Infra Var Name',
            'taxonomic_group' => 'Taxonomic Group',
            'photo' => 'Photo',
            'date_encoded' => 'Date Encoded',
            'record_status' => Tree::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Tree($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Tree::RECORD_INACTIVE]);

        $model = new Tree($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Tree();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Tree($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Tree', [
            'record_status' => Tree::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Tree', [
            'record_status' => Tree::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Tree', [
            'record_status' => Tree::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Tree', [
            'record_status' => Tree::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}