<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Passenger */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'passenger-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'alternate_contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'age')->textInput() ?>
			<?= $form->field($model, 'sex')->textInput() ?>
			<?= $form->field($model, 'health_condition')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'medical_complaint')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'condition')->textInput() ?>
			<?= $form->field($model, 'vehicular_accident_report_id')->textInput() ?>
			<?= $form->field($model, 'vehicle_id')->textInput() ?>
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