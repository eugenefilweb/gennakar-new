<?php
use yii\web\YiiAsset;

// $this->registerWidgetJsFile('box');
// $this->registerJsFile('@assets/widget/js/box.js',['depends' => [YiiAsset::class]]);
$this->registerJsFile('@web/assets/box.js',['depends' => [YiiAsset::class]]);

$this->addCssFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');
$this->addJsFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');

$this->addJsFile([
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions'
]);
$this->addCssFile([
  'mapbox/api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions'
]);



?>


<div id="map">test</div>