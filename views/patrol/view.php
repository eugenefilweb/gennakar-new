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
    /* .marker {
        background-image: url('https://freepngimg.com/thumb/map/66932-openstreetmap-map-google-icons-maps-computer-marker.png');
        background-size: cover;
        background-color: gray;
        width: 7px;
        height: 7px;
        border: 2px solid green;
        border-radius: 50%;
        cursor: pointer;
    } */

    /* .mapboxgl-popup {
        max-width: 200px;
    }

    .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    } */


    .mapbox-marker {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        cursor: pointer;
        background-color: #3bb2d0;
        border: 2px solid #fff;
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

<!-- <script>

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

</script> -->

<script>
    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
    let waypoints1 = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
    var waypointsArray = [];

	mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
		const map1 = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v12',
			center: [121.0772825, 14.336127],
			zoom: 13
		});

    function extractProportionalItems(items, numberOfItemsToExtract=25) {
        const extractedItems = [items[0]]; 
        const extractedItemsIndex = [0];

        if (numberOfItemsToExtract > 2) {
        const step = (items.length - 1) / (numberOfItemsToExtract - 2);
        
        for (let i = 1; i < numberOfItemsToExtract - 1; i++) {
            const index = Math.floor(i * step);
            extractedItems.push(items[index]);
            extractedItemsIndex.push(index);
        }
        }

        extractedItems.push(items[items.length - 1]); 
        extractedItemsIndex.push(items.length - 1);

        return extractedItems;
    }

    const numberOfItemsToExtract = 25;
    waypoints1 = extractProportionalItems(waypoints1, numberOfItemsToExtract);

    // const waypointsCount = waypoints1.length;
    // const waypointsMiddle = Math.floor(waypointsCount / 2);
    // waypoints1 = [waypoints1[0], waypoints1[waypointsMiddle-1], waypoints1[waypointsCount - 1]];

     const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',                  
        profile: 'mapbox/walking',
        // geometries: 'polyline6',
        geometries: 'geojson',        
        alternatives: false,             
        controls: { inputs: false, instructions: false }, 
        interactive: true                
    });

    map1.addControl(directions, 'top-left');

    function loadDirections() {

    for (var i = 0; i < waypoints1.length; i++) {
        waypointsArray.push(waypoints1[i]);
    }

      for (let i = 0; i < waypoints1.length; i++) {
        if (i === 0) {
          directions.setOrigin(waypoints1[i]);
        } else if (i === waypoints1.length - 1) {
          directions.setDestination(waypoints1[i]);
        } else {
          directions.addWaypoint(i - 1, waypoints1[i]);
        }
      }
    }

    const featuresPlaces = waypoints1.map(waypoint => (
    {
      'type': 'Feature',
      'properties': {
        'description': `Lng: ${waypoint[0]},Lat: ${waypoint[1]}`
      },
      'geometry': {
        'type': 'Point',
        'coordinates': waypoint
      }
    }
  ));


  map1.on('load', function () {
    loadDirections();

    // Add markers for intermediate waypoints
    for (let i = 1; i < waypoints1.length - 1; i++) {
        const markerElement = createMarker(waypoints1[i], 0); // Lower zIndex (e.g., -500)
        new mapboxgl.Marker({ element: markerElement }).setLngLat([waypoints1[i][0], waypoints1[i][1]]).addTo(map1);
    }

    // Add endpoint markers (A and B) with separate markerEndpoint elements
    const markerA = createEndpointMarker(waypoints1[0], 1000, 'A'); // Higher zIndex (e.g., 1000) for markerA
    const markerB = createEndpointMarker(waypoints1[waypoints1.length - 1], 1000, 'B'); // Higher zIndex (e.g., 1000) for markerB

    // Helper function to create a marker element with a specific zIndex
    function createMarker(coordinates, zIndex) {
        const markerElement = document.createElement('div');
        markerElement.className = 'mapboxgl-marker';

        markerElement.style.width = '15px';
        markerElement.style.height = '15px';
        markerElement.style.borderRadius = '50%';
        markerElement.style.border = '2px solid #fff';
        markerElement.style.backgroundColor = '#3bb2d0';
        markerElement.style.zIndex = zIndex + '';

        return markerElement;
    }

    // Helper function to create an endpoint marker element with a specific zIndex
    function createEndpointMarker(coordinates, zIndex, endpoint) {
        const markerEndpoint = document.createElement('div');
        markerEndpoint.className = 'mapboxgl-marker';

        markerEndpoint.style.background = endpoint === 'A' ? '#3BB2D0' :'#8a8bc9';
        markerEndpoint.style.width = '36px';
        markerEndpoint.style.height = '36px';
        markerEndpoint.style.borderRadius = '50%';
        markerEndpoint.style.zIndex = zIndex + '';
        markerEndpoint.style.display = 'flex';
        markerEndpoint.style.justifyContent = 'center';
        markerEndpoint.style.alignItems = 'center';
        

        new mapboxgl.Marker({ element: markerEndpoint }).setLngLat(coordinates).addTo(map1);

        markerEndpoint.innerHTML = `<div style="color: #fff; font-size: 12px;">${endpoint}</div>`

        return markerEndpoint;
    }

    // Add endpoint markers (A and B) to the map
    new mapboxgl.Marker({ element: markerA }).setLngLat([waypoints1[0][0], waypoints1[0][1]]).addTo(map1);
    new mapboxgl.Marker({ element: markerB }).setLngLat([waypoints1[waypoints1.length - 1][0], waypoints1[waypoints1.length - 1][1]]).addTo(map1);
});



</script>

