<?php

use app\models\LocalGovernmentUnit;
use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LocalGovernmentUnit */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'local-government-unit-form']); ?>
    <div class="row">
        <div class="col-md-6">
        	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        		'title' => 'LGU Details',
        		'stretch' => true
        	]) ?>
	        	<?= $form->field($model, 'lgu_name')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'lgu_address')->textarea(['rows' => 6]) ?>

				<?= $form->dataList($model, 'lgu_classification', LocalGovernmentUnit::filter('lgu_classification')) ?>
				<?= $form->dataList($model, 'lgu_region', LocalGovernmentUnit::filter('lgu_region')) ?>
        	<?php $this->endContent() ?>

        </div>
        <div class="col-md-6">
        	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        		'title' => 'Assessed By'
        	]) ?>
				<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

				<?= $form->datePicker($model, 'date_of_assessment') ?>
				<?= $form->datetimePicker($model, 'date_submitted') ?>
        	<?php $this->endContent() ?>
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons('lg') ?>
    </div>
<?php ActiveForm::end(); ?>