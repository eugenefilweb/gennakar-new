<?php

namespace app\tests\fixtures;

class TechIssueFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\TechIssue';
    public $dataFile = '@app/tests/fixtures/data/tech-issue.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}