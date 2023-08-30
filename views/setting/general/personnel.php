<?php

use app\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['id' => 'setting-personnel-form']); ?>
    <h4 class="mb-10 font-weight-bold text-dark">Personnels</h4>
	<p class="lead font-weight-bold mt-10">MAYOR</p>
	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'mayor_firstname')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'mayor_middlename')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'mayor_lastname')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<!-- <p class="lead font-weight-bold mt-10">LDRRMO III</p>
	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'ldrrmo_iii_name')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'ldrrmo_iii_contact')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<p class="lead font-weight-bold mt-10">MDRRMO</p>
	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'mdrrmo_name')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'mdrrmo_contact')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
 -->
	<div class="form-group"> <br>
		<?= ActiveForm::buttons() ?>
	</div>
<?php ActiveForm::end(); ?>