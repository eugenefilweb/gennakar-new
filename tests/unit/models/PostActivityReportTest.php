<?php

namespace tests\unit\models;

use app\models\PostActivityReport;

class PostActivityReportTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'type' => PostActivityReport::TYPE_SIAD,
            'watershed_id' => 1,
            'control_no' => 'control_no-101',
            'name' => 'Name',
            'location' => 'Location',
            'type_of_activity' => 'Type Of Activity',
            'beneficiary_stakeholder_male' => 1,
            'beneficiary_stakeholder_female' => 1,
            'beneficiary_local_male' => 1,
            'beneficiary_local_female' => 1,
            'beneficiary_national_male' => 1,
            'beneficiary_national_female' => 1,
            'date_started' => '2022-10-21 00:00:00',
            'date_end' => '2022-10-22 00:00:00',
            'responsible_head' => 'Responsible Head',
            'coordinators' => ['Coordinator'],
            'staff_members' => ['Staff Members'],
            'other_members' => ['Others'],
            'activity_brief' => 'Activity Brief',
            'prepared_by' => 'Prepared By',
            'verified_by' => 'Verified By',
            'remarks' => 'Remarks',
            'comments_by' => 'Comments By',
            'in_charge_of_activity' => 'In Charge Of Activity',
            'noted_by' => 'Noted By',
            'code' => 'Code',
            'record_status' => PostActivityReport::RECORD_ACTIVE
        ], $replace);
    }

    public function testInvalidType()
    {
        $model = new PostActivityReport($this->data([
            'type' => 99999,
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('type');
    }

    public function testInvalidWatershedId()
    {
        $model = new PostActivityReport($this->data([
            'watershed_id' => 99999,
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('watershed_id');
    }

    public function testDateStartedGreatherThanDateEnded()
    {
        $model = new PostActivityReport($this->data([
            'date_started' => '2022-10-23 00:00:00',
            'date_end' => '2022-10-22 00:00:00'
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('date_started');
        expect($model->errors)->hasKey('date_end');
    }

    public function testDuplicatedControlNo()
    {
        $model = new PostActivityReport($this->data([
            'control_no' => 'Control No'
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('control_no');
    }

    public function testCreateSuccess()
    {
        $model = new PostActivityReport($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PostActivityReport::RECORD_INACTIVE]);

        $model = new PostActivityReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PostActivityReport();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PostActivityReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PostActivityReport', [
            'record_status' => PostActivityReport::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PostActivityReport', [
            'record_status' => PostActivityReport::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PostActivityReport', [
            'record_status' => PostActivityReport::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PostActivityReport', [
            'record_status' => PostActivityReport::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}