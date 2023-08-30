<?php

use app\helpers\App;
use app\widgets\BootstrapSelect;
use app\widgets\DatePicker;
?>

<section>
	<div class="row">
		<div class="col-md-12">
			<h3 class="card-label">Main Information</h3>
			 <hr/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= BootstrapSelect::widget([
				'form' => $form,
				'model' => $model,
				'attribute' => 'pwd_type',
				'data' => array_combine(App::params('pwd_form')['type'], App::params('pwd_form')['type']),
				'prompt' => false
			]) ?>
		</div>

		<div class="col-md-4">
			<?= $form->field($model, 'sector_id')->textInput([
				'maxlength' => true
			]) ?>
		</div>
		<div class="col-md-4">
			<?= DatePicker::widget([
				'form' => $form,
				'model' => $model,
				'attribute' => 'date_of_application',
			]) ?>
		</div>
		
	</div>
</section>		