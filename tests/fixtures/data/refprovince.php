<?php

use app\models\Refprovince;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'psgcCode' => 'Psgc Code',
		'provDesc' => 'Prov Desc',
		'regCode' => 'Reg Code',
		'provCode' => 'Prov Code',
		'record_status' => Refprovince::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Refprovince::RECORD_INACTIVE
]);

return $model->getData();