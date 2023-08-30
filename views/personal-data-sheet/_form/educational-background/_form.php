<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
	'id' => 'pds-form', 
	'action' => [
		"pds-education/{$educationAction}", 
		'successRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'educational-background'
		], true),
		'failedRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'educational-background',
			'template' => 'educational-background/create'
		], true),
		'id' => $education->id,
	]
]); ?>

	<div class="row">
		<div class="col-md-6">
			<?= $form->bootstrapSelect($education, 'level', ArrayHelper::combine([
				'Elementary',
				'Secondary',
				'Vocational / Training Course',
				'College',
				'Graduate Studies',
			])) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($education, 'name')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->datePicker($education, 'from') ?>
		</div>
		<div class="col-md-6">
			<?= $form->datePicker($education, 'to') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($education, 'course')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($education, 'highest_level')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($education, 'year_graduated')->textInput(['type' => 'number']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($education, 'academic_honor')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<?= $form->field($education, 'pds_id')->hiddenInput()->label(false) ?>
	<?= Html::a('Cancel', App::referrer(), [
            'class' => 'btn btn-light-danger font-weight-bold btn-lg',
        ]) ?>
	<?= $form->submitButton() ?>

<?php ActiveForm::end(); ?>