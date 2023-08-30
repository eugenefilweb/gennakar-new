<?php

namespace tests\unit\models\form\transaction;

use app\models\Transaction;
use app\models\form\transaction\ChangeTransactionStatusForm;


class ChangeTransactionStatusFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new ChangeTransactionStatusForm(['transaction_id' => 1]);
        $model->status = Transaction::MHO_APPROVED;
        $model->remarks = 'test';

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Transaction', [
            'id' => 1,
            'status' => Transaction::MHO_APPROVED,
            'remarks' => 'test'
        ]);
    }

    public function testTransactionIdInvalid()
    {
        $model = new ChangeTransactionStatusForm(['transaction_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testTransactionIdNotExisting()
    {
        $model = new ChangeTransactionStatusForm(['transaction_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testStatusInvalid()
    {
        $model = new ChangeTransactionStatusForm(['status' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }

    public function testStatusNotExisting()
    {
        $model = new ChangeTransactionStatusForm(['status' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('status');
    }
}