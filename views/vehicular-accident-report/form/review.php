<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
?>

<div class="review-container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                Review and Submit
            </h4>
        </div>
    </div>

    <div class="my-10"></div>
    <h6 class="font-weight-bolder mb-3">
        General Information:
        <?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::current(['tab' => 'general-information'])) ?>
    </h6>

    <?= $this->render('review/general-information', ['model' => $model]) ?>


    <div class="separator separator-dashed my-10"></div>
    <h6 class="font-weight-bolder mb-3">
        Map Vicinity
        <?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::current(['tab' => 'map-vicinity'])) ?>
    </h6>
    <?= $this->render('review/map-vicinity', ['model' => $model]) ?>

    <div class="separator separator-dashed my-10"></div>
    <h6 class="font-weight-bolder mb-3">
        Vehicles Involved:
        <?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::current(['tab' => 'vehicles'])) ?>
    </h6>

    <?= $this->render('review/vehicles', ['model' => $model]) ?>

    <div class="separator separator-dashed my-10"></div>
    <h6 class="font-weight-bolder mb-3">
        Passengers:
        <?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::current(['tab' => 'passengers'])) ?>
    </h6>
    <?= $this->render('review/passengers', ['model' => $model]) ?>

    <div class="separator separator-dashed my-10"></div>
    <h6 class="font-weight-bolder mb-3">
        Other Statements:
        <?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::current(['tab' => 'statements'])) ?>
    </h6>
    <?= $this->render('review/statements', ['model' => $model]) ?>
    <?php $form = ActiveForm::begin() ?>
        <div class="form-group mt-10">
            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

            <?= Html::a('Previous', Url::current(['tab' => 'passengers']), [
                'class' => 'btn btn-light-primary font-weight-bold btn-lg'
            ]) ?>
            <?= Html::submitButton('Submit', [
                'class' => 'btn btn-success btn-lg font-weight-bold'
            ]) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>