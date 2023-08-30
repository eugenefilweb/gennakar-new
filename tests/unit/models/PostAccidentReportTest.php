<?php

namespace tests\unit\models;

use app\models\PostAccidentReport;

class PostAccidentReportTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'location' => 'Location',
            'control_no' => 'Control No test',
            'type_of_accident' => 'Type Of Accident',
            'participant_male' => 0,
            'participant_female' => 0,
            'local_male' => 0,
            'local_female' => 0,
            'national_male' => 0,
            'national_female' => 0,
            'other_name' => 'Other Name',
            'other_male' => 0,
            'other_female' => 0,
            'date_time' => date('Y-m-d h:i:s'),
            'weather_condition' => 'Weather Condition',
            'persons_of_interest' => null,
            'responders' => null,
            'witnesses' => null,
            'accident_report' => 'Accident Report',
            'prepared_by' => 'Prepared By',
            'verified_by' => 'Verified By',
            'remarks' => 'Remarks',
            'comments_by' => 'Comments By',
            'officer_in_charge' => 'Officer In Charge',
            'noted_by' => 'Noted By',
            'code' => 'Code',
            'map' => 'Map',
            'barangay' => 'barangay',
            'record_status' => PostAccidentReport::RECORD_ACTIVE,
        ], $replace);
    }

    public function testDuplicatedControlNo()
    {
        $model = new PostAccidentReport($this->data([
            'control_no' => 'Control No'
        ]));
        expect_not($model->save());
        expect($model->errors)->hasKey('control_no');
    }

    public function testCreateSuccess()
    {
        $model = new PostAccidentReport($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PostAccidentReport::RECORD_INACTIVE]);

        $model = new PostAccidentReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PostAccidentReport();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PostAccidentReport($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PostAccidentReport', [
            'record_status' => PostAccidentReport::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PostAccidentReport', [
            'record_status' => PostAccidentReport::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PostAccidentReport', [
            'record_status' => PostAccidentReport::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PostAccidentReport', [
            'record_status' => PostAccidentReport::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}