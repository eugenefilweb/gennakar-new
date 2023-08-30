<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PdsEducation */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'pds-education-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'pds_id')->textInput() ?>
			<?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'course')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'highest_level')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'year_graduated')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'academic_honor')->textInput(['maxlength' => true]) ?>
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