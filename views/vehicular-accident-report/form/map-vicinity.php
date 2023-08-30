<?php

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
use app\widgets\OpenLayer;
?>

<h4 class="mb-10 font-weight-bold text-dark">
    <?= $tabData['title'] ?>
</h4>

<?php $form = ActiveForm::begin() ?>
    <?= OpenLayer::widget([
        'latitude' => $model->latitude,
        'longitude' => $model->longitude,
        'clickCallback' => <<< JS
            $('#vehicularaccidentreport-latitude').val(lat);
            $('#vehicularaccidentreport-longitude').val(lon);
        JS
    ]) ?>
    <div class="row mt-10">
        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'longitude')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>

    <div class="form-group mt-10">
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
        <?= Html::a('Previous', Url::current(['tab' => 'general-information']), [
            'class' => 'btn btn-light-primary font-weight-bold btn-lg'
        ]) ?>
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg font-weight-bold'
        ]) ?>
    </div>
<?php ActiveForm::end() ?>