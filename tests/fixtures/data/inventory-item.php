<?php

use app\models\InventoryItem;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'name' => 'Name',
		'category' => 'Category',
		'quantity' => 'Quantity',
		'unit' => 'Unit',
		'remark' => 'Remark',
		'record_status' => InventoryItem::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => InventoryItem::RECORD_INACTIVE
]);

return $model->getData();