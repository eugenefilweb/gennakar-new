<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PdsCivilService */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'pds-civil-service-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'pds_id')->textInput() ?>
			<?= $form->field($model, 'career_service')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'date_of_examination')->textInput() ?>
			<?= $form->field($model, 'place_of_examination')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'license')->textarea(['rows' => 6]) ?>
			<?= ActiveForm::recordStatus([
                'model' => $model,
                'form' => $form,
            ]) ?>
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>