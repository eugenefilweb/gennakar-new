<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\search\PostActivityReportSearch;
use app\widgets\Anchors;
use app\widgets\Detail;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\PostActivityReport */

$this->title = 'Post Activity Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Post Activity Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PostActivityReportSearch([
    'searchAction' => ($model->isSiad)? ['siad']: ['mdrrmo']
]);
$this->params['searchKeywordUrl'] = ['post-activity-report/find-by-keywords', 'type' => $model->type];
$this->params['activeMenuLink'] = $model->activeMenuLink;
$this->params['headerButtons'] = Html::a('Create New Report', ['create', 'type' => $model->type], [
    'class' => 'btn btn-success font-weight-bold'
]);
?>

<div class="post-activity-report-view-page">
    <?= Anchors::widget([
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

    <div class="my-5 mt-10 row">
        <div class="col-md-6">
            <?php if (($additionalPhotos = $model->additionalPhotos) != null): ?>
                <h3>Additional Photos</h3>
                <?php $this->beginContent('@app/views/file/_row-header.php'); ?>
                    <?= Html::foreach($additionalPhotos, function($file) {
                        return $this->render('/file/_row', [
                            'model' => $file,
                            'actions' => ['view']
                        ]);
                    }) ?>
                <?php $this->endContent(); ?>
            <?php endif ?>
        </div>

        <div class="col-md-6">
            <?php if (($additionalFiles = $model->additionalFiles) != null): ?>
                <h3>Additional Files</h3>
                <?php $this->beginContent('@app/views/file/_row-header.php', [
                    'tableId' => 'file-table'
                ]); ?>
                    <?= Html::foreach($additionalFiles, function($file) {
                        return $this->render('/file/_row', [
                            'model' => $file,
                            'actions' => ['view']
                        ]);
                    }) ?>
                <?php $this->endContent(); ?>
            <?php endif ?>
        </div>
    </div>
    
</div>
