<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PdsWorkExperience */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'pds-work-experience-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'pds_id')->textInput() ?>
			<?= $form->field($model, 'from')->textInput() ?>
			<?= $form->field($model, 'to')->textInput() ?>
			<?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'salary_increment')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'appointment_status')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'government_service')->textInput() ?>
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