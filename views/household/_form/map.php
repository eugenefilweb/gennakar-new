<?php

use app\helpers\Url;
use app\widgets\OpenLayer;
use app\helpers\Html;
use app\widgets\ActiveForm;
?>

<h4 class="mb-10 font-weight-bold text-dark">Map Plotting</h4>

<?php $form = ActiveForm::begin(['id' => 'household-form']); ?>
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
        
		<?= OpenLayer::widget([
			'latitude' => $model->latitude,
			'longitude' => $model->longitude,
			'clickCallback' => <<< JS
				$('#household-latitude').val(lat);
				$('#household-longitude').val(lon);
			JS
		]) ?>
	</section>

    <div class="form-group mt-5">
		<?= Html::a('Back', Url::current(['step' => 'general-information']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>