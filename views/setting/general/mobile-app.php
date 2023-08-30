<?php

use app\modules\api\v1\helpers\Html;
use app\widgets\ActiveForm;
use app\widgets\ImageGallery;
?>
<?php $form = ActiveForm::begin(['id' => 'setting-general-mobile-app-form']); ?>
	<h4 class="mb-10 font-weight-bold text-dark">Mobile Application</h4>
	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'coordinate_frequency_tracking')->textInput([
				'type' => 'number',
			]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'coordinate_radius_tracking')->textInput([
				'type' => 'number'
			]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'photos_per_category')->textInput([
				'type' => 'number'
			]) ?>
		</div>
	</div> 
	
	<div class="form-group"> <br>
		<?= ActiveForm::buttons() ?>
	</div>
<?php ActiveForm::end(); ?>