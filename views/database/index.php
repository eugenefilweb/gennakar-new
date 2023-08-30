<?php

use app\helpers\Html;
use app\models\Database;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;
use app\widgets\PrioritySectorFilter;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DatabaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $searchModel->prioritySectorLabel ?: 'All Priority Sector Members';
$this->params['breadcrumbs'][] = [
	'label' => 'Priority Sector Category',
	'url' => $searchModel->indexUrl
];
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = false; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/database';
$this->params['createTitle'] = 'Create Database Entry';

$this->params['headerButtons'] = $searchModel->headerCreateButton;
?>

<?= PrioritySectorFilter::widget([
	'rowsummary' => $rowsummary,
	'data_report' => $searchModel->getDataReport($dataProviderReport),
]) ?>

<div class="database-index-page mt-10">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>