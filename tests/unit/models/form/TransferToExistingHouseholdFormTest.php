<?php

namespace tests\unit\models\form;

use app\helpers\App;
use app\models\Barangay;
use app\models\HouseholdMember;
use app\models\Member;
use app\models\form\TransferToExistingHouseholdForm;

class TransferToExistingHouseholdFormTest extends \Codeception\Test\Unit
{
    private function data($replace=[])
    {
        return array_replace([
            'head' => Member::FAMILY_HEAD_NO,
            'member_id' => 1,
            'household_id' => 4,
        ], $replace);
    }

    public function testValid()
    {
        $model = new TransferToExistingHouseholdForm($this->data());

        $data = $model->save();


        expect_that($data);

        $this->tester->seeRecord('app\models\Member', [
            'household_id' => $data['household']->id,
            'head' => Member::FAMILY_HEAD_NO
        ]);

        $this->tester->seeRecord('app\models\HouseholdMember', [
            'household_id' => 1,
            'member_id' => $data['member']->id,
            'status' => HouseholdMember::REMOVED
        ]);
    }

    public function testHouseholdIdInvalid()
    {
        $model = new TransferToExistingHouseholdForm($this->data(['household_id' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('household_id');
    }

    public function testHouseholdIdNotExisting()
    {
        $model = new TransferToExistingHouseholdForm($this->data(['household_id' => 9999]));
        expect_not($model->save());
        expect($model->errors)->hasKey('household_id');
    }

    public function testMemberIdInvalid()
    {
        $model = new TransferToExistingHouseholdForm($this->data(['member_id' => 'invalid']));
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testMemberIdNotExisting()
    {
        $model = new TransferToExistingHouseholdForm($this->data(['member_id' => 9999]));
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testHeadInvalid()
    {
        $model = new TransferToExistingHouseholdForm($this->data());
        $model->head = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('head');
    }

    public function testHeadNotExisting()
    {
        $model = new TransferToExistingHouseholdForm($this->data());
        $model->head = 9999;
        expect_not($model->save());
        expect($model->errors)->hasKey('head');
    }
}