<?php

use app\models\search\WatershedSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Watershed */

$this->title = 'Update Watershed: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Watersheds', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new WatershedSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="watershed-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>