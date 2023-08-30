<?php

use app\models\Refbrgy;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'brgyCode' => 'Brgy Code',
		'brgyDesc' => 'Brgy Desc',
		'regCode' => 'Reg Code',
		'provCode' => 'Prov Code',
		'citymunCode' => 'Citymun Code',
		'record_status' => Refbrgy::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Refbrgy::RECORD_INACTIVE
]);

return $model->getData();