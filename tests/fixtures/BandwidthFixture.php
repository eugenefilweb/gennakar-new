<?php

namespace app\tests\fixtures;

class BandwidthFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Bandwidth';
    public $dataFile = '@app/tests/fixtures/data/bandwidth.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}