<?php

use app\helpers\App;

$this->addCssFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');
$this->addJsFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');

$this->registerWidgetCssFile('mapbox');
$this->registerWidgetJsFile('mapbox-gl');

$this->registerJs(<<< JS
    (new MapboxWidget({
    	widgetId: 'mapbox-{$widgetId}',
    	accessToken: '{$access_token}',
    	styleUrl: '{$styleUrl}',
    	lnglat: {$lnglat},
    	enableGeocoder: {$enableGeocoder},
    	zoom: {$zoom},
    	enableNavigationController: {$enableNavigationController},
    	enableDrawing: {$enableDrawing},
    	mapLoadScript: (map) => {
    		{$mapLoadScript}
    	},
    	initLoadScript: (obj) => {
    		{$initLoadScript}
    	},
    	dataloadingScript: (map, e) => {
    		{$dataloadingScript}
    	},
    	sourcedataScript: (map, e) => {
    		{$sourcedataScript}
    	},

    })).init();
JS);

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