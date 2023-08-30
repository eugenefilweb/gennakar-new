<?php

namespace tests\unit\models;

use app\models\Email;

class EmailTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'to' => 'admin@example.com',
            'from_email' => 'tester@example.com',
            'from_name' => 'Tester',
            'subject' => 'Subject',
            'body' => 'Body',
            'token' => '123123',
            'record_status' => Email::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Email($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Email::RECORD_INACTIVE]);

        $model = new Email($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Email();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Email($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testToInvalid()
    {
        $model = new Email($this->data(['to' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('to');
    }

    public function testFromEmailInvalid()
    {
        $model = new Email($this->data(['from_email' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('from_email');
    }
}