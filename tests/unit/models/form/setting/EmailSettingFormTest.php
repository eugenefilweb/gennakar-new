<?php

namespace tests\unit\models\form\setting;

use app\models\form\setting\EmailSettingForm;

class EmailSettingFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new EmailSettingForm();

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Setting', [
            'name' => $model::NAME
        ]);
    }

    public function testAdminEmailInvalid()
    {
        $model = new EmailSettingForm();
        $model->admin_email = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('admin_email');
    }

    public function testSenderEmailInvalid()
    {
        $model = new EmailSettingForm();
        $model->sender_email = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('sender_email');
    }
}