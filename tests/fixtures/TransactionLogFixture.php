<?php

namespace app\tests\fixtures;

class TransactionLogFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\TransactionLog';
    public $dataFile = '@app/tests/fixtures/data/transaction-log.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\TransactionFixture',
    ];
}