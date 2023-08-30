<?php

namespace app\tests\fixtures;

class BudgetFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Budget';
    public $dataFile = '@app/tests/fixtures/data/budget.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}