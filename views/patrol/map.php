<?php

use app\widgets\MapboxGl;
use \yii\data\Pagination;
use app\helpers\App;
use app\helpers\Html;
use app\models\Patrol;
use app\models\Role;
use app\models\User;
use app\widgets\ActiveForm;
use app\widgets\LinkPager;
use app\widgets\OpenLayer;
use app\widgets\SearchButton;

use yii\web\View;

$this->title = 'Patrols: Map';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/patrol/map';
$this->params['wrapCard'] = false;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js', ['position' => View::POS_HEAD]);
$this->registerCssFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css',['position' => View::POS_HEAD]);

$waypoints = call_user_func_array('array_merge', $coordinates);
?>

<div class="patrol-index-page">
    <div class="row">
        <div class="col-md-8">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map View',
                'toolbar' => '<div class="card-toolbar">
                    <span class="lead font-weight-bold">Patrols Found: '. number_format($dataProvider->totalCount) .'</span>
                </div>',
                'stretch' => true
            ]) ?>

                <?php /* OpenLayer::widget([
                    'multipleCoordinates' => $coordinates,
                    'addStartMarker' => true,
                    'addEndMarker' => true,
                    'addMarkers' => false,
                    'withSearch' => false,
                    'withLine' => true,
                    'zoom' => $searchModel->map_zoom_level
                ]) */ ?>

                <div id="map" style="height: 100%;"></div>
                
            <?php $this->endContent() ?>
            
        </div>
        <div class="col-md-4">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Advanced Filter',
            ]) ?>
                <?php $form = ActiveForm::begin(['id' => 'patrol-form', 'method' => 'get', 'action' => ['patrol/map']]); ?>
                    <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 60vh">
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-filter">

                            <?= App::foreach($searchModel->advancedFilterAttributes, fn ($attribute) => $this->render('_map-advanced-filter', [
                                'form' => $form,
                                'searchModel' => $searchModel,
                                'attribute' => $attribute
                            ])) ?>

                            <?= $this->render('_map-advanced-filter', [
                                'form' => $form,
                                'searchModel' => $searchModel,
                                'attribute' => 'user_id',
                                'data' => Patrol::userFilter()
                            ]) ?>

                            <?= $this->render('_map-advanced-filter', [
                                'form' => $form,
                                'searchModel' => $searchModel,
                                'attribute' => 'status',
                                'data' => [
                                    Patrol::VALIDATED => 'Validated',
                                    Patrol::FOR_VALIDATION => 'For Validation',
                                ]
                            ]) ?>

                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" <?= $searchModel->show_user_photo ? 'checked': '' ?> name="show_user_photo" value="1">
                                    <span></span>Show Patroller Photo
                                </label>
                            </div>

                            <label for="map_zoom_level" class="mt-3">Map Zoom Level</label>
                            <div>
                                <input type="range" id="map_zoom_level" name="map_zoom_level" 
                                     min="1" max="20" value="<?= $searchModel->map_zoom_level  ?>" step="1" style="width: -webkit-fill-available;">
                            </div>

                            <div class="text-center">
                                <?=LinkPager::widget([
                                    'options' => [
                                        'class' => 'mt-5 justify-content-center app-linkpager d-flex flex-wrap justify-content-center py-2'
                                    ],
                                    'pagination' => new Pagination(['totalCount' => $dataProvider->totalCount])
                                ]) ?>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5">
                        <?= SearchButton::widget() ?>
                    </div>
                <?php ActiveForm::end(); ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>

<script>
  mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

  const waypoints = <?=json_encode($waypoints) ?>;
  const waypointsLatLng = waypoints.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
  const waypointsArray = <?=json_encode($coordinates) ?>;

  const waypointsList = waypointsArray.map(waypointCoords =>
    waypointCoords.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)])
  );

  const endpoints = waypointsArray.flatMap(waypointCoords => {
      if(waypointCoords.length > 1){
        return [waypointCoords[0],waypointCoords[waypointCoords.length - 1]];
      }
      return [waypointCoords[0]];
    }
  );

  const formattedTimestamps = endpoints.map(endpoint => { 

      let timestamp = null;

      if(endpoint.timestamp){
        timestamp = parseInt(endpoint.timestamp);
      }

      if (isNaN(timestamp)) {
        // console.error(`Invalid timestamp: ${endpoint.timestamp}`);
        return null; 
      }

      
      const date = new Date(timestamp);

      const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: true, // Use 12-hour format with AM/PM indicator
      };

      return new Intl.DateTimeFormat('en-US', options).format(date);
  });



