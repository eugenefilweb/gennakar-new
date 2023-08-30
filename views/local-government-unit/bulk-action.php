<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\LocalGovernmentUnitSearch;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => 'Local Government Units', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new LocalGovernmentUnitSearch();
$this->params['createTitle'] = 'Add New LGU';
?>
<div class="local-government-unit-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>