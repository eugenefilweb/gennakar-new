<?php

use app\models\PdsCivilService;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'pds_id' => 'Pds ID',
		'career_service' => 'Career Service',
		'rating' => 'Rating',
		'date_of_examination' => 'Date Of Examination',
		'place_of_examination' => 'Place Of Examination',
		'license' => 'License',
		'record_status' => PdsCivilService::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => PdsCivilService::RECORD_INACTIVE
]);

return $model->getData();