// endpoints.forEach((endpoint, i) => {
//         const timestamp = parseInt(endpoint.timestamp);
//         const formattedTimestamp = isNaN(timestamp) ? "" : formatTimestamp(timestamp);

//         endpoint.formattedTimestamp = formattedTimestamp;
// });

// formatTimestamp(timestamp) {
//     const date = new Date(timestamp);

//     const options = {
//         year: 'numeric',
//         month: 'long',
//         day: 'numeric',
//         hour: 'numeric',
//         minute: 'numeric',
//         second: 'numeric',
//         hour12: true, // Use 12-hour format with AM/PM indicator
//     };

//     return new Intl.DateTimeFormat('en-US', options).format(date);
// }


    const featuresRoutes = waypointsList.map(waypoint => ({
      'type': 'Feature',
      'properties': {
        // 'color': '#33C9EB' // blue
        'color': '#4882c5'
      },
      'geometry': {
        'type': 'LineString',
        'coordinates': waypoint
      }
    }));

  const featuresPlaces = waypointsLatLng.map(waypoint => (
    {
      'type': 'Feature',
      'properties': {
        'description': ``
      },
      'geometry': {
        'type': 'Point',
        'coordinates': waypoint
      }
    }
  ));

  const map1 = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    center: waypoints[0],
    zoom: <?= json_encode($searchModel->map_zoom_level)?>
  });

  map1.on('load', () => {
    map1.addSource('routes', {
      'type': 'geojson',
      'data': {
        'type': 'FeatureCollection',
        'features': featuresRoutes
      }
    });

    map1.addSource('places', {
      'type': 'geojson',
      'data': {
        'type': 'FeatureCollection',
        'features': featuresPlaces
      }
    });

    map1.addLayer({
      'id': 'route-line-casing',
      'type': 'line',
      'source': 'routes',
      'layout': {
      'line-join': 'round',
      'line-cap': 'round'
      },
      'paint': {
        'line-width': 12,
        'line-color': '#2d5f99',
      }
    });

    map1.addLayer({
      'id': 'route-line',
      'type': 'line',
      'source': 'routes',
      'layout': {
      'line-join': 'round',
      'line-cap': 'round'
      },
      'paint': {
        'line-width': 7,
        'line-color': ['get', 'color'],
      }
    });

    map1.addLayer({
      'id': 'places',
      'type': 'circle',
      'source': 'places',
      'paint': {
      'circle-color': '#3bb2d0',
      'circle-radius': 6,
      'circle-stroke-width': 2,
      'circle-stroke-color': '#ffffff'
      }
    });

    for (let i = 0; i < endpoints.length; i++) {
      const markerElement = document.createElement('div');
      markerElement.className = 'mapboxgl-marker';

      // Add custom styling for the A and B markers
      markerElement.style.background = i % 2 === 0 ? '#3BB2D0' : '#8a8bc9'; 
      // markerElement.style.border = '2px solid #FFFFFF'; // White border
      markerElement.style.width = '36px';
      markerElement.style.height = '36px';
      markerElement.style.borderRadius = '50%';
      markerElement.style.display = 'flex';
      markerElement.style.justifyContent = 'center';
      markerElement.style.alignItems = 'center';

      const markerText = i % 2 === 0 ? 'A' : 'B'; // "A" for even indices, "B" for odd indices

      markerElement.innerHTML = `
        <div class="marker-text" 
        style="color: #fff; font-size: 12px; font-family:['Open Sans Bold', 'Arial Unicode MS Bold']; margin:auto;">
        ${markerText}
        </div>
      `;

      new mapboxgl.Marker({
        element: markerElement,
      })
        .setLngLat(endpoints[i])
        .setPopup(
          new mapboxgl.Popup().setHTML(`
            <div class="m-1" style="background-color: #ffffff;">
              <h3 class="text-center">${endpoints[i].full_name.toUpperCase()}</h3>
              <div>${formattedTimestamps[i]}</div>
            </div>
          `)
        )
        .addTo(map1);
    }

  });
  
</script>

