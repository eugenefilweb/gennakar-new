<?php

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

  const endpoints = waypointsArray.flatMap(waypointCoords => [
    waypointCoords[0],
    waypointCoords[waypointCoords.length - 1]
  ]);

  const waypointsList = waypointsArray.map(waypointCoords =>
    waypointCoords.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)])
  );

  const featuresRoutes = waypointsList.map(waypoint => ({
    'type': 'Feature',
    'properties': {
      'color': '#33C9EB' // blue
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
        'description': `Lng: ${waypoint[0]},Lat: ${waypoint[1]}`
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
      'id': 'routes',
      'type': 'line',
      'source': 'routes',
      'paint': {
        'line-width': 15,
        'line-color': ['get', 'color']
      }
    });

    map1.addLayer({
      'id': 'places',
      'type': 'circle',
      'source': 'places',
      'paint': {
      'circle-color': '#4264fb',
      'circle-radius': 3,
      'circle-stroke-width': 2,
      'circle-stroke-color': '#ffffff'
      }
    });

    for (let i = 0; i < endpoints.length; i++) {

      new mapboxgl.Marker()
      .setLngLat(endpoints[i])
      .setPopup(new mapboxgl.Popup()
      .setHTML(`<h1>${endpoints[i].user.toUpperCase()}</h1>`))
      .addTo(map1);

      // new mapboxgl.Popup()
      // .setLngLat(endpoints[i])
      // .setHTML(`<h1>${endpoints[i].user.toUpperCase()}</h1>`)
      // .addTo(map1);

    }

    // const popup = new mapboxgl.Popup({
    //   closeButton: false,
    //   closeOnClick: false
    // });

    // map1.on('mouseenter', 'places', (e) => {
    //   map1.getCanvas().style.cursor = 'pointer';
      
    //   const coordinates = e.features[0].geometry.coordinates.slice();
    //   const description = e.features[0].properties.description;
      
    //   while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
    //   coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    //   }
    //   popup.setLngLat(coordinates).setHTML(description).addTo(map1);
    // });
    
    // map1.on('mouseleave', 'places', () => {
    //   map1.getCanvas().style.cursor = '';
    //   popup.remove();
    // });

  });
  
</script>

