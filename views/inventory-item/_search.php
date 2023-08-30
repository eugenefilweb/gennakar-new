<?php

use app\models\InventoryItem;
use app\widgets\Pagination;
use app\widgets\Search;
use app\widgets\DateRange;
use app\widgets\Filter;
use yii\widgets\ActiveForm;
use app\widgets\SearchButton;
use app\widgets\RecordStatusFilter;

/* @var $this yii\web\View */
/* @var $model app\models\search\InventoryItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'action' => $model->searchAction,
    'method' => 'get',
    'id' => 'inventory-item-search-form'
]); ?>
    <?= Search::widget(['model' => $model]) ?>
    <?= DateRange::widget(['model' => $model]) ?>
    <?= Filter::widget([
        'form' => $form,
        'model' => $model,
        'attribute' => 'category',
        'data' => InventoryItem::filter('category')
    ]) ?>
    <?= Filter::widget([
        'form' => $form,
        'model' => $model,
        'attribute' => 'unit',
        'data' => InventoryItem::filter('unit')
    ]) ?>

    <?= RecordStatusFilter::widget([
        'model' => $model,
        'form' => $form,
        'withDraft' => false
    ]) ?>
    <?= Pagination::widget([
        'model' => $model,
        'form' => $form,
    ]) ?>
    <?= SearchButton::widget() ?>
<?php ActiveForm::end(); ?>