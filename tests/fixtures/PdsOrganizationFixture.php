<?php

namespace app\tests\fixtures;

class PdsOrganizationFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\PdsOrganization';
    public $dataFile = '@app/tests/fixtures/data/pds-organization.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}