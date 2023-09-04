<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;

use app\models\search\PatrolSearch;

use app\widgets\Anchors;
use app\widgets\Detail;
use app\widgets\Grid;
use app\widgets\OpenLayer;


use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\models\Patrol */

$this->title = 'Patrol: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = $model->breadcrumb;
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = $model->searchModel;
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = $model->activeMenuLink;
$this->params['headerButtons'] = $model->createButton;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css',['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
// $this->registerJsFile('https://js.sentry-cdn.com/9c5feb5b248b49f79a585804c259febc.min.js', ['crossorigin' => 'anonymous', 'position' => View::POS_HEAD]);
$this->registerJsFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js', ['position' => View::POS_HEAD]);
$this->registerCssFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css',['position' => View::POS_HEAD]);
?>
<div class="patrol-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= App::if($model->isForValidation, Html::a('Validate', ['patrol/validate', 'id' => $model->id], [
        'class' => 'btn btn-primary font-weight-bold',
        'data-confirm' => 'Are you sure?',
        'data-method' => 'post'
    ])) ?>
    <div class="my-2"></div>
    <div class="row">
        <div class="col-md-7">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map Trail',
                 'toolbar' => Html::tag('div', Html::popupCenter('Print Report', Url::toRoute(['patrol/print-report', 'id' => $model->id]), ['class' => 'btn btn-success font-weight-bold']), [
                    'class' => 'card-toolbar'
                ]),
            ]) ?>


                <div id="map" style="height: 500px;"></div>
                



                <?php /* echo OpenLayer::widget([
                    'height' => '500px;',
                    'withSearch' => false,
                    'zoom' => 13,
                    'addMarkers' => false,
                    'coordinates' => $model->formattedCoordinates,
                    'withLine' => true,
                    'addStartMarker' => true,
                    'addEndMarker' => true,
                    // 'showCurrentLocation' => true,
                    'zoom' => 14
                ]) */?>



            <?php $this->endContent() ?>
        </div>
        <div class="col-md-5">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Patroller',
                'stretch' => true
            ]) ?>
                <div class="">
                    <div class="d-flex align-items-end py-2">
                        <div class="d-flex align-items-center">
                            <div class="d-flex flex-shrink-0 mr-5">
                                <div class="symbol symbol-circle symbol-lg-75">
                                    <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png" alt="image">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
                                    <?= $model->userFullname ?>
                                </a>
                                <span class="text-muted font-weight-bold">Patrol ID: <?= $model->tripId ?> <?= $model->statusBadge ?></span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->
                    <!--begin::Desc-->
                    <p class="py-2">
                        An estimated of <?= $model->travelHours ?> travel patrol recorded.
                        <?= $model->notes ? '<br>Notes: ' . $model->notes: '' ?>
                    </p>
                    <!--end::Desc-->
                    <!--begin::Contacts-->
                    <div class="pb-2">
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">
                                <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"></path>
                                        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"></path>
                                        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                </span>
                            </span>
                            <span class="text-muted font-weight-bold">Date: <?= $model->date ?></span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" fill="#000000"></path>
                                        </g>
                                    </svg>

                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <a href="#" class="text-muted text-hover-primary font-weight-bold">Encoded Data: + <?= number_format($model->totalTrees) ?> </a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="flex-shrink-0 mr-2">

                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                Distance: <?= App::formatter()->asDistance($model->distance) ?>
                            </a>
                        </div>
                    </div>
                    <!--end::Contacts-->
                    <!--begin::Actions-->
                    <div class="pt-2">
                        <!-- <a href="#" class="btn btn-primary font-weight-bolder mr-2">Contact</a> -->
                        <?= Html::a('Patroller Profile', $model->user->viewUrl, [
                            'class' => 'btn btn-light-primary font-weight-bolder',
                            'target' => '_blank'
                        ]) ?>
                    </div>
                    <!--end::Actions-->
                </div>
            <?php $this->endContent() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Encoded Trees',
                'toolbar' => '
                    <div class="card-toolbar">
                        '. Html::a('Add Tree Item', ['tree/create', 'patrol_id' => $model->id, 'referrer' => Url::current()], ['class' => 'btn btn-success font-weight-bold']) .'
                    </div>
                '
            ]) ?>
                <?= Grid::widget([
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                ]); ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>

