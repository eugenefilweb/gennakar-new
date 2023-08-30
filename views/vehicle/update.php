<?php

use app\models\search\VehicleSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = 'Update Vehicle: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new VehicleSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="vehicle-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>