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
$searchModel->status=1;
$this->title = 'Patrols: Validated';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['printUrl'] = ['patrol/print', 'status'=>1];
$this->params['pdfUrl'] = ['patrol/export-pdf', 'status'=>1];
$this->params['csvUrl'] = ['patrol/export-csv', 'status'=>1];
$this->params['xlsUrl'] = ['patrol/export-xls', 'status'=>1];
$this->params['xlsxUrl'] = ['patrol/export-xlsx', 'status'=>1];
$this->params['showExportButton'] = true;

$this->params['activeMenuLink'] = '/patrol/validated';
$this->params['createTitle'] = 'Add New Patrol';
$this->params['headerButtons'] = (new Patrol(['status' => Patrol::VALIDATED]))->createButton;

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