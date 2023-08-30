<?php

namespace tests\unit\models;

use app\models\HouseholdMember;

class HouseholdMemberTest extends \Codeception\Test\Unit
{
    public function testCreateSuccess()
    {
        $model = new HouseholdMember([
            'household_id' => 1,
            'member_id' => 1,
        ]);
        expect_that($model->save());
    }

    public function testHouseholdIdInvalid()
    {
        $model = new HouseholdMember([
            'household_id' => 'Invalid',
            'member_id' => 1,
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('household_id');
    }

    public function testHouseholdIdNotExisting()
    {
        $model = new HouseholdMember([
            'household_id' => 999999,
            'member_id' => 1,
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('household_id');
    }

    public function testMemberIdInvalid()
    {
        $model = new HouseholdMember([
            'household_id' => 1,
            'member_id' => 'Invalid',
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testMemberIdNotExisting()
    {
        $model = new HouseholdMember([
            'household_id' => 1,
            'member_id' => 999999999,
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }


    public function testStatusInvalid()
    {
        $model = new HouseholdMember([
            'household_id' => 1,
            'member_id' => 1,
            'status' => 'invalid'
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }

    public function testStatusNotExisting()
    {
        $model = new HouseholdMember([
            'household_id' => 1,
            'member_id' => 1,
            'status' => 9999999
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }
}