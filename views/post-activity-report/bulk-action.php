<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\PostActivityReportSearch;

$activeModel = $models ? $models[0]: '';

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => 'Post Activity Reports', 'url' => $activeModel->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new PostActivityReportSearch([
    'searchAction' => ($activeModel->isSiad)? ['siad']: ['mdrrmo']
]);
$this->params['activeMenuLink'] = $activeModel ? $activeModel->activeMenuLink: '';
$this->params['searchKeywordUrl'] = ['post-activity-report/find-by-keywords', 'type' => $activeModel->type];
?>
<div class="post-activity-report-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>