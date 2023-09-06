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
<style>

/* #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    } */
        .marker {
        /* background-image: url('https://freepngimg.com/thumb/map/66932-openstreetmap-map-google-icons-maps-computer-marker.png'); */
        /* background-size: cover; */
        background-color: gray;
        width: 7px;
        height: 7px;
        /* border: 2px solid green; */
        border-radius: 50%;
        cursor: pointer;
    }

    .mapboxgl-popup {
        max-width: 200px;
    }

    .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    }
</style>

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

<script>

        var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
        let waypoints = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);

        mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

        const endpoints = [waypoints[0], waypoints[waypoints.length -1]];
        const center = waypoints[Math.floor(waypoints.length/2) -1];

        // Calculate the bounding box
        const bounds = waypoints.reduce(function(bounds, coord) {
            return bounds.extend(coord);
        }, new mapboxgl.LngLatBounds(waypoints[0], waypoints[0]));

        const map1 = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: bounds.getCenter(),
            zoom: 16
        });

        map1.on('load', () => {
            map1.addSource('lines', {
                'type': 'geojson',
                'data': {
                    'type': 'FeatureCollection',
                    'features': [
                        {
                            'type': 'Feature',
                            'properties': {
                                // 'color': '#F7455D' // red
                                'color': '#33C9EB' // blue
                            },
                            'geometry': {
                                'type': 'LineString',
                                'coordinates': waypoints
                            }
                        }
                    ]
                }
            });

            map1.addLayer({
                'id': 'lines',
                'type': 'line',
                'source': 'lines',
                'paint': {
                    'line-width': 15,
                    'line-color': ['get', 'color']
                }
            });
        
            const geojson = {
            'type': 'FeatureCollection',
            'features': []
            };

            for (const waypoint of waypoints) {
            geojson.features.push({
                'type': 'Feature',
                'geometry': {
                'type': 'Point',
                'coordinates': waypoint
                },
                'properties': {
                'title': 'Mapbox',
                'description': 'Washington, D.C.'
                }
            });
            }

            // add markers to map
            for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';

            // make a marker for each feature and add it to the map
            new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(new mapboxgl.Popup({
                offset: 25
            }) // add popups
            .setHTML(` < h3 > $ {
                feature.properties.title
            } < /h3><p>${feature.properties.description}</p > `)).addTo(map1);
            }

            // Add markers with rotation based on bearing
            for (let i = 0; i < endpoints.length; i++) {
                const feature = {
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: endpoints[i]
                    },
                    properties: {
                        title: 'Mapbox',
                        description: 'Washington, D.C.'
                    }
                };

                const rotation = 0;

                new mapboxgl.Marker({ rotation: rotation })
                    .setLngLat(feature.geometry.coordinates)
                    .setPopup(new mapboxgl.Popup({
                        offset: 25
                    })
                    .setHTML(`<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`))
                    .addTo(map1);
            }

        });

</script>

