<?php

use app\helpers\App;
use app\helpers\Url;
$this->title = 'Typhoon Monitoring';

if (App::controller('layout') == 'print') {
	$this->params['sleep'] = 5000;
}
?>

<?php if (App::controller('layout') != 'print'): ?>
	<a class="btn btn-secondary font-weight-bolder btn-lg" target="_blank" href="<?= Url::to(['dashboard/typhoon-monitoring', 'layout' => 'print']) ?>">
		PRINT
	</a>
<?php endif ?>

<iframe width="100%" height="100%" src="https://embed.windy.com/embed2.html?lat=13.678&lon=121.635&detailLat=14.75689358&detailLon=121.6190742&width=700&height=500&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=true&calendar=now&pressure=true&type=map&location=coordinates&detail=true&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe>
