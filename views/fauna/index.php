<?php

use app\helpers\Html;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\FaunaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Validated';
$this->params['breadcrumbs'][] = 'Faunas';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 

$this->params['printUrl'] = ['patrol/print', 'status'=>1];
$this->params['pdfUrl'] = ['patrol/export-pdf', 'status'=>1];
$this->params['csvUrl'] = ['patrol/export-csv', 'status'=>1];
$this->params['xlsUrl'] = ['patrol/export-xls', 'status'=>1];
$this->params['xlsxUrl'] = ['patrol/export-xlsx', 'status'=>1];

$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
?>
<div class="fauna-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>