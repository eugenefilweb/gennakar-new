<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\VehicleSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = 'Vehicle: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new VehicleSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="vehicle-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>