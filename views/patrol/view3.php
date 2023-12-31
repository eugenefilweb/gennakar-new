
text/x-generic view.php ( PHP script, ASCII text, with very long lines, with CRLF line terminators )
<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;

use app\models\search\PatrolSearch;

use app\widgets\Anchors;
use app\widgets\Detail;
use app\widgets\Grid;
use app\widgets\Mapboxgl;
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

// $this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
// $this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
// $this->registerJsFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js', ['position' => View::POS_HEAD]);
// $this->registerCssFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css', ['position' => View::POS_HEAD]);

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

            <!-- <div id="map" style="height: 500px;"></div> -->

            <?= Mapboxgl::widget([
                'coordinates' => $model->coordinates,
                'center' => [121.048442,14.361508],
                'multipleDirections' => false
            ]) ?>

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
                                <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png"
                                    alt="image">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
                                <?= $model->userFullname ?>
                            </a>
                            <span class="text-muted font-weight-bold">Patrol ID:
                                <?= $model->tripId ?>
                                <?= $model->statusBadge ?>
                            </span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::User-->
                <!--begin::Desc-->
                <p class="py-2">
                    An estimated of
                    <?= $model->travelHours ?> travel patrol recorded.
                    <?= $model->notes ? '<br>Notes: ' . $model->notes : '' ?>
                </p>
                <!--end::Desc-->
                <!--begin::Contacts-->
                <div class="pb-2">
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z"
                                            fill="#000000" opacity="0.3"></path>
                                        <path
                                            d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z"
                                            fill="#000000"></path>
                                        <path
                                            d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z"
                                            fill="#000000"></path>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="text-muted font-weight-bold">Date:
                            <?= $model->date ?>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z"
                                            fill="#000000"></path>
                                    </g>
                                </svg>

                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold">Encoded Data: +
                            <?= number_format($model->totalTrees) ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">

                            <span class="svg-icon svg-icon-md">
                                <!-- begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z"
                                            fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold">
                            Distance:
                            <?= App::formatter()->asDistance($model->distance) ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">

                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M4.30769231,13 C3.03318904,13 2,11.9926407 2,10.75 C2,9.92157288 2.76923077,8.67157288 4.30769231,7 C5.84615385,8.67157288 6.61538462,9.92157288 6.61538462,10.75 C6.61538462,11.9926407 5.58219558,13 4.30769231,13 Z M19.6923077,13 C18.4178044,13 17.3846154,11.9926407 17.3846154,10.75 C17.3846154,9.92157288 18.1538462,8.67157288 19.6923077,7 C21.2307692,8.67157288 22,9.92157288 22,10.75 C22,11.9926407 20.966811,13 19.6923077,13 Z M8.30769231,20 C7.03318904,20 6,18.9926407 6,17.75 C6,16.9215729 6.76923077,15.6715729 8.30769231,14 C9.84615385,15.6715729 10.6153846,16.9215729 10.6153846,17.75 C10.6153846,18.9926407 9.58219558,20 8.30769231,20 Z M16,20 C14.7254967,20 13.6923077,18.9926407 13.6923077,17.75 C13.6923077,16.9215729 14.4615385,15.6715729 16,14 C17.5384615,15.6715729 18.3076923,16.9215729 18.3076923,17.75 C18.3076923,18.9926407 17.2745033,20 16,20 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M12,13 C13.2745033,13 14.3076923,11.9926407 14.3076923,10.75 C14.3076923,9.92157288 13.5384615,8.67157288 12,7 C10.4615385,8.67157288 9.69230769,9.92157288 9.69230769,10.75 C9.69230769,11.9926407 10.7254967,13 12,13 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold">
                            Watershed: <?= $model->watershed ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">

                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold">
                            Barangay: <?= $model->barangay ?>
                        </a>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="flex-shrink-0 mr-2">

                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker1.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <a href="#" class="text-muted text-hover-primary font-weight-bold">
                            Sitio: <?= $model->sitio ?>
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
                'title' => 'Encoded Floras',
                'toolbar' => '
                    <div class="card-toolbar">
                        ' . Html::a('Add Tree Item', ['tree/create', 'patrol_id' => $model->id, 'referrer' => Url::current()], ['class' => 'btn btn-success font-weight-bold']) . '
                    </div>
                '
            ]) ?>
            <?= Grid::widget([
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]); ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-12">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Encoded Faunas',
                'toolbar' => '
                    <div class="card-toolbar">
                        ' . Html::a('Add Fauna Item', ['fauna/create', 'patrol_id' => $model->id, 'referrer' => Url::current()], ['class' => 'btn btn-success font-weight-bold']) . '
                    </div>
                '
            ]) ?>
            <?php /*
            <?= Grid::widget([
                'dataProvider' => $dataProviderFauna,
                'searchModel' => $searchModelFauna,
            ]); ?>

            */ ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>


