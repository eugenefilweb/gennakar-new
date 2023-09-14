<?php

use app\helpers\App;
use yii\web\View;

// $this->addCssFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');
// $this->addJsFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);

// $this->registerWidgetCssFile('mapbox');
// $this->registerWidgetJsFile('mapboxgl');
$this->registerWidgetJsFile('pam');

// $this->registerJs(<<< JS
//     (new MapboxWidget({
//     	widgetId: 'mapbox-{$widgetId}',
//     	accessToken: '{$access_token}',
// 			center: [121.154,14.54],
// 			zoom: 12,
			
//     })).init();
// JS);

$this->registerJs(<<< JS
    (new MapboxWidget({
    	widgetId: 'map',
    	accessToken: '{$access_token}',
    })).init();
JS);

?>

<div id="map" style="height: <?= $height ?>">test</div>
