<?php

namespace tests\unit\models;

use app\models\Vehicle;

class VehicleTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'plate_no' => 'Plate No',
            'class' => 'Class',
            'color' => 'Color',
            'make' => 'Make',
            'model' => 'Model',
            'year' => 'Year',
            'is_commercial' => 'Is Commercial',
            'driver_firstname' => 'Driver Firstname',
            'driver_middlename' => 'Driver Middlename',
            'driver_lastname' => 'Driver Lastname',
            'driver_suffix' => 'Driver Suffix',
            'driver_address' => 'Driver Address',
            'driver_email' => 'Driver Email',
            'driver_contact_no' => 'Driver Contact No',
            'driver_alt_contact_no' => 'Driver Alt Contact No',
            'company_name' => 'Company Name',
            'company_address' => 'Company Address',
            'company_contact_no' => 'Company Contact No',
            'type_of_cargo' => 'Type Of Cargo',
            'or_no' => 'Or No',
            'or_no_date_issued' => 'Or No Date Issued',
            'cr_no' => 'Cr No',
            'cr_no_date_issued' => 'Cr No Date Issued',
            'insurance_company' => 'Insurance Company',
            'insurance_type' => 'Insurance Type',
            'coverage_start_date' => 'Coverage Start Date',
            'coverage_end_date' => 'Coverage End Date',
            'insurance_status' => 'Insurance Status',
            'passengers' => 'Passengers',
            'driver_license_front' => 'Driver License Front',
            'driver_license_back' => 'Driver License Back',
            'or_photo' => 'Or Photo',
            'cr_photo' => 'Cr Photo',
            'vehicular_accident_report_id' => 'Vehicular Accident Report ID',
            'record_status' => Vehicle::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new Vehicle($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => Vehicle::RECORD_INACTIVE]);

        $model = new Vehicle($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new Vehicle();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new Vehicle($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Vehicle', [
            'record_status' => Vehicle::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\Vehicle', [
            'record_status' => Vehicle::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\Vehicle', [
            'record_status' => Vehicle::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\Vehicle', [
            'record_status' => Vehicle::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}