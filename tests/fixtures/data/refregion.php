<?php

use app\models\Refregion;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'psgcCode' => 'Psgc Code',
		'regDesc' => 'Reg Desc',
		'regCode' => 'Reg Code',
		'island_group' => 'Island Group',
		'record_status' => Refregion::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Refregion::RECORD_INACTIVE
]);

return $model->getData();