<?php

use app\models\search\WatershedSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Watershed */

$this->title = 'Duplicate Watershed: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Watersheds', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new WatershedSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="watershed-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>