<?php

use app\widgets\Pagination;
use app\widgets\Search;
use app\widgets\DateRange;
use yii\widgets\ActiveForm;
use app\widgets\SearchButton;
use app\widgets\RecordStatusFilter;

/* @var $this yii\web\View */
/* @var $model app\models\search\FaunaSearch */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin([
    'action' => $model->searchAction,
    'method' => 'get',
    'id' => 'fauna-search-form'
]); ?>
    <?= Search::widget(['model' => $model]) ?>
    <?= DateRange::widget(['model' => $model]) ?>
    
     <?php 
    echo $form->field($model, 'patrol_id')->textInput(['name'=>'patrol_id']);
    ?>
    
    
     <?php 
   // $model->status=0;
    echo $form->field($model, 'status')->hiddenInput(['name'=>'status'])->label(false);
    ?>
    
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