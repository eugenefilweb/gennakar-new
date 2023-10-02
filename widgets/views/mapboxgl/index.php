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

// $center = json_encode($center);
// $zoom = json_encode($zoom);
// $patrolCoordinates = json_encode($patrolCoordinates);
// $accessToken = json_encode($accessToken);
// $multipleDirections = json_encode($multipleDirections);
// $faunaCoordinates = json_encode($faunaCoordinates);
// $floraCoordinates = json_encode($floraCoordinates);

$this->registerJs(<<<JS

  new MapboxWidget({
    'center' : {$center},
    'zoom' : {$zoom},
    'accessToken' : '{$accessToken}',
    'patrolCoordinates': {$patrolCoordinates},
    'floraCoordinates' : {$floraCoordinates},
    'faunaCoordinates' : {$faunaCoordinates},
    'enableDrawing' : {$enableDrawing},
    'multipleDirections' : {$multipleDirections},
  }).init();

JS);

?>

<div id="mapbox" style="height: <?=$height ?>"></div>

<div class="">
    <div id="mapbox" style="height: <?=$height?>"></div>
    <?= App::if($enableDrawing == 'true', <<< HTML
	    <div class="calculation-box"> 
	    	<div id="calculated-area">
	    		Calculate Area by drawing
	    	</div>
	    </div>
	HTML) ?>

</div>

