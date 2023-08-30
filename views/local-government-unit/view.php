<?php

use app\helpers\Html;
use app\models\search\LocalGovernmentUnitSearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\LocalGovernmentUnit */

$this->title = 'Local Government Unit: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Local Government Units', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new LocalGovernmentUnitSearch();
$this->params['showCreateButton'] = true; 
$this->params['createTitle'] = 'Add New LGU';
?>
<div class="local-government-unit-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 

    <?= Html::popupCenter('Print', $model->printableUrl, [
        'class' => 'btn btn-secondary font-weight-bold',
    ]) ?>
    
    <?= Detail::widget(['model' => $model]) ?>
</div>