//v1
<!-- <script>
                    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v12',
                        center: [<?= $model->formattedCoordinates[0]['lon'] ?>, <?= $model->formattedCoordinates[0]['lat'] ?>],
                        zoom: 14
                    });

                    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;

                    // console.log(coordinates);

                    // var route = {
                    //     type: 'Feature',
                    //     geometry: {
                    //         type: 'LineString',
                    //         coordinates: coordinates.map(coord => [coord.lon, coord.lat])
                    //     }
                    // };

                    // const coordinates = [
                    //     {"lat":"14.336127","lon":"121.0772825","timestamp":"1693181966446"},
                    //     {"lat":"14.3361662","lon":"121.0772149","timestamp":"1693181967515"},
                    //     {"lat":"14.3362019","lon":"121.0771479","timestamp":"1693181968449"},
                    //     {"lat":"14.3362321","lon":"121.0770857","timestamp":"1693181969424"},
                    //     {"lat":"14.3362645","lon":"121.0770191","timestamp":"1693181970518"},
                    //     {"lat":"14.3649585","lon":"121.0503392","timestamp":"1693183083511"},
                    //     {"lat":"14.364914","lon":"121.0502661","timestamp":"1693183085390"}
                    // ];

                    let waypoints = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
                    console.log(waypoints);


                    //     // Limit waypoints to 25
                    // if (waypoints.length > 25) {
                    //     const interval = Math.floor(waypoints.length / 25);
                    //     const filteredWaypoints = waypoints.filter((_, index) => index % interval === 0);
                    //     waypoints = [waypoints[0], ...filteredWaypoints, waypoints[waypoints.length - 1]];
                    // }

                    const waypointsCount = waypoints.length;
                    const waypointsMiddle = Math.floor(waypointsCount / 2);
                    waypoints = [waypoints[0], waypoints[waypointsMiddle-1], waypoints[waypointsCount - 1]];

                    console.log(waypoints);

                    const directions = new MapboxDirections({
                    accessToken: mapboxgl.accessToken,
                    unit: 'metric',                  // Choose the unit for distance ('imperial' or 'metric')
                    profile: 'mapbox/driving',       // Choose the profile for directions (e.g., 'mapbox/driving', 'mapbox/cycling')
                    alternatives: false,             // Show alternative routes (true/false)
                    controls: { inputs: false, instructions: false }, // Configure control elements
                    interactive: true                // Enable user interaction with the map
		            });

                    map.addControl(directions, 'top-left');

                    // // Set initial directions
                    // directions.setOrigin(start);
                    // directions.setDestination(end);

                    function loadDirections() {
                    for (let i = 0; i < waypoints.length; i++) {
                        if (i === 0) {
                        directions.setOrigin(waypoints[i]);
                        } else if (i === waypoints.length - 1) {
                        directions.setDestination(waypoints[i]);
                        } else {
                        directions.addWaypoint(i - 1, waypoints[i]);
                        }
                    }
                    // directions.route();
                    }

                    map.on('load',  function() {
                    loadDirections();
                    });

                    // map.on('load', function() {
                    //     map.addLayer({
                    //         id: 'route',
                    //         type: 'line',
                    //         source: {
                    //             type: 'geojson',
                    //             data: route
                    //         },
                    //         paint: {
                    //             'line-color': '#888',
                    //             'line-width': 6
                    //         }
                    //     });

                    //     var startCoord = coordinates[0];
                    //     var endCoord = coordinates[coordinates.length - 1];

                    //     new mapboxgl.Marker().setLngLat(startCoord).addTo(map);
                    //     new mapboxgl.Marker().setLngLat(endCoord).addTo(map);
                    // });

</script> -->

//v2
