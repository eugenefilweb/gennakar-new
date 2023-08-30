<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\WatershedSearch;
use app\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Watershed */

$this->title = 'Watershed: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Watersheds', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new WatershedSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="watershed-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <div class="row">
    	<div class="col-md-8">
    		<?= Detail::widget(['model' => $model]) ?>
    	</div>
    	<div class="col-md-4">
    		<?= Html::image($model->map, [], [
    			'class' => 'img-fluid img-thumbnail'
    		]) ?>
    	</div>
    </div>
</div>