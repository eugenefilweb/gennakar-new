<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\CivilStatus;
use app\models\Database;
use app\models\PwdType;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\ImageGallery;

$this->registerJs(<<< JS
	function getAge(dateString) {
		var ageInMilliseconds = new Date() - new Date(dateString);
		return Math.floor(ageInMilliseconds/1000/60/60/24/365); // convert to years
	}

	$(document).on('change', '#database-date_of_birth', function() {
		let birthDate = $(this).val();

		$('#database-age').val(getAge(birthDate));
	});
JS);
?>

<section>
	<div class="row">
		<div class="col-md-12">
			<h3 class="card-label">Primary Information</h3>
			 <hr/>
		</div>
	</div>

	<div class="row mb-5">
		<div class="col-md-4">
			<table class="table table-bordered table-foot-solid">
				<tbody>
					<tr>
						<td>
							<?= Html::image($model->photo, ['w'=>100], [
				                'class' => 'img-thumbnail user-photo',
				                'loading' => 'lazy',
				            ] ) ?>
						</td>
						<td>
							<?= Html::image($model->signature, ['w' => 100], [
				                'class' => 'img-thumbnail user-signature',
				                'loading' => 'lazy',
				            ] ) ?>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<?= ImageGallery::widget([
								'tag' => 'Database',
				            	'buttonTitle' => 'Profile Photo',
				                'model' => $model,
				                'attribute' => 'photo',
				                'ajaxSuccess' => "
				                    if(s.status == 'success') {
				                        $('.user-photo').attr('src', s.src);
				                    }
				                ",
				            ]) ?> 
						</td>
						<td>
							<?= ImageGallery::widget([
								'tag' => 'Database',
				            	'buttonTitle' => 'Upload Signature',
				                'model' => $model,
				                'attribute' => 'signature',
				                'finalCropWidth' => 500,
				                'finalCropHeight' => 300,
				                'ajaxSuccess' => "
				                    if(s.status == 'success') {
				                        $('.user-signature').attr('src', s.src);
				                    }
				                ",
				            ]) ?> 
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'preferred_name')->textInput([
				'maxlength' => true
			]) ?>
		</div>	
	</div>

 
	
	<div class="row">
		<div class="col-md-4">
			<?= $form->field($model, 'first_name')->textInput([
				'maxlength' => true
			]) ?>
		</div>			
		<div class="col-md-4">
			<?= $form->field($model, 'middle_name')->textInput([
				'maxlength' => true
			]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'last_name')->textInput([
				'maxlength' => true
			]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= DatePicker::widget([
				'form' => $form,
				'model' => $model,
				'attribute' => 'date_of_birth',
			]) ?>
		</div>
		<div class="col-md-4">
			<?= BootstrapSelect::widget([
				'form' => $form,
				'model' => $model,
				'label' => 'Sex',
				'attribute' => 'gender',
				'data' => ['Male' => 'Male', 'Female' => 'Female'],
			]) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'sogie')->textInput([
				'maxlength' => true
			])->label('Sogie / Gender') ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= DataList::widget([
				'form' => $form,
				'model' => $model,
				'attribute' => 'occupation',
				'data' => Database::filter('occupation'),
			]) ?>
		</div>
	</div>
</section>		