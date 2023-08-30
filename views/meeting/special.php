<?php

use app\helpers\Html;
use app\models\Meeting;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Special Meetings';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = false; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/meeting/special';
$this->params['headerButtons'] = Html::a('Create Special Meeting', ['meeting/create', 'type' => Meeting::TYPE_SPECIAL], [
    'class' => 'btn btn-success font-weight-bolder'
]);
$this->params['searchKeywordUrl'] = ['find-by-keywords', 'type' => Meeting::TYPE_SPECIAL];
$this->params['printUrl'] = ['print', 'type' => Meeting::TYPE_SPECIAL];
$this->params['pdfUrl'] = ['export-pdf', 'type' => Meeting::TYPE_SPECIAL];
$this->params['csvUrl'] = ['export-csv', 'type' => Meeting::TYPE_SPECIAL];
$this->params['xlsUrl'] = ['export-xls', 'type' => Meeting::TYPE_SPECIAL];
$this->params['xlsxUrl'] = ['export-xlsx', 'type' => Meeting::TYPE_SPECIAL];
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