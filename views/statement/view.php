<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\StatementSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Statement */

$this->title = 'Statement: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Statements', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new StatementSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="statement-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>