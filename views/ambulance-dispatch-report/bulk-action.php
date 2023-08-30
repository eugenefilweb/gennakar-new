<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\AmbulanceDispatchReportSearch;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => 'Ambulance Dispatch Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new AmbulanceDispatchReportSearch();
?>
<div class="ambulance-dispatch-report-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>