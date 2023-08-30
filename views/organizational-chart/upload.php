<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\File;
use app\widgets\ActiveForm;
use app\widgets\Dropzone;

$this->title = 'Organizational Chart | Upload';
$this->params['breadcrumbs'][] = $this->title;
$this->params['activeMenuLink'] = '/organizational-chart/upload';

$orgChartFile = $model->getFile('org_chart');
?>
<?php $form = ActiveForm::begin(['id' => 'org-chart-form']); ?>
	<div class="row">
		<div class="col-md-4">
			<h5 class="mt-5">
				Organizational Chart
			</h5>
			 <?= Dropzone::widget([
		        'tag' => 'Org Chart',
		        'maxFiles' => 1,
		        'model' => $model,
		        'attribute' => 'org_chart',
		        'acceptedFiles' => File::imageFileExtensions(),
		        'complete' => "$('#org-chart-form').submit();"
		    ]) ?>
		</div>

		<div class="col-md-8">
			<h6 class="font-weight-bold">
				Last Updated: <?= $orgChartFile->createdAt ?>
				
				<?= Html::if($orgChartFile, fn ($file) => implode('', [
					Html::a('Download', $file->downloadUrl, [
		                'class' => 'btn btn-outline-secondary font-weight-bolder btn-sm'
		            ]),
		            Html::a('View', $file->viewerUrl, [
		                'class' => 'ml-1 btn btn-outline-secondary font-weight-bolder btn-sm',
		                'target' => '_blank'
		            ]),
				])) ?>
			</h6>
			<?= Html::image($orgChartFile, [], [
				'class' => 'img-fluid symbol',
				// 'style' => 'width: 100%'
			]) ?>
		</div>
	</div>
<?php ActiveForm::end(); ?>
