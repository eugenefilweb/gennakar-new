<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Statement */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'statement-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'vehicular_accident_report_id')->textInput() ?>
			<?= $form->field($model, 'type')->textInput() ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'statement')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'date')->textInput() ?>
			<?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'signature')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'contact_info')->textInput(['maxlength' => true]) ?>
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