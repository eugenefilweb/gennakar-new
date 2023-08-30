<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PdsTrainingProgram */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'pds-training-program-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'pds_id')->textInput() ?>
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'from')->textInput() ?>
			<?= $form->field($model, 'to')->textInput() ?>
			<?= $form->field($model, 'no_of_hours')->textInput() ?>
			<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'conducted')->textInput(['maxlength' => true]) ?>
			<?= ActiveForm::recordStatus([
                'model' => $model,
                'form' => $form,
            ]) ?>
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>