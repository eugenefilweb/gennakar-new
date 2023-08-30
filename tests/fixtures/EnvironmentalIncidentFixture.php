<?php

namespace app\tests\fixtures;

class EnvironmentalIncidentFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\EnvironmentalIncident';
    public $dataFile = '@app/tests/fixtures/data/environmental-incident.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}