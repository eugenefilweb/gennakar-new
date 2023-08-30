<?php

use app\models\Email;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'to' => 'admin@example.com',
		'from_email' => 'tester@example.com',
		'from_name' => 'Tester Name',
		'subject' => 'Subject',
		'body' => 'Body',
		'token' => 'token-1',
		'record_status' => Email::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => Email::RECORD_INACTIVE,
	'token' => 'token-2'
]);

return $model->getData();