<?php

use app\models\search\DashboardSearch;
use app\widgets\TwitterPost;
use app\widgets\FacebookTimeline;

$this->title = 'Disaster Prepareness: NDRRMC';
$this->params['breadcrumbs'][] = 'Disaster Prepareness';
$this->params['breadcrumbs'][] = 'NDRRMC';
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/disaster-preparedness/ndrrmc';
$this->params['wrapCard'] = false;

$this->registerJsFile('https://platform.twitter.com/widgets.js', ['async' => true]);
?>

<div class="dashboard-page">
	<section>
		<div class="row">
			<div class="col-md-8">
				<?= TwitterPost::widget(['name' => 'ndrrmc_opcen', 'height' => 700]) ?>
			</div>
			<div class="col-md-4">
				<?= FacebookTimeline::widget([
					'pageName' => 'NDRRMC',
					'pageLink' => 'https://www.facebook.com/NDRRMC',
					'height' => 700
				]) ?>
			</div>
		</div>
	</section>
</div>
