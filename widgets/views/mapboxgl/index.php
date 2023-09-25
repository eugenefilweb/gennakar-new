<?php

use Yii\web\View;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);

$this->registerJsFile('/assets/widget/js/mapboxgl.js');


$center = json_encode($center);
$zoom = json_encode($zoom);
// $accesToken = json_encode($accessToken);

$this->registerJs(<<<JS

  new MapboxWidget({
    'center' : $center,
    'zoom' : $zoom,
    'accessToken' : 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg'
  }).init();

JS);

?>

<div id="mapbox" style="height: 100%;"></div>