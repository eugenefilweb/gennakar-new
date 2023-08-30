<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\MeetingSearch;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new MeetingSearch();

$model = $models[0] ?? '';
$this->params['createTitle'] = 'Create ' . ($model && $model->isSpecial ? 'Special ': '') . ' Meeting';
$this->params['activeMenuLink'] = ($model && $model->isSpecial)? '/meeting/special': '/meeting';
$this->params['breadcrumbs'][] = [
    'label' => ($model && $model->isSpecial) ? 'Special Meetings': 'Meetings', 
    'url' => ($model && $model->isSpecial) ? ['special']: ($model ? $model->indexUrl: '')
];
?>
<div class="meeting-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	    'url' => ($model && $model->isSpecial) ? ['bulk-action-special']: ['bulk-action']
	]) ?>
</div>