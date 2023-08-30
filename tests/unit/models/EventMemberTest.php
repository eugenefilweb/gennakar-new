<?php

namespace tests\unit\models;

use app\models\EventMember;

class EventMemberTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'event_id' => 1,
            'member_id' => 5,
            'status' => EventMember::CLAIMED,
            'photo' => '',
            'record_status' => EventMember::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new EventMember($this->data());
        expect_that($model->save());
    }


    public function testDraftMemberInvalid()
    {
        $model = new EventMember($this->data(['member_id' => 3]));
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => EventMember::RECORD_INACTIVE]);

        $model = new EventMember($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new EventMember();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new EventMember($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EventMember', [
            'record_status' => EventMember::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\EventMember', [
            'record_status' => EventMember::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\EventMember', [
            'record_status' => EventMember::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\EventMember', [
            'record_status' => EventMember::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testMemberIdInvalid()
    {
        $model = new EventMember($this->data(['member_id' => 9999]));
        expect_not($model->save());

        expect($model->errors)->hasKey('member_id');
    }

    public function testEventIdInvalid()
    {
        $model = new EventMember($this->data(['event_id' => 9999]));
        expect_not($model->save());

        expect($model->errors)->hasKey('event_id');
    }

    public function testStatusInvalid()
    {
        $model = new EventMember($this->data(['status' => 9999]));
        expect_not($model->save());

        expect($model->errors)->hasKey('status');
    }

    public function testExistingMemberAndEvent()
    {
        $model = new EventMember($this->data(['member_id' => 6]));
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
        expect($model->errors)->hasKey('event_id');
    }
}