<?php

use app\helpers\Url;
use app\widgets\Grid;
use app\widgets\ReportTemplate;
use app\widgets\TinyMce;


$this->title = 'Report: AICS';
$this->params['searchModel'] = $searchModel; 
$this->params['breadcrumbs'][] = $this->title;
$this->params['wrapCard'] = false; 
$this->params['searchKeywordUrl'] = Url::to(['report/aics-find-by-keywords']); 
$this->params['activeMenuLink'] = '/report/aics';
?>

<div class="report-page">
	
	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'SUMMARY REPORT',
		'toolbar' => <<< HTML
			<div class="card-toolbar">
				{$searchModel->aicsExportSummaryBtn}
			</div>
		HTML
	]); ?>
		<?= $this->render('_print-aics', [
			'searchModel' => $searchModel
		]) ?>
	<?php $this->endContent(); ?>


	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'CUSTOM REPORT',
	]); ?>
		<?= TinyMce::widget([
			'content' => ReportTemplate::widget() . <<< HTML
				<h2 style="text-align: center">CUSTOM REPORT</h2>
				<table style="width: 100%">
					<tbody>
						<tr><td></td><td></td><td></td><td></td></tr>
						<tr><td></td><td></td><td></td><td></td></tr>
					</tbody>
				</table>
			HTML
		]) ?>
	<?php $this->endContent(); ?>

	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'Transaction Items',
		'toolbar' => <<< HTML
			<div class="card-toolbar">
				{$searchModel->aicsExportTransactionBtn}
			</div>
		HTML
	]); ?>
		<?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'columns' => $searchModel->aicsColumns,
            'withActionColumn' => false
        ]); ?>
	<?php $this->endContent(); ?>
</div>