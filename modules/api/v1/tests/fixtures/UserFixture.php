<?php

namespace app\modules\api\v1\tests\fixtures;

class UserFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\modules\api\v1\models\User';
    public $dataFile = '@app/modules/api/v1/tests/fixtures/data/user.php';
    public $depends = ['app\modules\api\v1\tests\fixtures\RoleFixture'];
}