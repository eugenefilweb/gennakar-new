<?php

use app\models\search\VehicleSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = 'Duplicate Vehicle: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new VehicleSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="vehicle-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>