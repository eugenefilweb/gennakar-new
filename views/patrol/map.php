<?php

use app\widgets\Mapbox;
use app\widgets\Mapboxgl;
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

// $this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
// $this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
?>

<style>
  .popup .title {
    font-weight: bold;
    margin-right: .5rem;
  }
</style>

<div class="patrol-index-page">
  <div class="row">
    <div class="col-md-8">
      <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Map View',
        'toolbar' => '<div class="card-toolbar">
                    <span class="lead font-weight-bold">Patrols Found: ' . number_format($dataProvider->totalCount) . '</span>
                </div>',
        'stretch' => true
      ]) ?>

      <!-- <div id="map" style="height: 100%;"></div> -->

      <?php /*
      <?= Mapbox::widget([
        'styleUrl' => 'mapbox://styles/mapbox/satellite-streets-v12'
      ]) ?>
      */ ?>

      <?= Mapboxgl::widget([
        'center' => [121.45,14.45],
        'coordinates' => $coordinates
      ])?>

      <?php $this->endContent() ?>

    </div>
    <div class="col-md-4">
      <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Advanced Filter',
      ]) ?>
      <?php $form = ActiveForm::begin(['id' => 'patrol-form', 'method' => 'get', 'action' => ['patrol/map']]); ?>
      <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 60vh">
        <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-filter">

          <?= App::foreach($searchModel->advancedFilterAttributes, fn($attribute) => $this->render('_map-advanced-filter', [
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
              <input type="checkbox" <?= $searchModel->show_user_photo ? 'checked' : '' ?> name="show_user_photo"
                value="1">
              <span></span>Show Patroller Photo
            </label>
          </div>

          <label for="map_zoom_level" class="mt-3">Map Zoom Level</label>
          <div>
            <input type="range" id="map_zoom_level" name="map_zoom_level" min="1" max="20"
              value="<?= $searchModel->map_zoom_level ?>" step="1" style="width: -webkit-fill-available;">
          </div>

          <?php /*
          <div class="text-center">
            <?= LinkPager::widget([
              'options' => [
                'class' => 'mt-5 justify-content-center app-linkpager d-flex flex-wrap justify-content-center py-2'
              ],
              'pagination' => new Pagination(['totalCount' => $dataProvider->totalCount])
            ]) ?>
          </div>
          */ ?>

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

<?php /*
<script>
  mapboxgl.accessToken = <?= json_encode(Yii::$app->params['mapbox']['mapboxglAccessToken']) ?>;

  const waypoints = <?= json_encode($coordinates) ?>;

  const waypointsLatLng = waypoints.map(coord => {
    return coord.coordinates.map(point =>
      [parseFloat(point.lon), parseFloat(point.lat)]);
  });

  const waypointsList = [].concat(...waypointsLatLng);

  let endpoints = waypoints.map(coords => {

    if (coords.coordinates.length > 1) {
      return [coords.coordinates[0], coords.coordinates[coords.coordinates.length - 1], coords];
    }
    return [coords.coordinates[0], coords];
  });

  const formattedTimestamps = (point) => {

    let timestamp = null;

    if (point.timestamp) {
      timestamp = parseInt(point.timestamp);
    }

    if (isNaN(timestamp)) {
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
      hour12: true,
    }

    return new Intl.DateTimeFormat('en-US', options).format(date);
  }

  for (let i = 0; i < endpoints.length - 1; i++) {
    endpoints[i].forEach(endpoint => {
      endpoint['formattedTimestamp'] = formattedTimestamps(endpoint);
    });
  }

  const featuresRoutes = waypointsLatLng.map(waypoint => ({
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

  const featuresPlaces = waypointsList.map(waypoint => (
    {
      'type': 'Feature',
      'properties': {
        'description': ``
      },
      'geometry': {
        'type': 'Point',
        'coordinates': [waypoint[0], waypoint[1]]
      }
    }
  ));

  const map1 = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/satellite-streets-v12',
    center: [121.45, 14.25],
    zoom: <?= json_encode($searchModel->map_zoom_level) ?>
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


    const createMarkerElement = (index) => {
      const markerElement = document.createElement('div');
      markerElement.className = 'mapboxgl-marker';

      markerElement.style.width = '36px';
      markerElement.style.height = '36px';
      markerElement.style.borderRadius = '50%';
      markerElement.style.display = 'flex';
      markerElement.style.justifyContent = 'center';
      markerElement.style.alignItems = 'center';

      markerElement.style.background = index === 0 ? '#3BB2D0' : '#8a8bc9';

      const markerText = index === 0 ? 'A' : 'B';

      markerElement.innerHTML = `
            <div class="marker-text" 
              style="color: #fff; font-size: 12px; font-family:['Open Sans Bold', 'Arial Unicode MS Bold']; margin:auto;">
              ${markerText}
            </div>
          `;

      return markerElement;
    }

    const popupHtml = (endpoints, i, j) => {
      return `<div class="m-1 popup p-1" style="background-color: #ffffff;">
                  <h3 class="text-center">${endpoints[i][j]?.full_name?.toUpperCase() ?? ""}</h3>
                  <hr>
                  ${endpoints[i][2]?.id ? `<span class="title" >Id:</span><span>${endpoints[i][2]?.id ?? ""}</span><br>` : ""}
                  ${endpoints[i][2]?.date ? `<span class="title" >Distance:</span><span>${endpoints[i][2]?.distance ?? ""}</span><br>` : ""}
                  ${endpoints[i][j]?.formattedTimestamp ? `<span class="title" >Date:</span><span>${endpoints[i][2]?.formattedTimestamp ?? ""}</span><br>` : ""}
                  <hr>
                      <div class="d-flex justify-content-end mt-3">
                              <a href=${`/patrol/${endpoints[i][2]?.id}`} class="see-more-link pointer text-primary" target="_blank" id="see-more-link" onmouseover="color='lighten(primary, 80%)';">
                                  See more...
                              </a>
                      </div>
                </div>
              `
    }

    for (let i = 0; i < endpoints.length; i++) {
      for (let j = 0; j < endpoints[i].length - 1; j++) {
        if (endpoints[i].length > 2) {

          const markerElement = createMarkerElement(j);

          new mapboxgl.Marker({
            element: markerElement,
          })
            .setLngLat(endpoints[i][j])
            .setPopup(new mapboxgl.Popup().setHTML(popupHtml(endpoints,i,j)))
            .addTo(map1);

        } else {
          const markerElement = createMarkerElement(0);
          new mapboxgl.Marker({
            element: markerElement,
          })
            .setLngLat(endpoints[i][0])
            .setPopup(
              new mapboxgl.Popup().setHTML(popupHtml(endpoints,i,j)))
            .addTo(map1);
        }
      }
    }

  });

</script>
*/ ?>