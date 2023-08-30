<?php

use app\models\Library;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'family' => 'Family',
		'genus' => 'Genus',
		'species' => 'Species',
		'sub_species' => 'Sub Species',
		'varieta_and_infra_var_name' => 'Varieta And Infra Var Name',
		'common_name' => 'Common Name',
		'taxonomic_group' => 'Taxonomic Group',
		'conservation_status' => 'Conservation Status',
		'residency_status' => 'Residency Status',
		'distribution' => 'Distribution',
		'record_status' => Library::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Library::RECORD_INACTIVE
]);

return $model->getData();