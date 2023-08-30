<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Directory;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$type = App::formatter()->asUcWords(App::get('type'));

$this->title = $type ?: 'Directories';
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['card']];
if ($type) {
    $this->params['breadcrumbs'][] = $type;
}
$this->params['searchModel'] = $searchModel; 
$this->params['headerButtons'] = '
    <div class="d-flex align-items-center">
        '. Html::a('Detail View', ['directory/index', 'list' => 'detail'], ['class' => 'btn btn-outline-primary font-weight-bolder mr-3']) .'
        '. Html::exportButton($this->params, true) .'
        '. Directory::createButton() .'
    </div>
';
$this->params['activeMenuLink'] = '/directory/card';
?>
<div class="directory-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>