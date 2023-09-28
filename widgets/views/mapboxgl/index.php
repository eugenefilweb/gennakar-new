<?php

use app\helpers\App;
use Yii\web\View;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);

$this->registerJsFile('/assets/widget/js/mapboxgl.js');

$this->addJsFile([
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min'
]);
$this->addCssFile([
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder'
]);

$this->addJsFile([
  'mapbox/unpkg.com/@turf/turf@6/turf.min',
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw'
]);
$this->addCssFile([
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.4.0/mapbox-gl-draw'
]);

$this->registerWidgetCssFile('mapbox');

$center = json_encode($center);
$zoom = json_encode($zoom);
$coordinates = json_encode($coordinates);

$this->registerJs(<<<JS

  new MapboxWidget({
    'center' : {$center},
    'zoom' : {$zoom},
    'accessToken' : 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg',
    'coordinates': {$coordinates}
  }).init();

JS);

?>

<div id="mapbox" style="height: 100%;"></div>

<div class="">
    <div id="mapbox" style="height: 100%;"></div>
    <?= App::if($enableDrawing == 'true', <<< HTML
	    <div class="calculation-box"> 
	    	<div id="calculated-area">
	    		Calculate Area by drawing
	    	</div>
	    </div>
	HTML) ?>

</div>