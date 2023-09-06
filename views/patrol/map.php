<?php
use app\widgets\Mapbox;
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

            <div id="map" style="height: 500px;"></div>

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
                                <?= LinkPager::widget([
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
  let waypointsArray = <?=json_encode($coordinates) ?>;
  const endpoints = [];

  const waypointsList = [];
  const features = []; // Initialize an empty array to hold features
  let bounds = new mapboxgl.LngLatBounds(); // Create bounds object to store map extent

  for (const waypointCoords of waypointsArray) {
    endpoints.push(waypointCoords[0]);
    endpoints.push(waypointCoords[waypointCoords.length - 1]);

    const waypoint = waypointCoords.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
    waypointsList.push(waypoint);

    // Extend the bounds with the current coordinates
    for (const coord of waypoint) {
      bounds.extend(coord);
    }
  }

  for (const waypoint of waypointsList) {
    const waypointFeature = {
      'type': 'Feature',
      'properties': {
        'color': '#33C9EB' // blue
      },
      'geometry': {
        'type': 'LineString',
        'coordinates': waypoint
      }
    }

    // Add the waypoint feature to the features array
    features.push(waypointFeature);
  }

  const map1 = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    center: waypoints[0],
    zoom: 16
  });

  map1.on('load', () => {
    map1.addSource('routes', {
      'type': 'geojson',
      'data': {
        'type': 'FeatureCollection',
        'features': features
      }
    });

    map1.addLayer({
      'id': 'routes',
      'type': 'line',
      'source': 'routes',
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
      // create an HTML element for each feature
      const el = document.createElement('div');
      el.className = 'marker';

      // make a marker for each feature and add it to the map
      new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(new mapboxgl.Popup({
        offset: 25
      }).setHTML(`<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`)).addTo(map1);
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

      new mapboxgl.Marker({
        rotation: rotation
      }).setLngLat(feature.geometry.coordinates).setPopup(new mapboxgl.Popup({
        offset: 25
      }).setHTML(`<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`)).addTo(map1);
    }

    // Set the map's center and zoom level to fit the extent
    map1.fitBounds(bounds, {
      padding: 50, // You can adjust the padding as needed
    });
  });
</script>
