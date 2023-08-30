<?php

use app\widgets\OpenLayer;
use app\helpers\Html;
use app\widgets\Value;

?>
<h4 class="mb-10 font-weight-bold text-dark">Map View
    <?= Html::a('<i class="fa fa-edit text-warning"></i>', ['update', 'no' => $model->no, 'step' => 'map'], [
        'data-toggle' => 'tooltip',
        'title' => 'Edit'
    ]) ?>
</h4>
<section class="mt-5">
    <div class="row">
        <div class="col">
            <?= Value::widget([
                'model' => $model,
                'attribute' => 'latitude',
            ]) ?>
        </div>
        <div class="col">
            <?= Value::widget([
                'model' => $model,
                'attribute' => 'longitude',
            ]) ?>
        </div>
        <div class="col">
            <?= Value::widget([
                'model' => $model,
                'attribute' => 'altitude',
            ]) ?>
        </div>
    </div>
</section>
<section class="mt-5">
    <?= OpenLayer::widget([
        'latitude' => $model->latitude,
        'longitude' => $model->longitude,
    ]) ?>
</section>
