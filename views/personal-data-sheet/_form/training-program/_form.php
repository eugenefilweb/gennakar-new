<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
	'id' => 'pds-form', 
	'action' => [
		"pds-training-program/{$trainingProgramAction}", 
		'successRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'training-program'
		], true),
		'failedRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'training-program',
			'template' => 'training-program/create'
		], true),
		'id' => $trainingProgram->id,
	]
]); ?>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($trainingProgram, 'title')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($trainingProgram, 'type')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->datePicker($trainingProgram, 'from') ?>
		</div>
		<div class="col-md-6">
			<?= $form->datePicker($trainingProgram, 'to') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($trainingProgram, 'no_of_hours')->textInput([
				'type' => 'number'
			]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($trainingProgram, 'conducted')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<?= $form->field($trainingProgram, 'pds_id')->hiddenInput()->label(false) ?>
	<?= Html::a('Cancel', App::referrer(), [
            'class' => 'btn btn-light-danger font-weight-bold btn-lg',
        ]) ?>
	<?= $form->submitButton() ?>

<?php ActiveForm::end(); ?>