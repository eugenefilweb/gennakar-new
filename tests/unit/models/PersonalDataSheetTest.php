<?php

namespace tests\unit\models;

use app\models\PersonalDataSheet;

class PersonalDataSheetTest extends \Codeception\Test\Unit
{
    protected function data($replace=[])
    {
        return array_replace([
            'surname' => 'Surname',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'name_extension' => 'Name Extension',
            'date_of_birth' => 'Date Of Birth',
            'place_of_birth' => 'Place Of Birth',
            'sex' => 'Sex',
            'civil_status' => 'Civil Status',
            'height' => 'Height',
            'weight' => 'Weight',
            'blood_type' => 'Blood Type',
            'gsis_id_no' => 'Gsis Id No',
            'pagibig_id_no' => 'Pagibig Id No',
            'philhealth_no' => 'Philhealth No',
            'sss_no' => 'Sss No',
            'tin_no' => 'Tin No',
            'agency_employee_no' => 'Agency Employee No',
            'citizenship' => 'Citizenship',
            'citizenship_type' => 'Citizenship Type',
            'dual_citizenship_country' => 'Dual Citizenship Country',
            'dual_citizenship_details' => 'Dual Citizenship Details',
            'ra_house_block_lot_no' => 'Ra House Block Lot No',
            'ra_street' => 'Ra Street',
            'ra_subdivision_village' => 'Ra Subdivision Village',
            'ra_barangay' => 'Ra Barangay',
            'ra_city_municipality' => 'Ra City Municipality',
            'ra_province' => 'Ra Province',
            'ra_zip_code' => 'Ra Zip Code',
            'pa_house_block_lot_no' => 'Pa House Block Lot No',
            'pa_street' => 'Pa Street',
            'pa_subdivision_village' => 'Pa Subdivision Village',
            'pa_barangay' => 'Pa Barangay',
            'pa_city_municipality' => 'Pa City Municipality',
            'pa_province' => 'Pa Province',
            'pa_zip_code' => 'Pa Zip Code',
            'telephone_no' => 'Telephone No',
            'mobile_no' => 'Mobile No',
            'email_address' => 'Email Address',
            'spouse_surname' => 'Spouse Surname',
            'spouse_first_name' => 'Spouse First Name',
            'spouse_middle_name' => 'Spouse Middle Name',
            'spouse_name_extension' => 'Spouse Name Extension',
            'spouse_occupation' => 'Spouse Occupation',
            'spouse_employer' => 'Spouse Employer',
            'spouse_employer_address' => 'Spouse Employer Address',
            'spouse_employer_telephone_no' => 'Spouse Employer Telephone No',
            'childrens' => 'Childrens',
            'father_surname' => 'Father Surname',
            'father_first_name' => 'Father First Name',
            'father_middle_name' => 'Father Middle Name',
            'father_name_extension' => 'Father Name Extension',
            'mother_surname' => 'Mother Surname',
            'mother_first_name' => 'Mother First Name',
            'mother_middle_name' => 'Mother Middle Name',
            'mother_name_extension' => 'Mother Name Extension',
            'signature' => 'Signature',
            'date' => 'Date',
            'skills' => 'Skills',
            'recognitions' => 'Recognitions',
            'organizations' => 'Organizations',
            'consanguinity_related' => 'Consanguinity Related',
            'administrative_offense' => 'Administrative Offense',
            'charged_criminally' => 'Charged Criminally',
            'crime_convicted' => 'Crime Convicted',
            'service_separated' => 'Service Separated',
            'election_candidate' => 'Election Candidate',
            'government_resigned' => 'Government Resigned',
            'other_country_resident' => 'Other Country Resident',
            'indigenous_group' => 'Indigenous Group',
            'pwd' => 'Pwd',
            'solo_parent' => 'Solo Parent',
            'references' => 'References',
            'photo' => 'Photo',
            'government_issued_id' => 'Government Issued ID',
            'government_id_no' => 'Government Id No',
            'government_id_place_of_issuance' => 'Government Id Place Of Issuance',
            'right_thumbmark' => 'Right Thumbmark',
            'person_administering_oath' => 'Person Administering Oath',
            'father_id' => 'Father ID',
            'mother_id' => 'Mother ID',
            'spouse_id' => 'Spouse ID',
            'record_status' => PersonalDataSheet::RECORD_ACTIVE
        ], $replace);
    }

    public function testCreateSuccess()
    {
        $model = new PersonalDataSheet($this->data());
        expect_that($model->save());
    }

    public function testNoInactiveDataAccessRoleUserCreateInactiveData()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'no_inactive_data_access_role_user'
        ]));

        $data = $this->data(['record_status' => PersonalDataSheet::RECORD_INACTIVE]);

        $model = new PersonalDataSheet($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');

        \Yii::$app->user->logout();
    }

    public function testCreateNoData()
    {
        $model = new PersonalDataSheet();
        expect_not($model->save());
    }

    public function testCreateInvalidRecordStatus()
    {
        $data = $this->data(['record_status' => 3]);

        $model = new PersonalDataSheet($data);
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }

    public function testUpdateSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PersonalDataSheet', [
            'record_status' => PersonalDataSheet::RECORD_ACTIVE
        ]);
        $model->record_status = 1;
        expect_that($model->save());
    }

    public function testDeleteSuccess()
    {
        $model = $this->tester->grabRecord('app\models\PersonalDataSheet', [
            'record_status' => PersonalDataSheet::RECORD_ACTIVE
        ]);
        expect_that($model->delete());
    }

    public function testActivateData()
    {
        $model = $this->tester->grabRecord('app\models\PersonalDataSheet', [
            'record_status' => PersonalDataSheet::RECORD_INACTIVE
        ]);
        expect_that($model);

        $model->activate();
        expect_that($model->save());
    }

    public function testGuestDeactivateData()
    {
        $model = $this->tester->grabRecord('app\models\PersonalDataSheet', [
            'record_status' => PersonalDataSheet::RECORD_ACTIVE
        ]);
        expect_that($model);

        $model->inactivate();
        expect_not($model->save());
        expect($model->errors)->hasKey('record_status');
    }
}