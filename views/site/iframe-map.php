<?php

use app\widgets\OpenLayer;
$this->title = 'Iframe Map';
?>

<?= OpenLayer::widget([
    'height' => '100vh;',
    'withSearch' => false,
    'zoom' => 13,
    'addMarkers' => false,
    'coordinates' => $model->formattedCoordinates,
    'withLine' => true,
    'addStartMarker' => true,
    'addEndMarker' => true,
    'showCurrentLocation' => true,
    'zoom' => 14
]) ?>