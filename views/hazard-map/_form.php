<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\File;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;

/* @var $this yii\web\View */
/* @var $model app\models\HazardMap */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'hazard-map-form']); ?>
    <div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

            <?= Dropzone::widget([
                'maxFiles' => 4,
                'tag' => 'Hazard Map',
                'files' => $model->files,
                'model' => $model,
                'attribute' => 'gallery',
                'acceptedFiles' => File::imageFileExtensions()
            ]) ?>
        </div>
        <div class="col-md-6 text-center">
            <?= Html::image($model->photo, ['w' => 200], [
                'class' => 'img-thumbnail map-photo',
                'loading' => 'lazy',
            ] ) ?>
            <div class="my-2"></div>
            <?= ImageGallery::widget([
                'buttonTitle' => 'Choose Main Photo',
                'tag' => 'Hazard Map',
                'model' => $model,
                'attribute' => 'photo',
                'ajaxSuccess' => <<< JS
                    if(s.status == 'success') {
                        $('.map-photo').attr('src', s.src);
                    }
                JS,
            ]) ?> 
        </div>
    </div>
    <div class="form-group mt-10">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>