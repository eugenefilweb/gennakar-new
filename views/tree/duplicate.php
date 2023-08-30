<?php

use app\models\search\TreeSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Tree */

$this->title = 'Duplicate Tree: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => $model->indexLabel, 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = ['label' => "Patrol: {$model->patrolTripId}", 'url' => $model->patrolViewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new TreeSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="tree-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>