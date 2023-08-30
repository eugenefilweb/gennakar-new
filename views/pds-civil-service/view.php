<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PdsCivilServiceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsCivilService */

$this->title = 'Pds Civil Service: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Civil Services', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PdsCivilServiceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-civil-service-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>