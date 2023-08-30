<?php

use app\helpers\Html;
use app\models\Role;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patroller';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = false; 
$this->params['showExportButton'] = true;
$this->params['activeMenuLink'] = '/user/patroller';  
$this->params['searchKeywordUrl'] = ['user/find-by-keywords', 'role_id' => Role::PATROLLER];
$this->params['headerButtons'] = Html::a('Add New Patroller', ['user/create-patroller'], [
    'class' => 'btn btn-success font-weight-bolder'
]);
?>
<div class="user-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
	<?= BulkAction::widget(['searchModel' => $searchModel]) ?>
    <?= Grid::widget([
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
        'paramName' => 'slug'
    ]); ?>
    <?= Html::endForm(); ?> 
</div>