<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'vehicle-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'year')->textInput() ?>
			<?= $form->field($model, 'is_commercial')->textInput() ?>
			<?= $form->field($model, 'driver_firstname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_middlename')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_lastname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_suffix')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_address')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_email')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_alt_contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'company_contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'type_of_cargo')->textInput() ?>
			<?= $form->field($model, 'or_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'or_no_date_issued')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'cr_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'cr_no_date_issued')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'insurance_company')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'insurance_type')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'coverage_start_date')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'coverage_end_date')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'insurance_status')->textInput() ?>
			<?= $form->field($model, 'passengers')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'driver_license_front')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'driver_license_back')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'or_photo')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'cr_photo')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'vehicular_accident_report_id')->textInput() ?>
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