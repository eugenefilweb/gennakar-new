<?php

use app\models\TechIssueLog;
use yii\db\Expression;

$model = new \app\helpers\FixtureData(function($params) {
    return [
		'tech_issue_id' => 'Tech Issue ID',
		'status' => 'Status',
		'remarks' => 'Remarks',
		'record_status' => TechIssueLog::RECORD_ACTIVE,
        'created_by' => 1,
        'updated_by' => 1,
		'created_at' => new Expression('UTC_TIMESTAMP'),
        'updated_at' => new Expression('UTC_TIMESTAMP'),
    ];
});

$model->add('1');
$model->add('inactive', [], [
	'record_status' => TechIssueLog::RECORD_INACTIVE
]);

return $model->getData();