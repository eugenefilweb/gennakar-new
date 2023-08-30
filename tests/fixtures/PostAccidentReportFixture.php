<?php

namespace app\tests\fixtures;

class PostAccidentReportFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PostAccidentReport';
    public $dataFile = '@app/tests/fixtures/data/post-accident-report.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}