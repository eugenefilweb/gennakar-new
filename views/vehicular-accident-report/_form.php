<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VehicularAccidentReport */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'vehicular-accident-report-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'control_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'main_cause')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'vehicles_involved')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'photos')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'other_damages')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'collision_type')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'weather_condition')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'road_condition')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'barangay')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'landmarks')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'road_type')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'preferred_by')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'noted_by')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'sketch')->textInput(['maxlength' => true]) ?>
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