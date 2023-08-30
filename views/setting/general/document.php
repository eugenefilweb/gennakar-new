<?php

use app\helpers\Html;
use app\models\File;
use app\widgets\ActiveForm;
use app\widgets\Dropzone;

$dataPrivacyFile = $model->getFile('data_privacy');
$campManagementFile = $model->getFile('camp_management');
$orgChartFile = $model->getFile('org_chart');
$lccapFile = $model->getFile('lccap');
$ldrrmpFile = $model->getFile('ldrrmp');
?>
<?php $form = ActiveForm::begin(['id' => 'setting-general-notification-form']); ?>
    <h4 class="mb-10 font-weight-bold text-dark">Documents</h4>

	<div class="row">
		<div class="col-md-6">
			<h5 class="mt-5">
				Data Privacy
				<?= Html::if($dataPrivacyFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'Data Privacy',
		        'maxFiles' => 1,
		        'files' => $dataPrivacyFile ? [$dataPrivacyFile]: [],
		        'model' => $model,
		        'attribute' => 'data_privacy',
		        'acceptedFiles' => File::documentFileExtensions()
		    ]) ?>
		</div>
		<div class="col-md-6">
			<h5 class="mt-5">
				Camp Management
				<?= Html::if($campManagementFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'Camp Management',
		        'maxFiles' => 1,
		        'files' => $campManagementFile ? [$campManagementFile]: [],
		        'model' => $model,
		        'attribute' => 'camp_management',
		        'acceptedFiles' => '.pdf'
		    ]) ?>
		</div>
	</div>
	<div class="my-5"></div>
	<div class="row">
		<div class="col-md-6">
			<h5 class="mt-5">
				Organizational Chart
				<?= Html::if($orgChartFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'Org Chart',
		        'maxFiles' => 1,
		        'files' => $orgChartFile ? [$orgChartFile]: [],
		        'model' => $model,
		        'attribute' => 'org_chart',
		        'acceptedFiles' => File::imageFileExtensions()
		    ]) ?>

            <div class="mt-1">
            	Date Last Updated: <?= $orgChartFile ? $orgChartFile->createdAt: 'n/a' ?>
            </div>
		</div>
		<div class="col-md-6">
			<h5 class="mt-5">
				LCCAP
				<?= Html::if($lccapFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'LCCAP',
		        'maxFiles' => 1,
		        'files' => $lccapFile ? [$lccapFile]: [],
		        'model' => $model,
		        'attribute' => 'lccap',
		        'acceptedFiles' => File::documentFileExtensions()
		    ]) ?>
		</div>
	</div>

	<div class="my-5"></div>
	<div class="row">
		<div class="col-md-6">
			<h5 class="mt-5">
				LDRRMP
				<?= Html::if($ldrrmpFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'LDRRMP',
		        'maxFiles' => 1,
		        'files' => $ldrrmpFile ? [$ldrrmpFile]: [],
		        'model' => $model,
		        'attribute' => 'ldrrmp',
		        'acceptedFiles' => File::documentFileExtensions()
		    ]) ?>
		</div>
	</div>

	<div class="form-group"> <br>
		<?= ActiveForm::buttons() ?>
	</div>
<?php ActiveForm::end(); ?>