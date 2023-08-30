<?php

use app\models\Region;
use yii\db\Expression;
use app\models\Barangay;
use app\models\Province;
use app\models\Household;
use app\models\Municipality;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'no' => '111111',
		'transfer_date' => '2015-02-16 13:35:36.343',
		'longitude' => '122.6030581482',
		'latitude' => '14.6696698108',
		'altitude' => '65.8',
		'region_id' => Region::getRegion4aId(),
		'province_id' => Province::getCalabarzonId(),
		'municipality_id' => Municipality::getRealId(),
		'barangay_id' => Barangay::getPoblacion1Id(),
		'zone_no' => 99,
		'purok_no' => 6,
		'blk_no' => '9B',
		'lot_no' => 6,
		'street' => 'NONE',
		'token' => 'h1',
		'record_status' => Household::RECORD_ACTIVE,
		'created_by' => 1,
	    'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'no' => '111112',
	'token' => 'h2',
	'record_status' => Household::RECORD_INACTIVE
]);

$model->add('draft', [], [
	'no' => '111113',
	'token' => 'h3',
	'record_status' => Household::RECORD_DRAFT
]);
$model->add('test', [], [
	'no' => '123456789'
]);

return $model->getData();