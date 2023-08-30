<?php

use app\helpers\Html;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostActivityReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Activity Reports: MDRRMO';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/post-activity-report/mdrrmo';
$this->params['searchKeywordUrl'] = ['post-activity-report/find-by-keywords', 'type' => $searchModel::TYPE_DRRM];
$this->params['headerButtons'] = Html::a('Create New Report', ['create', 'type' => $searchModel::TYPE_DRRM], [
    'class' => 'btn btn-success font-weight-bold'
]);
?>
<div class="post-activity-report-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>