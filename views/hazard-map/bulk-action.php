<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\HazardMapSearch;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new HazardMapSearch();
$this->params['activeMenuLink'] = '/hazard-map/card';
?>
<div class="hazard-map-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>