<?php

namespace tests\unit\models\form\transaction;

use app\models\Transaction;
use app\models\form\transaction\DocumentForm;

class DocumentFormTest extends \Codeception\Test\Unit
{
    public function testValidRemove()
    {
        $model = new DocumentForm(['transaction_id' => 1]);
        $model->file_token = 'default-6ccb4a66-0ca3-46c7-88dd-default';
        $model->scenario = 'remove';
        $model->unlink = false;
        expect_that($model->save());

        $transaction = $this->tester->grabRecord('app\models\Transaction', [
            'id' => 1,
        ]);

        expect_that($transaction);
        expect_not($transaction->files);
    }

    public function testValidAdd()
    {
        $model = new DocumentForm(['transaction_id' => 1]);
        $model->file_token = 'add-6ccb4a66-0ca3-46c7-88dd-add';

        expect_that($model->save());

        $transaction = $this->tester->grabRecord('app\models\Transaction', [
            'id' => 1,
        ]);

        expect_that($transaction);
        expect_that($transaction->files);
    }

    public function testTransactionIdInvalid()
    {
        $model = new DocumentForm(['transaction_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testTransactionIdNotExisting()
    {
        $model = new DocumentForm(['transaction_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('transaction_id');
    }

    public function testFileTokenInvalidOnRemoved()
    {
        $model = new DocumentForm(['transaction_id' => 1]);
        $model->scenario = 'remove';
        $model->file_token = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('file_token');
    }
}