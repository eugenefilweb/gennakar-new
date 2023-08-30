<?php

use app\models\Country;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($name) {
    return [
		'no' => 608,
		'name' => $name,
		'alpha_code' => 'PHL',
		'record_status' => Country::RECORD_ACTIVE,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
		'created_by' => 1,
	    'updated_by' => 1,
	];
});

$model->add('1', 'Philippines');
$model->add('2', 'test', [
	'alpha_code' => 'test',
	'no' => 111
]);
$model->add('inactive', 'Inactive', [
	'no' => 2222,
	'record_status' => Country::RECORD_INACTIVE
]);

return $model->getData();