<?php

$waypoints = call_user_func_array('array_merge', $coordinates);

// $this->registerJs($script);
?>

<div id="map" style="height: 100%;">Test</div>

<script>
  mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

  const waypoints = <?=json_encode($waypoints) ?>;
  const waypointsLatLng = waypoints.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
  const waypointsArray = <?=json_encode($coordinates) ?>;

  const waypointsList = waypointsArray.map(waypointCoords =>
    waypointCoords.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)])
  );

  const endpoints = waypointsArray.map(coords => {
    if(coords.length > 1){
      return [coords[0], coords[coords.length - 1]];
    }
    return [coords[0]];
  })

  const formattedTimestamps = (point) => {

    let timestamp = null;

    if(point.timestamp){
      timestamp = parseInt(point.timestamp);
    }

    if(isNaN(timestamp)){
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

  for (let i = 0; i < endpoints.length; i++) {
  endpoints[i].forEach(endpoint => {
    endpoint['formattedTimestamp'] = formattedTimestamps(endpoint);
  });
}

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

        if(endpoints[i].length > 1){

          for(let j = 0; j< endpoints[i].length; j++){

            const markerElement = createMarkerElement(j);

            new mapboxgl.Marker({
              element: markerElement,
            })
            .setLngLat(endpoints[i][j])
            .setPopup(
              new mapboxgl.Popup().setHTML(`
              <div class="m-1" style="background-color: #ffffff;">
              <h3 class="text-center">${endpoints[i][j].full_name.toUpperCase()}</h3>
              <div>${endpoints[i][j].formattedTimestamp}</div>
              </div>
              `)
              )
              .addTo(map1);

          }

        }else {

          const markerElement = createMarkerElement(0);
          new mapboxgl.Marker({
            element: markerElement,
          })
          .setLngLat(endpoints[i][0])
          .setPopup(
            new mapboxgl.Popup().setHTML(`
            <div class="m-1" style="background-color: #ffffff;">
            <h3 class="text-center">${endpoints[i][0].full_name.toUpperCase()}</h3>
            <div>${endpoints[i][0].formattedTimestamp}</div>
            </div>
            `)
            )
          .addTo(map1);

        }
    }

  });
  
</script>