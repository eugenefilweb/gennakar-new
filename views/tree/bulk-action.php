<?php

use app\widgets\ConfirmBulkAction;
use app\models\search\TreeSearch;

$this->title = 'Confirm Bulk Action';
$this->params['breadcrumbs'][] = ['label' => $model->indexLabel, 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
$this->params['showCreateButton'] = true;
$this->params['searchModel'] = new TreeSearch();
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="tree-bulk-action-page">
	<?= ConfirmBulkAction::widget([
		'models' => $models,
		'process' => $process,
	    'post' => $post,
	]) ?>
</div>