<?php

namespace tests\unit\models\form\transaction;

use app\models\Transaction;
use app\models\form\transaction\SeniorCitizenIdForm;

class SeniorCitizenIdFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new SeniorCitizenIdForm([
            'member_id' => 7,
            'files' => ['sample']
        ]);

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Transaction', [
            'member_id' => 7,
            'transaction_type' => Transaction::SENIOR_CITIZEN_ID_APPLICATION,
        ]);
    }

    public function testMemberIdInvalid()
    {
        $model = new SeniorCitizenIdForm(['member_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testMemberIdNotExisting()
    {
        $model = new SeniorCitizenIdForm(['member_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testMemberIdRequired()
    {
        $model = new SeniorCitizenIdForm(['member_id' => '']);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testTransactionIdRequiredOnUpdate()
    {
        $model = new SeniorCitizenIdForm(['transaction_id' => '']);
        $model->scenario = 'update';

        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testTransactionIdInvalidOnUpdate()
    {
        $model = new SeniorCitizenIdForm(['transaction_id' => 'invalid']);
        $model->scenario = 'update';
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');


        $model = new SeniorCitizenIdForm(['transaction_id' => 9999999]);
        $model->scenario = 'update';
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }
}