<?php /*
<script>
    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
    let waypoints1 = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
    var waypointsArray = [];
    var dataProvider = <?= json_encode($dataProvider->models) ?>;
    var trees = <?= json_encode($trees) ?>;
    var faunas = <?= json_encode($dataProviderFauna) ?>;
    

    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
    const map1 = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [121.0772825, 14.336127],
        zoom: 13
    });

    function extractProportionalItems(items, numberOfItemsToExtract = 25) {
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

    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/walking',
        geometries: 'geojson',
        alternatives: false,
        controls: {
            inputs: false,
            instructions: false
        },
        interactive: false
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

    const featuresPlaces = waypoints1.map(waypoint => ({
        'type': 'Feature',
        'properties': {
            'description': `Lng: ${waypoint[0]},Lat: ${waypoint[1]}`
        },
        'geometry': {
            'type': 'Point',
            'coordinates': waypoint
        }
    }));

    map1.on('load', function () {
        loadDirections();

        // Add markers for intermediate waypoints
        for (let i = 1; i < waypoints1.length - 1; i++) {
            const markerElement = createMarker(waypoints1[i], 0); // Lower zIndex (e.g., -500)
            new mapboxgl.Marker({
                element: markerElement
            }).setLngLat([waypoints1[i][0], waypoints1[i][1]]).addTo(map1);
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

            markerEndpoint.style.background = endpoint === 'A' ? '#3BB2D0' : '#8a8bc9';
            markerEndpoint.style.width = '36px';
            markerEndpoint.style.height = '36px';
            markerEndpoint.style.borderRadius = '50%';
            markerEndpoint.style.zIndex = zIndex + '';
            markerEndpoint.style.display = 'flex';
            markerEndpoint.style.justifyContent = 'center';
            markerEndpoint.style.alignItems = 'center';

            new mapboxgl.Marker({
                element: markerEndpoint
            }).setLngLat(coordinates).addTo(map1);

            markerEndpoint.innerHTML = `<div style="color: #fff; font-size: 12px;">${endpoint}</div>`

            return markerEndpoint;
        }

        // Add endpoint markers (A and B) to the map
        new mapboxgl.Marker({element: markerA}).setLngLat([waypoints1[0][0], waypoints1[0][1]]).addTo(map1);
        new mapboxgl.Marker({element: markerB}).setLngLat([waypoints1[waypoints1.length - 1][0], waypoints1[waypoints1.length - 1][1]]).addTo(map1);

        const createTreeMarkerElement = () => {
            const markerElement = document.createElement('div');
            markerElement.className = 'tree-marker';
            markerElement.innerHTML = `<?= Html::img("/assets/svg/park-alt1.svg", ['width' => 35, 'height' => 35]) ?>`

            return markerElement;
        }

        trees.map(tree => {
            const popupHtml = `<div class="m-1" style="background-color: #ffffff;">
                                    <div class="d-flex justify-content-center align-items-center w-100 h-100 mb-3 mt-2">
                                        <image src=${tree.photo_url} width="100%" height="100%">
                                    </div>
                                    <h3 class="text-center">${tree.common_name.toUpperCase()}</h3>
                                    <div>
                                        <div>Longitude: ${tree.longitude}</div>
                                        <div>Latitude: ${tree.latitude}</div>
                                        <div>Date: ${tree.date_encoded}</div>
                                    </div>
                                </div>`

            const treeMarker = createTreeMarkerElement();
            new mapboxgl.Marker({element: treeMarker})
                .setLngLat([tree.longitude, tree.latitude])
                .setPopup(
                    new mapboxgl.Popup().setHTML(popupHtml))
                .addTo(map1);
        })

        const createFaunaMarkerElement = () => {
            const markerElement = document.createElement('div');
            markerElement.className = 'tree-marker';
            markerElement.innerHTML = `<?= Html::img("/assets/svg/hummingbird.svg", ['width' => 35, 'height' => 35]) ?>`

            return markerElement;
        }

        faunas.map(fauna => {

            const popupHtml = `<div class="m-1" style="background-color: #ffffff;">
                                    <div class="d-flex justify-content-center align-items-center w-100 h-100 mb-3 mt-2">
                                        <image src=${fauna.photo_url} width="100%" height="100%">
                                    </div>
                                    <h3 class="text-center">${fauna.common_name.toUpperCase()}</h3>
                                    <div>
                                        <div>Longitude: ${fauna.longitude}</div>
                                        <div>Latitude: ${fauna.latitude}</div>
                                        <div>Date: ${fauna.date_encoded}</div>
                                    </div>
                                </div>`

            new mapboxgl.Marker({element: createFaunaMarkerElement()})
                .setLngLat([fauna.longitude, fauna.latitude])
                .setPopup(new mapboxgl.Popup().setHTML(popupHtml))
                .addTo(map1);
        })
    });
</script>

*/ ?>