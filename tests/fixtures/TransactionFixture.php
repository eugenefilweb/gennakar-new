<?php

namespace app\tests\fixtures;

class TransactionFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Transaction';
    public $dataFile = '@app/tests/fixtures/data/transaction.php';
    public $depends = [
        'app\tests\fixtures\UserFixture',
        'app\tests\fixtures\MemberFixture',
    ];
}