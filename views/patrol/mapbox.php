<?php

use yii\web\View;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css',['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js', ['position' => View::POS_HEAD]);
$this->registerCssFile('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css',['position' => View::POS_HEAD]);

?>

<div id="map" style="height: 500px;"></div>
                
<script>
    var coordinates = <?= json_encode($model->formattedCoordinates) ?>;
    let waypoints1 = coordinates.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)]);
    var waypointsArray = [];
    var dataProvider = <?= json_encode($dataProvider->models) ?>;
    var trees = <?= json_encode($trees) ?>;

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

     const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',                  
        profile: 'mapbox/walking',
        // geometries: 'polyline6',
        geometries: 'geojson',        
        alternatives: false,             
        controls: { inputs: false, instructions: false }, 
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

    const createTreeMarkerElement = () => {
          const markerElement = document.createElement('div');
          markerElement.className = 'tree-marker';
        markerElement.innerHTML = `<svg width="35" height="35">
                                    <image href="../assets/svg/park-alt1.svg" width="100%" height="100%" />
                                   </svg>`;
          return markerElement;
      }

    trees.map(tree => {

        const treeMarker = createTreeMarkerElement();
        new mapboxgl.Marker({
            element: treeMarker
        })
        .setLngLat([tree.longitude, tree.latitude])
        .setPopup(
            new mapboxgl.Popup().setHTML(`
                <div class="m-1" style="background-color: #ffffff;">
                <h3 class="text-center">${tree.common_name}</h3>
                <div>
                    <div>Longitude: ${tree.longitude}</div>
                    <div>Latitude: ${tree.latitude}</div>
                    <div>${tree.date_encoded}</div>
                </div>
                </div>
            `)
            )
        .addTo(map1);
    })

    });

</script>

