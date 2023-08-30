<?php

use app\models\search\DashboardSearch;
use app\widgets\TwitterPost;
use app\widgets\YoutubePage;
use app\widgets\FacebookTimeline;
use app\widgets\TwitterSearch;

$this->title = 'Disaster Prepareness: Phivolcs';
$this->params['breadcrumbs'][] = 'Disaster Prepareness';
$this->params['breadcrumbs'][] = 'Phivolcs';
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/disaster-preparedness/phivolcs';
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page">

	<div class="row">
		<div class="col-md-12">
			<?= YoutubePage::widget([
				'channelId' => 'UC2wloNmamASN3LtJhOVze2g'
			]) ?>
		</div>
	</div>
	<div class="my-10"></div>
	<div class="row">
		<div class="col-md-6 text-center">
			<?= FacebookTimeline::widget([
				'pageName' => 'PHIVOLCS-DOST',
				'pageLink' => 'https://www.facebook.com/PHIVOLCS',
				'height' => 700
			]) ?>
			<?php #TwitterPost::widget(['name' => 'phivolcs_dost', 'height' => 700]) ?>
		</div>
		<div class="col-md-6">
			<?= TwitterSearch::widget() ?>
		</div>
	</div>
	<div class="my-10"></div>
</div>