<?php

use app\helpers\App;
use app\helpers\Url;
use app\widgets\FacebookTimeline;
use app\widgets\LatestEvents;
use app\widgets\OpenWeatherApi;
use app\widgets\TwitterPost;
use app\widgets\WeatherApi;
use app\widgets\Windy;

$this->title = 'Dashboard';
$this->params['searchModel'] = $searchModel; 
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = '/dashboard';

$this->registerJs(<<< JS
	var img = document.getElementById("pagasa-image");

	setInterval(function() {
	  img.src = img.src + "?timestamp=" + new Date().getTime();
	  console.log('log')
	}, 5 * (60 * 1000));
JS);
?>
<div class="dashboard-page">
	<div class="row">
		<div class="col-md-12 open-weather-api-container">
			<?= OpenWeatherApi::widget([
				'withPrint' => true,
				'autoRefresh' => true,
				// 'autoRefreshInterval' => 3000,
				'autoRefreshCallback' => <<< JS
					$('.open-weather-api-container').html(s.weather);
				JS
			]) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Typhoon Monitoring',
				'stretch' => true,
				// 'toolbar' => '
				// 	<div class="card-toolbar">
				// 		<a target="_blank" class="btn btn-secondary font-weight-bold" href="'. Url::to(['dashboard/typhoon-monitoring']) .'">View Details</a>
				// 	</div>
				// '
			]) ?>
			<?= Windy::widget() ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'PAGASA Satellite',
				'stretch' => true
			]) ?>
				<img id="pagasa-image" class="img-fluid" loading="lazy" src="http://src.meteopilipinas.gov.ph/repo/mtsat-colored/24hour/latest-him-colored.gif" style="border-radius: 10px;">
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
</div>
