<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\models\File;
use app\models\form\setting\SystemSettingForm;
use app\models\search\ThemeSearch;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\Dropzone;

$dataPrivacyFile = $model->dataPrivacyFile;
?>
<?php $form = ActiveForm::begin(['id' => 'setting-general-notification-form']); ?>
    <h4 class="mb-10 font-weight-bold text-dark">System</h4>
	<div class="row">
		<div class="col-md-4">
			<?= BootstrapSelect::widget([
	            'attribute' => 'timezone',
	            'model' => $model,
	            'form' => $form,
	            'data' => App::component('general')->timezoneList(),
	        ]) ?>
		</div>
		<div class="col-md-4">
	        <?= $form->field($model, 'pagination')->dropDownList(
			    App::params('pagination'), [
			        'class' => "form-control kt-selectpicker",
			    ]
			) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'auto_logout_timer')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="row">
		 <div class="col-md-4"> 
			<?= BootstrapSelect::widget([
	            'attribute' => 'theme',
	            'model' => $model,
	            'form' => $form,
	            'data' => ThemeSearch::dropdown(),
	            'searchable' => false,
	            'options' => [
			        'class' => 'kt-selectpicker form-control',
			    ]
	        ]) ?>
		</div> 
		<div class="col-md-4">
            <?= BootstrapSelect::widget([
	            'attribute' => 'whitelist_ip_only',
	            'model' => $model,
	            'form' => $form,
	            'label' => 'Ip Access',
	            'data' => App::keyMapParams('whitelist_ip_only'),
	            'searchable' => false,
	            'options' => [
			        'class' => 'kt-selectpicker form-control',
			    ]
	        ]) ?>
		</div>
		<div class="col-md-4">
            <?= BootstrapSelect::widget([
	            'attribute' => 'enable_visitor',
	            'model' => $model,
	            'form' => $form,
	            'label' => 'Enable Visitor',
	            'data' => App::keyMapParams('enable_visitor'),
	            'searchable' => false,
	            'options' => [
			        'class' => 'kt-selectpicker form-control',
			    ]
	        ]) ?>
		</div>
	</div>


	<h5 class="mt-5">Organizational Chart</h5>

	<div class="row">
		<div class="col-md-4">
	        <?= BootstrapSelect::widget([
	            'attribute' => 'organizational_chart_subscribe',
	            'model' => $model,
	            'form' => $form,
	            'label' => 'Enable Subscription',
	            'data' => [
	            	0 => 'Disable',
	            	1 => 'Enable'
	            ],
	            'searchable' => false,
	            'options' => [
			        'class' => 'kt-selectpicker form-control',
			    ]
	        ]) ?>
		</div>
		<div class="col-md-4">
	        <?= BootstrapSelect::widget([
	            'attribute' => 'organizational_chart_template',
	            'model' => $model,
	            'form' => $form,
	            'data' => ArrayHelper::combine(SystemSettingForm::ORG_CHART_TEMPLATE),
	        ]) ?>
		</div>
	</div>

	<div class="form-group"> <br>
		<?= ActiveForm::buttons() ?>
	</div>
<?php ActiveForm::end(); ?>