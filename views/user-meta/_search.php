<?php

use app\widgets\ActiveForm;
use app\widgets\DateRange;
use app\widgets\Filter;
use app\widgets\Pagination;
use app\widgets\RecordStatusFilter;
use app\widgets\Search;
use app\widgets\SearchButton;

/* @var $this yii\web\View */
/* @var $model app\models\search\UserMetaSearch */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'action' => $model->searchAction,
    'method' => 'get',
    'id' => 'user-meta-search-form'
]); ?>
    <?= Search::widget(['model' => $model]) ?>
    <?= DateRange::widget(['model' => $model]) ?>
    <?= RecordStatusFilter::widget([
        'model' => $model,
        'form' => $form,
    ]) ?>
    <?= Pagination::widget([
        'model' => $model,
        'form' => $form,
    ]) ?>
    <?= SearchButton::widget() ?>
<?php ActiveForm::end(); ?>