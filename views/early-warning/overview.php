<?php

use app\helpers\Html;
use app\widgets\FacebookTimeline;
use app\widgets\OpenWeatherApi;
use app\widgets\TwitterPost;
use app\widgets\Windy;

$this->title = 'Early Warning | Overview';
$this->params['wrapCard'] = false;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/early-warning/overview';
$this->params['headerButtons'] = Html::a('Create Bulletin', ['early-warning/create'], [
	'class' => 'btn btn-success font-weight-bolder'
]);
?>

<div class="early-warning-overview-page">
	
	<div class="row">
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Typhoon Monitoring',
				'stretch' => true,
			]) ?>
			<?= Windy::widget() ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'PAGASA Satellite',
				'stretch' => true
			]) ?>
				<img class="img-fluid" loading="lazy" src="http://src.meteopilipinas.gov.ph/repo/mtsat-colored/24hour/latest-him-colored.gif" style="border-radius: 10px;">
			<?php $this->endContent() ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'DOST PAGASA',
				'bodyStyle' => 'padding:1rem;'
			]) ?>
				<?= FacebookTimeline::widget([
					'pageName' => 'DOST PAGASA',
					'pageLink' => 'https://www.facebook.com/PAGASA.DOST.GOV.PH',
					'height' => 700
				]) ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-4">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'PHIVOLCS-DOST',
				'bodyStyle' => 'padding:1rem;'
			]) ?>
				<?= FacebookTimeline::widget([
					'pageName' => 'PHIVOLCS-DOST',
					'pageLink' => 'https://www.facebook.com/PHIVOLCS',
					'height' => 700
				]) ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-4">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'General Nakar',
				'bodyStyle' => 'padding:1rem;'
			]) ?>
				<?= FacebookTimeline::widget([
					'pageName' => 'General Nakar',
					'pageLink' => 'https://www.facebook.com/GeneralNakarLGU/',
					'height' => 700
				]) ?>
			<?php $this->endContent() ?>
		</div>
	</div>

	<div class="row mb-7">
		<div class="col-md-6">
			<?= TwitterPost::widget([
				'name' => 'dost_pagasa',
				'height' => 700,
			]) ?>
		</div>
		<div class="col-md-6">
			<?= TwitterPost::widget([
				'name' => 'phivolcs_dost',
				'height' => 700,
			]) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?= OpenWeatherApi::widget([
				'withPrint' => true
			]) ?>
		</div>
	</div>
</div>