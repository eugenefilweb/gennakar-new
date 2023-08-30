<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnvironmentalIncident */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'environmental-incident-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'user_id')->textInput() ?>
			<?= $form->field($model, 'date_time')->textInput() ?>
			<?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'watershed')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'additional_details')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'photos')->textarea(['rows' => 6]) ?>
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