<!-- <script>

    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
    let waypoints1 = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);

    mapboxgl.accessToken = 'pk.eyJ1IjoiZXhhbXBsZXMiLCJhIjoiY2p0MG01MXRqMW45cjQzb2R6b2ptc3J4MSJ9.zA2W0IkI0c6KaAhJfk9bWg';
		const map1 = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v12',
			center: [121.0772825, 14.336127],
			zoom: 13
		});

    // let waypoints1=[[121.0356339,14.5757805],[121.0357106,14.5757503],[121.0357937,14.5757234],[121.0358788,14.5757098],[121.0359599,14.5757066],[121.0360376,14.5757147],[121.0361093,14.5757285],[121.0361676,14.5757452],[121.0362425,14.5757742],[121.0363057,14.5757943],[121.0363796,14.5758169],[121.036431,14.5758342],[121.0364903,14.575852],[121.0365553,14.5758691],[121.0366267,14.5758869],[121.0367029,14.5759051],[121.0367844,14.575923],[121.0368713,14.5759398],[121.037053,14.5759763],[121.0371505,14.5759935],[121.0372463,14.5760116],[121.0373393,14.5760296],[121.0374296,14.5760471],[121.0375189,14.5760675],[121.0376049,14.5760877],[121.0376869,14.5761085],[121.0377663,14.5761274],[121.0378491,14.5761441],[121.0379271,14.5761602],[121.0380002,14.5761736],[121.0380715,14.5761878],[121.0381322,14.5762024],[121.0381904,14.5762142],[121.038247,14.5762251],[121.0382994,14.5762361],[121.038354,14.5762468],[121.0384129,14.5762579],[121.0384725,14.5762711],[121.0385325,14.5762851],[121.0385915,14.5763004],[121.0386403,14.5763139],[121.0387073,14.5763474],[121.0387388,14.5764469],[121.0387362,14.5765122],[121.0387382,14.576579],[121.0387403,14.5766472],[121.0387397,14.5767291],[121.0387401,14.5767895],[121.0387439,14.5768475],[121.0387466,14.5768933],[121.0387492,14.5769395],[121.0387588,14.5770162],[121.0387707,14.5770675],[121.03878,14.577141],[121.0387747,14.5772376],[121.0387641,14.5773057],[121.0387545,14.57737],[121.0387428,14.5774285],[121.0387308,14.5774808],[121.0387144,14.5775514],[121.038706,14.577599],[121.0387164,14.5776439],[121.0387843,14.5776792],[121.0388388,14.5776883],[121.0389002,14.577698],[121.0389623,14.5777107],[121.0390215,14.5777254],[121.0390752,14.577741],[121.0391584,14.5777785],[121.0391993,14.5778185],[121.0392776,14.5778638],[121.0393467,14.5778896],[121.0394133,14.5778945],[121.0395044,14.5778742],[121.0395613,14.5778516],[121.0396176,14.5778301],[121.0396795,14.5778091],[121.0397453,14.5777854],[121.0398079,14.5777643],[121.0398686,14.577744],[121.0399271,14.5777241],[121.0399858,14.5777031],[121.0400445,14.5776824],[121.0401005,14.5776628],[121.0401568,14.5776437],[121.0402129,14.5776262],[121.0402681,14.5776103],[121.0403225,14.5775933],[121.0403763,14.5775761],[121.0404283,14.5775595],[121.0404817,14.5775419],[121.0405378,14.577526],[121.0405945,14.5775121],[121.0406482,14.5774971],[121.0406984,14.5774828],[121.0407453,14.5774691],[121.040793,14.577454],[121.0408416,14.577437],[121.0408919,14.5774202],[121.0409398,14.5774036]];

    function extractProportionalItems(items, numberOfItemsToExtract) {
      const extractedItems = [];
      const extractedItemsIndex = [];
      const step = Math.floor(items.length / numberOfItemsToExtract);

      for (let i = 0; i < numberOfItemsToExtract; i++) {
        const index = Math.floor(i * step);
        extractedItems.push(items[index]);
        extractedItemsIndex.push(index);

      }
      console.log(extractedItemsIndex);

      return extractedItems;
    }

    // const items = [...]; // Your array of 100 items here
    const numberOfItemsToExtract = 25;
    waypoints1 = extractProportionalItems(waypoints1, numberOfItemsToExtract);

    const waypointsCount = waypoints1.length;
    const waypointsMiddle = Math.floor(waypointsCount / 2);
    waypoints1 = [waypoints1[0], waypoints1[waypointsMiddle-1], waypoints1[waypointsCount - 1]];

    // Add the Mapbox Directions control
    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',                  // Choose the unit for distance ('imperial' or 'metric')
        profile: 'mapbox/driving',       // Choose the profile for directions (e.g., 'mapbox/driving', 'mapbox/cycling')
        alternatives: false,             // Show alternative routes (true/false)
        controls: { inputs: false, instructions: false }, // Configure control elements
        interactive: true                // Enable user interaction with the map
    });

    map1.addControl(directions, 'top-left');

    function loadDirections() {
      for (let i = 0; i < waypoints1.length; i++) {
        if (i === 0) {
          directions.setOrigin(waypoints1[i]);
        } else if (i === waypoints1.length - 1) {
          directions.setDestination(waypoints1[i]);
        } else {
          directions.addWaypoint(i - 1, waypoints1[i]);
        }
      }
      // directions.route();
    }

    map1.on('load',  function() {
      loadDirections();
    });
</script> -->

