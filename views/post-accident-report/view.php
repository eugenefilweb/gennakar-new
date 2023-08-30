<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\helpers\Html;
use app\models\search\PostAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostAccidentReport */

$this->title = 'Post Accident Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Post Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PostAccidentReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="post-accident-report-view-page">
    <?=  Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Html::popupCenter('Print', $model->printableUrl, [
    	'class' => 'btn btn-secondary font-weight-bold',
    ]) ?>
    <div class="mb-10"></div>
    <div class="d-flex justify-content-center">
        <div></div>
        <div style="border: 1px solid #ccc; padding: 3rem;overflow: auto;">
            <?= $this->render('printable', [
                'model' => $model, 
                'style' => 'max-width: 1024px;'
            ]) ?>
        </div>
        <div></div>
    </div>
    <?php # Detail::widget(['model' => $model]) ?>
</div>