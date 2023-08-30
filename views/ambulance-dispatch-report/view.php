<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\AmbulanceDispatchReportSearch;
use app\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AmbulanceDispatchReport */

$this->title = 'Ambulance Dispatch Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Ambulance Dispatch Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new AmbulanceDispatchReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="ambulance-dispatch-report-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Html::popupCenter('Print', $model->printableUrl, [
        'class' => 'btn btn-secondary font-weight-bold',
    ]) ?>

    <div class="d-flex justify-content-center mt-5">
        <div></div>
        <div style="border: 1px solid #ccc; padding: 2rem;overflow: auto;">
            <?= $this->render('printable', [
                'model' => $model, 
                'style' => 'width: 1024px;'
            ]) ?>
        </div>
        <div></div>
    </div>
</div>