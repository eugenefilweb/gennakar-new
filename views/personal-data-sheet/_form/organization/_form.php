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
		"pds-organization/{$organizationAction}", 
		'successRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'organization'
		], true),
		'failedRedirect' => Url::toRoute([
			"personal-data-sheet/{$action}", 
			'token' => $model->token, 
			'step' => 'organization',
			'template' => 'organization/create'
		], true),
		'id' => $organization->id,
	]
]); ?>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($organization, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($organization, 'position')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($organization, 'address')->textarea(['rows' => 6]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->datePicker($organization, 'from') ?>
		</div>
		<div class="col-md-6">
			<?= $form->datePicker($organization, 'to') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($organization, 'no_of_hours')->textInput(['type' => 'number']) ?>
		</div>
	</div>

	<?= $form->field($organization, 'pds_id')->hiddenInput()->label(false) ?>
	<?= Html::a('Cancel', App::referrer(), [
            'class' => 'btn btn-light-danger font-weight-bold btn-lg',
        ]) ?>
	<?= $form->submitButton() ?>

<?php ActiveForm::end(); ?>