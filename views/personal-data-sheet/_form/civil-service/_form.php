<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
	'id' => 'pds-form', 
	'action' => [
		"pds-civil-service/{$civilServiceAction}", 
		'successRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'civil-service'
		], true),
		'failedRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'civil-service',
			'template' => 'civil-service/create'
		], true),
		'id' => $civilService->id,
	]
]); ?>
	
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($civilService, 'career_service')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($civilService, 'rating')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->datePicker($civilService, 'date_of_examination') ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($civilService, 'place_of_examination')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($civilService, 'license')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->datePicker($civilService, 'license_date', ['endDate' => false]) ?>
		</div>
	</div>

	<?= $form->field($civilService, 'pds_id')->hiddenInput()->label(false) ?>
	<?= Html::a('Cancel', App::referrer(), [
            'class' => 'btn btn-light-danger font-weight-bold btn-lg',
        ]) ?>
	<?= $form->submitButton() ?>

<?php ActiveForm::end(); ?>