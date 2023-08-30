<?php

use app\models\search\DashboardSearch;
use app\widgets\TwitterPost;
use app\widgets\YoutubePage;
use app\widgets\FacebookTimeline;

$this->title = 'Disaster Prepareness: Announcement';
$this->params['breadcrumbs'][] = 'Disaster Prepareness';
$this->params['breadcrumbs'][] = 'Announcement';
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/disaster-preparedness/pagasa';
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page">

	<div class="row">
		<div class="col-md-12">
			<?= YoutubePage::widget() ?>
		</div>
	</div>
	<div class="my-10"></div>

	<div class="row">
		<div class="col-md-6 text-center">
			<?= FacebookTimeline::widget([
				'pageName' => 'DOST PAGASA',
				'pageLink' => 'https://www.facebook.com/PAGASA.DOST.GOV.PH',
				'height' => 700
			]) ?>
		</div>
		<div class="col-md-6">
			<?= TwitterPost::widget(['name' => 'dost_pagasa', 'height' => 700]) ?>
		</div>
	</div>
	<div class="my-10"></div>
</div>
