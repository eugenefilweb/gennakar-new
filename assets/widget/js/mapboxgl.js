class MapboxWidget {

    constructor({
        zoom,
        center,
        coordinates,
        widgetId,
        accessToken
    }){
        mapboxgl.accessToken = accessToken;
        this.zoom = zoom;
        this.center = center;
        this.coordinates = coordinates;
        this.widgetId = widgetId;
        this.map = this.createMapInstance();
    }

    createMapInstance(){
        return new mapboxgl.Map({
            // container: this.widgetId,
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: this.center,
            zoom: this.zoom,
        });
    }

    // addLineString() {
    //     const routes = waypointsList.map(waypoint => ({
    //         'type': 'Feature',
    //         'properties': {
    //           'color': '#33C9EB' // blue
    //         },
    //         'geometry': {
    //           'type': 'LineString',
    //           'coordinates': waypoint
    //         }
    //       }));

    //     this.map.addSource('route', {
    //         'type': 'geojson',
    //         'data': {
    //             'type': 'Feature',
    //             'properties': {},
    //             'geometry': {
    //                 'type': 'LineString',
    //                 'coordinates': routes
    //             }
    //         }
    //     });

    //     this.map.addLayer({
    //         'id': 'route',
    //         'type': 'line',
    //         'source': 'route',
    //         'layout': {
    //             'line-join': 'round',
    //             'line-cap': 'round'
    //         },
    //         'paint': {
    //             'line-color': '#888',
    //             'line-width': 8
    //         }
    //     });
    // }

    // addPlaces(){

    //     const places = waypointsLatLng.map(waypoint => (
    //         {
    //           'type': 'Feature',
    //           'properties': {
    //             'description': `Lng: ${waypoint[0]},Lat: ${waypoint[1]}`
    //           },
    //           'geometry': {
    //             'type': 'Point',
    //             'coordinates': waypoint
    //           }
    //         }
    //       ));

    //     this.map.addSource('places', {
    //         'type': 'geojson',
    //         'data': {
    //           'type': 'FeatureCollection',
    //           'features': places
    //         }
    //       });

    //       this.map.addLayer({
    //         'id': 'places',
    //         'type': 'circle',
    //         'source': 'places',
    //         'paint': {
    //         'circle-color': '#4264fb',
    //         'circle-radius': 3,
    //         'circle-stroke-width': 2,
    //         'circle-stroke-color': '#ffffff'
    //         }
    //       });
    // }


    
    init(){

        this.map.load('on', ()=> {

            // this.addLineString();
            // this.addPlaces();

        })
    }


}
