<?php

namespace tests\unit\models\form\transaction;

use app\models\Transaction;
use app\models\form\transaction\SeniorCitizenIntakeSheetForm;

class SeniorCitizenIntakeSheetFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new SeniorCitizenIntakeSheetForm(['transaction_id' => 1]);

        expect_that($model->save());

        $transaction = $this->tester->grabRecord('app\models\Transaction', [
            'id' => 1,
            'senior_citizen_intake_sheet_status' => Transaction::DOCUMENT_CLERK_CREATED
        ]);

        expect_that($transaction);
        expect_that($transaction->senior_citizen_intake_sheet);
    }

    public function testTransactionIdInvalid()
    {
        $model = new SeniorCitizenIntakeSheetForm(['transaction_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testTransactionIdNotExisting()
    {
        $model = new SeniorCitizenIntakeSheetForm(['transaction_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }
}