<?php

namespace tests\unit\models;

use app\models\Scholarship;

class ScholarshipTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'name_suffix' => 'Name Suffix',
            'birth_date' => 'Birth Date',
            'age' => 'Age',
            'course' => 'Course',
            'barangay_id' => 'Barangay ID',
            'street_address' => 'Street Address',
            'email' => 'Email',
            'alternate_email' => 'Alternate Email',
            'contact_no' => 'Contact No',
            'alternate_contact_no' => 'Alternate Contact No',
            'house_no' => 'House No',
            'guardian' => 'Guardian',
            'first_enrollment' => 'First Enrollment',
            'expected_graduation' => 'Expected Graduation',
            'current_year_level' => 'Current Year Level',
            'school_name' => 'School Name',
            'subjects' => 'Subjects',
            'units' => 'Units',
            'documents' => 'Documents',
            'photo' => 'Photo',
            'record_status' => Scholarship::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Scholarship($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Scholarship::RECORD_INACTIVE]);

        $model = new Scholarship($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Scholarship();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Scholarship($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Scholarship', [
            'record_status' => Scholarship::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Scholarship', [
            'record_status' => Scholarship::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Scholarship', [
            'record_status' => Scholarship::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Scholarship', [
            'record_status' => Scholarship::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}