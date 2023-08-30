<?php

$this->addJsFile('openlayer/js/ol');

$this->addCssFile('ol-geocoder/ol-geocoder.min');
$this->addJsFile('ol-geocoder/ol-geocoder');

$this->registerWidgetCssFile('open-layer');
$this->registerWidgetJsFile('open-layer');

$this->registerJs(<<< JS
    var olw = new OperLayerWidget({
    	widgetId: '{$widgetId}',
    	lat: {$latitude},
    	lon: {$longitude},
    	zoom: {$zoom},
    	clickCallback: (e, {lat, lon}) => {
    		{$clickCallback}
    	},
        clickable: {$clickable},
        withLine: {$withLine},
        withSearch: {$withSearch},
        clearMarkersOnClick: {$clearMarkersOnClick},
        addMarkers: {$addMarkers},
        addStartMarker: {$addStartMarker},
        addEndMarker: {$addEndMarker},
        coordinates: {$coordinates},
        multipleCoordinates: {$multipleCoordinates},
        showCurrentLocation: {$showCurrentLocation},
    });

    setTimeout(() => {
        olw.init();
        document.getElementById('popup-{$widgetId}').style.display = 'block';
    }, 500);
JS);
?>

<div id="open-layer-<?= $widgetId ?>" style="height: <?= $height ?>;" class="open-layer-map"></div>
<div id="popup-<?= $widgetId ?>" title="myproject" class="ol-popup">
    <a href="#" id="popup-closer-<?= $widgetId ?>" class="ol-popup-closer"></a>
    <div id="popup-content-<?= $widgetId ?>"></div>
</div>
