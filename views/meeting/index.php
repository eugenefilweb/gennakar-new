<?php

use app\helpers\Html;
use app\models\Meeting;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meetings';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
$this->params['printUrl'] = ['print', 'type' => Meeting::TYPE_NORMAL];
$this->params['pdfUrl'] = ['export-pdf', 'type' => Meeting::TYPE_NORMAL];
$this->params['csvUrl'] = ['export-csv', 'type' => Meeting::TYPE_NORMAL];
$this->params['xlsUrl'] = ['export-xls', 'type' => Meeting::TYPE_NORMAL];
$this->params['xlsxUrl'] = ['export-xlsx', 'type' => Meeting::TYPE_NORMAL];
?>
<div class="meeting-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>