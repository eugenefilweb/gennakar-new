<?php

namespace app\tests\fixtures;

class PdsCivilServiceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PdsCivilService';
    public $dataFile = '@app/tests/fixtures/data/pds-civil-service.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}