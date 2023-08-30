<?php

use app\models\Municipality;
use app\models\Province;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($name) {
    return [
		'name' => $name,
        'province_id' => Province::getCalabarzonId(),
        'no' => Municipality::MUNICIPALITY_REAL,
        'record_status' => Municipality::RECORD_ACTIVE,
		'created_by' => 1,
	    'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1', 'REAL');
$model->add('test', 'test', [
	'no' => 2222
]);
$model->add('inactive', 'Inactive', [
	'no' => 5443,
	'record_status' => Municipality::RECORD_INACTIVE
]);

return $model->getData();