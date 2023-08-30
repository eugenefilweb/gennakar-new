<?php

use app\models\search\TreeSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Tree */

$this->title = 'Create Tree';
$this->params['breadcrumbs'][] = ['label' => $model->indexLabel, 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => "Patrol: {$model->patrolTripId}", 'url' => $model->patrolViewUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new TreeSearch();
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="tree-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>