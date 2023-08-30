<?php

use app\models\Tree;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'common_name' => 'Common Name',
		'kingdom' => 'Kingdom',
		'family' => 'Family',
		'genus' => 'Genus',
		'species' => 'Species',
		'sub_species' => 'Sub Species',
		'varieta_and_infra_var_name' => 'Varieta And Infra Var Name',
		'taxonomic_group' => 'Taxonomic Group',
		'photo' => 'Photo',
		'date_encoded' => 'Date Encoded',
		'record_status' => Tree::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Tree::RECORD_INACTIVE
]);

return $model->getData();