<!-- <script>

    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
    let waypoints1 = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);

	mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
		const map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v12',
			center: [121.0772825, 14.336127],
			zoom: 13
		});

    // let waypoints1=[[121.0356339,14.5757805],[121.0357106,14.5757503],[121.0357937,14.5757234],[121.0358788,14.5757098],[121.0359599,14.5757066],[121.0360376,14.5757147],[121.0361093,14.5757285],[121.0361676,14.5757452],[121.0362425,14.5757742],[121.0363057,14.5757943],[121.0363796,14.5758169],[121.036431,14.5758342],[121.0364903,14.575852],[121.0365553,14.5758691],[121.0366267,14.5758869],[121.0367029,14.5759051],[121.0367844,14.575923],[121.0368713,14.5759398],[121.037053,14.5759763],[121.0371505,14.5759935],[121.0372463,14.5760116],[121.0373393,14.5760296],[121.0374296,14.5760471],[121.0375189,14.5760675],[121.0376049,14.5760877],[121.0376869,14.5761085],[121.0377663,14.5761274],[121.0378491,14.5761441],[121.0379271,14.5761602],[121.0380002,14.5761736],[121.0380715,14.5761878],[121.0381322,14.5762024],[121.0381904,14.5762142],[121.038247,14.5762251],[121.0382994,14.5762361],[121.038354,14.5762468],[121.0384129,14.5762579],[121.0384725,14.5762711],[121.0385325,14.5762851],[121.0385915,14.5763004],[121.0386403,14.5763139],[121.0387073,14.5763474],[121.0387388,14.5764469],[121.0387362,14.5765122],[121.0387382,14.576579],[121.0387403,14.5766472],[121.0387397,14.5767291],[121.0387401,14.5767895],[121.0387439,14.5768475],[121.0387466,14.5768933],[121.0387492,14.5769395],[121.0387588,14.5770162],[121.0387707,14.5770675],[121.03878,14.577141],[121.0387747,14.5772376],[121.0387641,14.5773057],[121.0387545,14.57737],[121.0387428,14.5774285],[121.0387308,14.5774808],[121.0387144,14.5775514],[121.038706,14.577599],[121.0387164,14.5776439],[121.0387843,14.5776792],[121.0388388,14.5776883],[121.0389002,14.577698],[121.0389623,14.5777107],[121.0390215,14.5777254],[121.0390752,14.577741],[121.0391584,14.5777785],[121.0391993,14.5778185],[121.0392776,14.5778638],[121.0393467,14.5778896],[121.0394133,14.5778945],[121.0395044,14.5778742],[121.0395613,14.5778516],[121.0396176,14.5778301],[121.0396795,14.5778091],[121.0397453,14.5777854],[121.0398079,14.5777643],[121.0398686,14.577744],[121.0399271,14.5777241],[121.0399858,14.5777031],[121.0400445,14.5776824],[121.0401005,14.5776628],[121.0401568,14.5776437],[121.0402129,14.5776262],[121.0402681,14.5776103],[121.0403225,14.5775933],[121.0403763,14.5775761],[121.0404283,14.5775595],[121.0404817,14.5775419],[121.0405378,14.577526],[121.0405945,14.5775121],[121.0406482,14.5774971],[121.0406984,14.5774828],[121.0407453,14.5774691],[121.040793,14.577454],[121.0408416,14.577437],[121.0408919,14.5774202],[121.0409398,14.5774036]];

    function extractProportionalItems(items, numberOfItemsToExtract) {
      const extractedItems = [];
      const extractedItemsIndex = [];
      const step = Math.floor(items.length / numberOfItemsToExtract);

      for (let i = 0; i < numberOfItemsToExtract; i++) {
        const index = Math.floor(i * step);
        extractedItems.push(items[index]);
        extractedItemsIndex.push(index);

      }
      console.log(extractedItemsIndex);

      return extractedItems;
    }

    // const items = [...]; // Your array of 100 items here
    const numberOfItemsToExtract = 25;
    waypoints1 = extractProportionalItems(waypoints1, numberOfItemsToExtract);

    const waypointsCount = waypoints1.length;
    const waypointsMiddle = Math.floor(waypointsCount / 2);
    waypoints1 = [waypoints1[0], waypoints1[waypointsMiddle-1], waypoints1[waypointsCount - 1]];

    // Add the Mapbox Directions control
    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',                  // Choose the unit for distance ('imperial' or 'metric')
        profile: 'mapbox/driving',       // Choose the profile for directions (e.g., 'mapbox/driving', 'mapbox/cycling')
        alternatives: false,             // Show alternative routes (true/false)
        controls: { inputs: false, instructions: false }, // Configure control elements
        interactive: true                // Enable user interaction with the map
    });

    map1.addControl(directions, 'top-left');

    function loadDirections() {
      for (let i = 0; i < waypoints1.length; i++) {
        if (i === 0) {
          directions.setOrigin(waypoints1[i]);
        } else if (i === waypoints1.length - 1) {
          directions.setDestination(waypoints1[i]);
        } else {
          directions.addWaypoint(i - 1, waypoints1[i]);
        }
      }
      // directions.route();
    }

    map1.on('load',  function() {
      loadDirections();
    });
</script> -->