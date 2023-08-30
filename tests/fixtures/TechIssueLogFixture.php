<?php

namespace app\tests\fixtures;

class TechIssueLogFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\TechIssueLog';
    public $dataFile = '@app/tests/fixtures/data/tech-issue-log.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}