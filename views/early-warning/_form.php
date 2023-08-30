<?php

use app\models\File;
use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EarlyWarning */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'early-warning-form']); ?>
	<div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<p class="lead font-weight-bolder mt-10">BULLETIN</p>
	<div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'bulletin_no')->textInput(['maxlength' => true]) ?>
		</div>
        <div class="col-md-6">
			<?= $form->field($model, 'signal_no')->textInput(['type' => 'number']) ?>
		</div>
	</div>
	<div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
		</div>
        <div class="col-md-6">
			<?= $form->field($model, 'windspeed')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'meteorological_conditions')->textarea([
				'rows' => 6,
				'placeholder' => 'Provide a brief description of the meteorological conditions, such as heavy rainfall, strong winds, or storm surge, affecting the area.'
			]) ?>
		</div>
        <div class="col-md-6">
			<?= $form->field($model, 'impact_of_winds')->textarea([
				'rows' => 6,
				'placeholder' => 'Describe the potential effects of the wind, such as structural damage, power outages, or transportation disruptions.'
			]) ?>
		</div>
	</div>
	<div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'precautionary_measures')->textarea([
				'rows' => 6,
				'placeholder' => 'List the recommended precautionary measures for residents, businesses, and local authorities, such as evacuation plans, securing properties, or emergency preparedness measures.'
			]) ?>
		</div>
	</div>

	<p class="lead font-weight-bold mt-10">TEXT</p>
    <div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'entry_text')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
			<?= $form->field($model, 'attachment_text')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'other_text')->textarea(['rows' => 6]) ?>
        </div>
    </div>

	<p class="lead font-weight-bold mt-10">ATTACHMENTS</p>
	<div class="row">
        <div class="col-md-6">
			<?= $form->dropzone($model, 'attachments', 'Early Warning', [
        		'files' => $model->attachmentFiles,
				'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
			]) ?>
		</div>
	</div>


    <div class="form-group mt-10">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>