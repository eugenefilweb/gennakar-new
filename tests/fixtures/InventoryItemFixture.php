<?php

namespace app\tests\fixtures;

class InventoryItemFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\InventoryItem';
    public $dataFile = '@app/tests/fixtures/data/inventory-item.php';
    public $depends = ['app\tests\fixtures\UserFixture'];
}