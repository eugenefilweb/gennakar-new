<?php

use app\widgets\ActiveForm;
use app\widgets\Map;
?>

<?php $form = ActiveForm::begin(['id' => 'household-form']); ?>
	<h4 class="mb-10 font-weight-bold text-dark">Map Plotting</h4>
    <section class="mt-5">
	    <div class="row">
	    	<div class="col">
				<?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
	    	</div>
	    	<div class="col">
	    		<?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
	    	</div>
	    	<div class="col">
				<?= $form->field($model, 'altitude')->textInput(['maxlength' => true]) ?>
	    	</div>
	    </div>
        <?= Map::widget([
            'longitude' => $model->longitude,
            'latitude' => $model->latitude,
            'template' => 'general-setting'
        ]) ?>
	</section>

    <div class="form-group mt-5">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>