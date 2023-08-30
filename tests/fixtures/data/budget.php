<?php

use app\helpers\App;
use app\models\Budget;
use app\models\Transaction;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'year' => 2022,
		'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
		'budget' => 1000000,
		'record_status' => Budget::RECORD_ACTIVE,
		'created_by' => 1,
	    'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'year' => 2018,
	'record_status' => Budget::RECORD_INACTIVE
]);

$model->add('2021', [], [
	'year' => 2021,
	'budget' => 5000000
]);

$model->add('2020', [], [
	'year' => 2020,
	'budget' => 7000000
]);
return $model->getData();