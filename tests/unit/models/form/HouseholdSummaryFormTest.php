<?php

namespace tests\unit\models\form;

use app\helpers\App;
use app\models\Household;
use app\models\Member;
use app\models\form\HouseholdSummaryForm;

class HouseholdSummaryFormTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    protected function data($replace=[])
    {
        return array_replace([
            'household_no' => 111113,
            'head_id' => 4,
            'members_id' => [3],
        ], $replace);
    }

    public function testSave()
    {
        $this->tester->seeRecord('app\models\Household', [
            'no' => 111113,
            'record_status' => Household::RECORD_DRAFT
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'id' => 4,
            'record_status' => Member::RECORD_DRAFT
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'id' => 3,
            'record_status' => Member::RECORD_DRAFT
        ]);

        $model = new HouseholdSummaryForm($this->data());
        expect_that($model->save());

        $this->tester->seeRecord('app\models\Household', [
            'no' => 111113,
            'record_status' => Household::RECORD_ACTIVE
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'id' => 4,
            'record_status' => Member::RECORD_ACTIVE
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'id' => 3,
            'record_status' => Member::RECORD_ACTIVE
        ]);
    }

    public function testHouseholdNoInvalid()
    {
        $model = new HouseholdSummaryForm(['household_no' => 'invalid']);
        expect_not($model->validate('household_no'));
        expect($model->errors)->hasKey('household_no');

        $model = new HouseholdSummaryForm(['household_no' => 9999]);
        expect_not($model->validate('household_no'));
        expect($model->errors)->hasKey('household_no');
    }

    public function testHeadIdInvalid()
    {
        $model = new HouseholdSummaryForm(['head_id' => 'invalid']);
        expect_not($model->validate('head_id'));
        expect($model->errors)->hasKey('head_id');

        $model = new HouseholdSummaryForm(['head_id' => 9999]);
        expect_not($model->validate('head_id'));
        expect($model->errors)->hasKey('head_id');
    }

    public function testMembersIdInvalid()
    {
        $model = new HouseholdSummaryForm(['members_id' => 'invalid']);
        expect_not($model->validate('members_id'));
        expect($model->errors)->hasKey('members_id');

        $model = new HouseholdSummaryForm(['members_id' => 9999]);
        expect_not($model->validate('members_id'));
        expect($model->errors)->hasKey('members_id');
    }
}