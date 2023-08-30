<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Meeting */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'meeting-form']); ?>
    <div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
        	<div class="row">
        		<div class="col-md-6">
					<?= $form->datetimePicker($model, 'date_from') ?>
        		</div>
        		<div class="col-md-6">
					<?= $form->datetimePicker($model, 'date_to') ?>
        		</div>
        	</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
			<?= $form->field($model, 'remarks')->textarea([
				'rows' => 6,
			]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
			<label class="lead font-weight-bold mt-10">Minutes</label>
			<?= $form->dropzone($model, 'minutes_files', 'Meeting Minutes', [
				'files' => $model->minutesFiles
			]) ?>
        </div>
        <div class="col-md-6">
			<label class="lead font-weight-bold mt-10">Attendance</label>
			<?= $form->dropzone($model, 'attendance_files', 'Meeting Attendance', [
				'files' => $model->attendanceFiles
			]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
			<label class="lead font-weight-bold mt-10">Resolutions</label>
			<?= $form->dropzone($model, 'resolutions_file', 'Meeting Resolutions', [
				'files' => $model->resolutionsFiles
			]) ?>
        </div>
        <div class="col-md-6">
			<label class="lead font-weight-bold mt-10">Photos</label>
			<?= $form->dropzone($model, 'photos', 'Meeting Photos', [
				'files' => $model->photosFiles
			]) ?>
        </div>
    </div>

    <div class="form-group mt-10">
		<?= ActiveForm::buttons('lg') ?>
    </div>
<?php ActiveForm::end(); ?>