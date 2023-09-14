<?php

use app\helpers\App;

$this->addCssFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');
$this->addJsFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');

$this->registerWidgetCssFile('mapbox');
$this->registerWidgetJsFile('mapbox');

// if ($enableDrawing) {
// 	$this->addJsFile([
// 		'mapbox/unpkg.com/@turf/turf@6/turf.min',
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw'
// 	]);
// 	$this->addCssFile([
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw'
// 	]);
// }

// if ($enableGeocoder) {
// 	$this->addJsFile([
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min'
// 	]);
// 	$this->addCssFile([
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder'
// 	]);
// }

// if ($enableNavigationController) {
// 	$this->addJsFile([
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions'
// 	]);
// 	$this->addCssFile([
// 		'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions'
// 	]);
// }

// $this->registerJs(<<< JS
//     (new MapboxWidget({
//     	widgetId: 'mapbox-{$widgetId}',
//     	accessToken: '{$access_token}',
//     	styleUrl: '{$styleUrl}',
//     	lnglat: {$lnglat},
//     	enableGeocoder: {$enableGeocoder},
//     	zoom: {$zoom},
//     	// enableNavigationController: {$enableNavigationController},
//     	// enableDrawing: {$enableDrawing},
//     	// mapLoadScript: (map) => {
//     	// 	{$mapLoadScript}
//     	// },
//     	// initLoadScript: (obj) => {
//     	// 	{$initLoadScript}
//     	// },
//     	// dataloadingScript: (map, e) => {
//     	// 	{$dataloadingScript}
//     	// },
//     	// sourcedataScript: (map, e) => {
//     	// 	{$sourcedataScript}
//     	// },

//     })).init();
// JS);

?>
<div class="">
    <div id="mapbox-<?= $widgetId ?>" style="height: <?= $height ?>"></div>
    <?= App::if($enableDrawing == 'true', <<< HTML
	    <div class="calculation-box"> 
	    	<div id="calculated-area">
	    		Calculate Area by drawing
	    	</div>
	    </div>
	HTML) ?>
</div>