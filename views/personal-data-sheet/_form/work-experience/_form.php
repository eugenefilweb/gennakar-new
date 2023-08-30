<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\PdsWorkExperience;
use app\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
	'id' => 'pds-form', 
	'action' => [
		"pds-work-experience/{$workExperienceAction}", 
		'successRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'work-experience'
		], true),
		'failedRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'work-experience',
			'template' => 'work-experience/create'
		], true),
		'id' => $workExperience->id,
	]
]); ?>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($workExperience, 'position')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($workExperience, 'company')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?= $form->datePicker($workExperience, 'from') ?>
		</div>
		<div class="col-md-6">
			<?= $form->datePicker($workExperience, 'to') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($workExperience, 'salary')->textInput(['type' => 'number']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($workExperience, 'salary_increment')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($workExperience, 'appointment_status')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->bootstrapSelect($workExperience, 'government_service', [
				PdsWorkExperience::GOVERNMENT_YES => 'Yes',
				PdsWorkExperience::GOVERNMENT_NO => 'No',
			]) ?>
		</div>
	</div>

	<?= $form->field($workExperience, 'pds_id')->hiddenInput()->label(false) ?>
	<?= Html::a('Cancel', App::referrer(), [
            'class' => 'btn btn-light-danger font-weight-bold btn-lg',
        ]) ?>
	<?= $form->submitButton() ?>

<?php ActiveForm::end(); ?>