<?php

use app\widgets\ActiveForm;
use app\widgets\ImageGallery;
use app\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Watershed */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'watershed-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= Html::image($model->map, ['w' => 200], [
                'class' => 'img-thumbnail map-photo',
                'loading' => 'lazy',
            ] ) ?>

            <div class="mt-5">
                <?= ImageGallery::widget([
                    'tag' => 'Watershed',
                    'model' => $model,
                    'attribute' => 'map',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.map-photo').attr('src', s.src);
                        }
                    ",
                ]) ?> 
            </div>
        </div>
    </div>
    <div class="form-group mt-20">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>