<?php

namespace app\tests\fixtures;

class HazardMapFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\HazardMap';
    public $dataFile = '@app/tests/fixtures/data/hazard-map.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}