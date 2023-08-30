<?php

namespace tests\unit\models;

use app\models\EarlyWarning;

class EarlyWarningTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'subject' => 'Subject',
            'meteorological_conditions' => 'Meteorological Conditions',
            'impact_of_winds' => 'Impact Of Winds',
            'precautionary_measures' => 'Precautionary Measures',
            'bulletin_no' => 'Bulletin No',
            'signal_no' => 'Signal No',
            'category' => 'Category',
            'windspeed' => 'Windspeed',
            'mayor_firstname' => 'Mayor Firstname',
            'mayor_middlename' => 'Mayor Middlename',
            'mayor_lastname' => 'Mayor Lastname',
            'message' => 'Message',
            'entry_text' => 'Entry Text',
            'attachment_text' => 'Attachment Text',
            'other_text' => 'Other Text',
            'attachments' => 'Attachments',
            'record_status' => EarlyWarning::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new EarlyWarning($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => EarlyWarning::RECORD_INACTIVE]);

        $model = new EarlyWarning($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new EarlyWarning();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new EarlyWarning($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EarlyWarning', [
            'record_status' => EarlyWarning::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EarlyWarning', [
            'record_status' => EarlyWarning::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\EarlyWarning', [
            'record_status' => EarlyWarning::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\EarlyWarning', [
            'record_status' => EarlyWarning::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}