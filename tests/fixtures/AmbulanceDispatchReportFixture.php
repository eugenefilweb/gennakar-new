<?php

namespace app\tests\fixtures;

class AmbulanceDispatchReportFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\AmbulanceDispatchReport';
    public $dataFile = '@app/tests/fixtures/data/ambulance-dispatch-report.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}