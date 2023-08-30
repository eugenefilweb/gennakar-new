<?php

namespace app\tests\fixtures;

class HouseholdFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Household';
    public $dataFile = '@app/tests/fixtures/data/household.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}