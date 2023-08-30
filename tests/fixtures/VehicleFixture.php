<?php

namespace app\tests\fixtures;

class VehicleFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Vehicle';
    public $dataFile = '@app/tests/fixtures/data/vehicle.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}