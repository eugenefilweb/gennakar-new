<?php

namespace app\tests\fixtures;

class VehicularAccidentReportFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\VehicularAccidentReport';
    public $dataFile = '@app/tests/fixtures/data/vehicular-accident-report.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}