<?php

use app\helpers\Html;
use app\models\Tree;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'For Validation';
$this->params['breadcrumbs'][] = 'Trees';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = false; 

$this->params['printUrl'] = ['tree/print', 'status'=>0];
$this->params['pdfUrl'] = ['tree/export-pdf', 'status'=>0];
$this->params['csvUrl'] = ['tree/export-csv', 'status'=>0];
$this->params['xlsUrl'] = ['tree/export-xls', 'status'=>0];
$this->params['xlsxUrl'] = ['tree/export-xlsx', 'status'=>0];

$this->params['showExportButton'] = true;
$this->params['searchKeywordUrl'] = ['tree/find-by-keywords', 'status' => Tree::NOT_VALIDATED];
$this->params['activeMenuLink'] = '/tree/for-validation';
$this->params['headerButtons'] = Html::a($searchModel->createLabel, ['create', 'status' => Tree::NOT_VALIDATED], ['class' => 'btn btn-success btn-sm font-weight-bold']);

$searchModel->searchAction = ['tree/for-validation'];


?>
<div class="tree-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>