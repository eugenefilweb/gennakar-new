<?php

use app\helpers\Html;
use app\helpers\Url;
use app\models\Patrol;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PatrolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patrols: For Validation';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['printUrl'] = ['patrol/print', 'status'=>0];
$this->params['pdfUrl'] = ['patrol/export-pdf', 'status'=>0];
$this->params['csvUrl'] = ['patrol/export-csv', 'status'=>0];
$this->params['xlsUrl'] = ['patrol/export-xls', 'status'=>0];
$this->params['xlsxUrl'] = ['patrol/export-xlsx', 'status'=>0];
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/patrol/for-validation';
$this->params['createTitle'] = 'Add New Patrol';
?>
<div class="patrol-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>