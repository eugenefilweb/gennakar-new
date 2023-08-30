<?php

namespace app\tests\fixtures;

class PassengerFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Passenger';
    public $dataFile = '@app/tests/fixtures/data/passenger.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}