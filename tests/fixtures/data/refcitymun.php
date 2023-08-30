<?php

use app\models\Refcitymun;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'psgcCode' => 'Psgc Code',
		'citymunDesc' => 'Citymun Desc',
		'regDesc' => 'Reg Desc',
		'provCode' => 'Prov Code',
		'citymunCode' => 'Citymun Code',
		'record_status' => Refcitymun::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Refcitymun::RECORD_INACTIVE
]);

return $model->getData();