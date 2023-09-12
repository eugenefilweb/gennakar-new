// class MapboxWidget {

// 	constructor({ widgetId, accessToken, lnglat, enableGeocoder, enableNavigationController, enableDrawing, mapLoadScript, initLoadScript, dataloadingScript, sourcedataScript, styleUrl, zoom }) {
// 		mapboxgl.accessToken = accessToken;

// 		this.widgetId = widgetId;
// 		this.accessToken = accessToken;
// 		this.lnglat = lnglat;
// 		this.enableGeocoder = enableGeocoder;
// 		this.enableNavigationController = enableNavigationController;
//         this.enableDrawing = enableDrawing;
//         this.mapLoadScript = mapLoadScript;
//         this.initLoadScript = initLoadScript;
//         this.dataloadingScript = dataloadingScript;
// 		this.sourcedataScript = sourcedataScript;
//         this.styleUrl = styleUrl;
//         this.zoom = zoom;
        
// 	    this.map = this.createMapInstance();
// 	}

// 	createMapInstance() {
// 		return new mapboxgl.Map({
// 	        container: this.widgetId, // container ID
//             style: this.styleUrl, // style URL
// 	        // style: 'mapbox://styles/roelfilweb/cli146vxi02hd01pgel9nez2k', // style URL
// 	        center: this.lnglat, // starting position [lng, lat]
// 	        zoom: this.zoom || 15, // starting zoom,
// 	        // pitch: 60,
// 	        // antialias: true,
// 	        // bearing: -17.6,
// 	    });
// 	}

// 	// addMapboxDraw() {
//     //     const draw = new MapboxDraw({
//     //         displayControlsDefault: false,
//     //         // Select which mapbox-gl-draw control buttons to add to the map.
//     //         controls: {
//     //             polygon: true,
//     //             trash: true
//     //         },
//     //         // Set mapbox-gl-draw to draw by default.
//     //         // The user does not have to click the polygon control button first.
//     //         defaultMode: 'draw_polygon',
// 	// 		styles: [
// 	// 			// Override the default fill and stroke colors
// 	// 			{
// 	// 				'id': 'gl-draw-polygon-fill-inactive',
// 	// 				'type': 'fill',
//     //                 filter: ['==', '$type', 'Polygon'],
// 	// 				'paint': {
// 	// 					'fill-color': '#F64E60', // Set the desired fill color
// 	// 					'fill-opacity': 0.5
// 	// 				}
// 	// 			},
// 	// 			{
// 	// 				'id': 'gl-draw-polygon-stroke-inactive',
// 	// 				'type': 'line',
//     //                 filter: ['==', '$type', 'LineString'],
// 	// 				'paint': {
// 	// 					'line-color': '#F64E60', // Set the desired stroke color
// 	// 					'line-width': 2
// 	// 				}
// 	// 			},
// 	// 			// Add point markers to each corner
// 	// 			{
// 	// 				'id': 'gl-draw-polygon-and-line-vertex-active',
// 	// 				'type': 'circle',
//     //                 'filter': ['==', '$type', 'Point'],
// 	// 				'paint': {
// 	// 					'circle-radius': 5,
// 	// 					'circle-color': '#F64E60', // Set the desired corner point color
// 	// 					'circle-opacity': 0.8 // Set the desired corner point opacity (0-1)
// 	// 				}
// 	// 			},
// 	// 			{
// 	// 			    "id": "gl-draw-polygon-and-line-vertex-active-fill",
// 	// 			    "type": "fill",
// 	// 			    "filter": ["all", ["==", "$type", "Polygon"], ["==", "active", "true"]],
// 	// 			    "paint": {
// 	// 			      "fill-color": "#D20C0C",
// 	// 			      "fill-opacity": 0.2
// 	// 			    }
// 	// 			}
// 	// 		]
//     //     });
//     //     this.map.addControl(draw);

//     //     function updateArea(e) {
//     //         const data = draw.getAll();
//     //         const answer = document.getElementById('calculated-area');
//     //         if (data.features.length > 0) {
//     //             const area = turf.area(data);
//     //             // Restrict the area to 2 decimal points.
//     //             const rounded_area = Math.round(area * 100) / 100;
//     //             answer.innerHTML = '<p><strong>'+rounded_area.toLocaleString()+'</strong></p><p>square meters</p>';
//     //         } 
//     //         else {
//     //             answer.innerHTML = '';
//     //             if (e.type !== 'draw.delete')
//     //                 alert('Click the map to draw a polygon.');
//     //         }
//     //     }

//     //     this.map.on('draw.create', updateArea);
//     //     this.map.on('draw.delete', updateArea);
//     //     this.map.on('draw.update', updateArea);
//     // }

//     addMarker() {
//         const marker = new mapboxgl.Marker({
//             color: "#FFFFFF",
//             draggable: true,
//             icon: {
//                 url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v12/icons/marker-15.png',
//                 size: [25, 25]
//               },
//               color: 'red',
//               size: 50,
//               opacity: 0.5
//         })
//         .setLngLat(this.lnglat)
//         .addTo(this.map);
//     }

//     addNavigationControl() {
//         const nav = new mapboxgl.NavigationControl({
//             visualizePitch: true
//         });
//         this.map.addControl(nav, 'bottom-right');
//     }

//     addPopover() {
//         const markerHeight = 50;
//         const markerRadius = 10;
//         const linearOffset = 25;
//         const popupOffsets = {
//             'top': [0, 0],
//             'top-left': [0, 0],
//             'top-right': [0, 0],
//             'bottom': [0, -markerHeight],
//             'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
//             'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
//             'left': [markerRadius, (markerHeight - markerRadius) * -1],
//             'right': [-markerRadius, (markerHeight - markerRadius) * -1]
//         };

//         const popup = new mapboxgl.Popup({offset: popupOffsets, className: 'my-class'})
//             .setLngLat(this.lnglat)
//             .setHTML("General Nakar")
//             .setMaxWidth("300px")
//             .addTo(this.map);
//     }

//     // addScaleControl() {
//     //     const scale = new mapboxgl.ScaleControl({
//     //         maxWidth: 80,
//     //         unit: 'imperial'
//     //     });
//     //     this.map.addControl(scale);
//     //     scale.setUnit('metric');
//     // }

//     // addGeolocateControl() {
// 	//     this.map.addControl(new mapboxgl.GeolocateControl({
// 	//         positionOptions: {
// 	//             enableHighAccuracy: true
// 	//         },
// 	//         trackUserLocation: true,
// 	//         showUserHeading: true
// 	//     }));
// 	// }

// 	// setPov() {
//     //     const camera = this.map.getFreeCameraOptions();
//     //     const position = [138.72649, 35.33974];
//     //     const altitude = 3000;
//     //     camera.position = mapboxgl.MercatorCoordinate.fromLngLat(position, altitude);
//     //     camera.lookAtPoint(lnglat);
//     //     this.map.setFreeCameraOptions(camera);
//     // }

//     // add3DBuilding() {
//     //     // Insert the layer beneath any symbol layer.
//     //     const layers = this.map.getStyle().layers;
//     //     const labelLayerId = layers.find(
//     //     (layer) => layer.type === 'symbol' && layer.layout['text-field']
//     //     ).id;
         
//     //     // The 'building' layer in the Mapbox Streets
//     //     // vector tileset contains building height data
//     //     // from OpenStreetMap.
//     //     this.map.addLayer({
//     //         'id': 'add-3d-buildings',
//     //         'source': 'composite',
//     //         'source-layer': 'building',
//     //         'filter': ['==', 'extrude', 'true'],
//     //         'type': 'fill-extrusion',
//     //         'minzoom': 15,
//     //         'paint': {
//     //             'fill-extrusion-color': '#337ab7',
                 
//     //             // Use an 'interpolate' expression to
//     //             // add a smooth transition effect to
//     //             // the buildings as the user zooms in.
//     //             'fill-extrusion-height': [
//     //                 'interpolate',
//     //                 ['linear'],
//     //                 ['zoom'],
//     //                 15,
//     //                 0,
//     //                 15.05,
//     //                 ['get', 'height']
//     //             ],
//     //             'fill-extrusion-base': [
//     //                 'interpolate',
//     //                 ['linear'],
//     //                 ['zoom'],
//     //                 15,
//     //                 0,
//     //                 15.05,
//     //                 ['get', 'min_height']
//     //             ],
//     //             'fill-extrusion-opacity': 0.6
//     //         }
//     //     }, labelLayerId);
//     // }


//     addMarkerWithSymbol() {
//         this.map.loadImage(
//             'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
//             (error, image) => {
//                 if (error) throw error;
//                 this.map.addImage('custom-marker', image);
//                 // Add a GeoJSON source with 2 points
//                 this.map.addSource('points', {
//                     'type': 'geojson',
//                     'data': {
//                         'type': 'FeatureCollection',
//                         'features': [
// 	                        {
// 	                            // feature for Mapbox DC
// 	                            'type': 'Feature',
// 	                            'geometry': {
// 	                                'type': 'Point',
// 	                                'coordinates': [
// 	                                    -77.03238901390978, 38.913188059745586
// 	                                ]
// 	                            },
// 	                            'properties': {
// 	                                'title': 'Mapbox DC'
// 	                            }
// 	                        },
// 	                        {
// 	                            // feature for Mapbox SF
// 	                            'type': 'Feature',
// 	                            'geometry': {
// 	                                'type': 'Point',
// 	                                'coordinates': [-122.414, 37.776]
// 	                            },
// 	                            'properties': {
// 	                                'title': 'Mapbox SF'
// 	                            }
// 	                        }
// 	                    ]
//                     }
//                 });
                 
//                 // Add a symbol layer
//                 this.map.addLayer({
//                     'id': 'points',
//                     'type': 'symbol',
//                     'source': 'points',
//                     'layout': {
//                         'icon-image': 'custom-marker',
//                         // get the title name from the source's "title" property
//                         'text-field': ['get', 'title'],
//                         'text-font': [
//                             'Open Sans Semibold',
//                             'Arial Unicode MS Bold'
//                         ],
//                         'text-offset': [0, 1.25],
//                         'text-anchor': 'top'
//                     }
//                 });
//             }
//         );
//     }


//     addLineString() {
//         this.map.addSource('route', {
//             'type': 'geojson',
//             'data': {
//                 'type': 'Feature',
//                 'properties': {},
//                 'geometry': {
//                     'type': 'LineString',
//                     'coordinates': [
//                         [121.042728, 14.367669],
//                         [121.054101, 14.359105],
//                     ]
//                 }
//             }
//         });
        
//         this.map.addLayer({
//             'id': 'route',
//             'type': 'line',
//             'source': 'route',
//             'layout': {
//                 'line-join': 'round',
//                 'line-cap': 'round'
//             },
//             'paint': {
//                 'line-color': '#888',
//                 'line-width': 8
//             }
//         });
//     }

//     // addGeocoderPlugin() {
//     //     // Add the control to the map.
//     //     this.map.addControl(
//     //         new MapboxGeocoder({
//     //             accessToken: mapboxgl.accessToken,
//     //             mapboxgl: mapboxgl
//     //         })
//     //     );
//     // }

//     // addNavigationDirection() {
//     //     this.map.addControl(
//     //         new MapboxDirections({
//     //             accessToken: mapboxgl.accessToken
//     //         }),
//     //         'top-left'
//     //     );
//     // }

//     // add3dTerrain() {
//     //     this.map.addSource('mapbox-dem', {
// 	//         'type': 'raster-dem',
// 	//         'url': 'mapbox://mapbox.mapbox-terrain-dem-v1',
// 	//         'tileSize': 512,
// 	//         'maxzoom': 14
//     //     });
//     //     // add the DEM source as a terrain layer with exaggerated height
//     //     this.map.setTerrain({ 'source': 'mapbox-dem', 'exaggeration': 1.5 });
//     // }

//     // addFloodLayer() {
//     // 	this.map.addLayer({
//     //         id: 'flood-quezion-5yr',
//     //         type: 'fill',
//     //         source: {
// 	// 			type: 'geojson',
//     //         	data: app.baseFullUrl + 'default/geojson/flood/quezon/5yr.geojson'
//     //         },
//     //         paint: {
// 	// 			'fill-color': 'blue', // Specify the fill color for the flood area
// 	// 			'fill-opacity': 0.2 // Specify the fill opacity for the flood area (0-1)
//     //         }
//     //     }, 'building');

//     //     /*this.map.addLayer({
//     //         id: 'flood-quezion-25yr',
//     //         type: 'fill',
//     //         source: {
//     //             type: 'geojson',
//     //             data: app.baseFullUrl + 'default/geojson/flood/quezon/25yr.geojson'
//     //         },
//     //         paint: {
//     //             'fill-color': 'blue', // Specify the fill color for the flood area
//     //             'fill-opacity': 0.2 // Specify the fill opacity for the flood area (0-1)
//     //         }
//     //     }, 'building');

//     //     this.map.addLayer({
//     //         id: 'flood-quezion-100yr',
//     //         type: 'fill',
//     //         source: {
//     //             type: 'geojson',
//     //             data: app.baseFullUrl + 'default/geojson/flood/quezon/100yr.geojson'
//     //         },
//     //         paint: {
//     //             'fill-color': 'blue', // Specify the fill color for the flood area
//     //             'fill-opacity': 0.2 // Specify the fill opacity for the flood area (0-1)
//     //         }
//     //     }, 'building');*/
//     // }

// 	init() {
//         // this.initLoadScript(this);

//         this.map.on('load', ()=> {

//             map1.addSource('routes', {
//                 'type': 'geojson',
//                 'data': {
//                   'type': 'FeatureCollection',
//                   'features': features
//                 }
//               });
          
//               map1.addLayer({
//                 'id': 'routes',
//                 'type': 'line',
//                 'source': 'routes',
//                 'paint': {
//                   'line-width': 15,
//                   'line-color': ['get', 'color']
//                 }
//               });
          
//               const geojson = {
//                 'type': 'FeatureCollection',
//                 'features': []
//               };
          
//               for (const waypoint of waypoints) {
//                 geojson.features.push({
//                   'type': 'Feature',
//                   'geometry': {
//                     'type': 'Point',
//                     'coordinates': waypoint
//                   },
//                   'properties': {
//                     'title': 'Mapbox',
//                     'description': 'Washington, D.C.'
//                   }
//                 });
//               }
          
//               // add markers to map
//               for (const feature of geojson.features) {
//                 // create a HTML element for each feature
//                 const el = document.createElement('div');
//                 el.className = 'marker';
          
//                 // make a marker for each feature and add it to the map
//                 new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(new mapboxgl.Popup({
//                   offset: 25
//                 }) // add popups
//                 .setHTML(` < h3 > $ {
//                   feature.properties.title
//                 } < /h3><p>${feature.properties.description}</p > `)).addTo(map1);
//               }
          
//               // Add markers with rotation based on bearing
//               for (let i = 0; i < endpoints.length; i++) {
//                 const feature = {
//                   type: 'Feature',
//                   geometry: {
//                     type: 'Point',
//                     coordinates: endpoints[i]
//                   },
//                   properties: {
//                     title: 'Mapbox',
//                     description: 'Washington, D.C.'
//                   }
//                 };
          
//                 const rotation = 0;
          
//                 new mapboxgl.Marker({
//                   rotation: rotation
//                 }).setLngLat(feature.geometry.coordinates).setPopup(new mapboxgl.Popup({
//                   offset: 25
//                 }).setHTML(` < h3 > $ {
//                   feature.properties.title
//                 } < /h3><p>${feature.properties.description}</p > `)).addTo(map1);
//               }

//         });

//  		// if (this.enableGeocoder) {
// 	    // 	this.addGeocoderPlugin();
//  		// }

//  		// if (this.enableNavigationController) {
// 	    // 	this.addNavigationDirection();
//  		// }
 		
//  		// if (this.enableDrawing) {
// 	    // 	this.addMapboxDraw();
//  		// }

// 	    // this.addMarker();
// 	    // this.addNavigationControl();
// 	    // this.addPopover();
// 	    // this.addScaleControl();
// 	    // this.addGeolocateControl();
// 	    // setPov();

// 	    // this.map.on('click', (e) => {
// 	    //     console.log('click', e);
// 	    // });

//         // this.map.on('dataloading', (e) => {
//         //     this.dataloadingScript(this.map, e);
//         // });

//         // this.map.on('sourcedata', (e) => {
//         //     this.sourcedataScript(this.map, e);
//         // });


// 	    // this.map.on('load', () => {
//         //     this.mapLoadScript(this.map);
// 	    //     // this.addFloodLayer();
// 	    //     // addMarkerWithSymbol();
// 	    //     // addLineString();

// 	    //     // map.addLayer({
// 	    //     //     id: 'terrain-data',
// 	    //     //     type: 'line',
// 	    //     //     source: {
// 	    //     //         type: 'vector',
// 	    //     //         url: 'mapbox://mapbox.mapbox-terrain-v2'
// 	    //     //     },
// 	    //     //     'source-layer': 'contour'
// 	    //     // });

// 	    //     // map.addLayer({
// 	    //     //     id: 'rpd_parks',
// 	    //     //     type: 'fill',
// 	    //     //     source: {
// 	    //     //         type: 'vector',
// 	    //     //         url: 'mapbox://mapbox.3o7ubwm8'
// 	    //     //     },
// 	    //     //     'source-layer': 'RPD_Parks'
// 	    //     // });
// 	    // });

// 	    // this.map.on('style.load', () => {
// 	    //     this.add3DBuilding();

// 	    //     // this.add3dTerrain();
// 	    // });
// 	}
// }

class MapboxWidget {

    constructor({
        zoom,
        center,
        coordinates
    }){
        this.zoom = zoom;
        this.center = center;
        this.coordinates = coordinates;
        this.map = this.createMapInstance();
    }

    createMapInstance(){
        return new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: this.center,
            zoom: this.zoom,
        });
    }

    addLineString() {
        const routes = waypointsList.map(waypoint => ({
            'type': 'Feature',
            'properties': {
              'color': '#33C9EB' // blue
            },
            'geometry': {
              'type': 'LineString',
              'coordinates': waypoint
            }
          }));

        this.map.addSource('route', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': routes
                }
            }
        });

        this.map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#888',
                'line-width': 8
            }
        });
    }

    addPlaces(){

        const places = waypointsLatLng.map(waypoint => (
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

        this.map.addSource('places', {
            'type': 'geojson',
            'data': {
              'type': 'FeatureCollection',
              'features': places
            }
          });

          this.map.addLayer({
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
    }




    init(){

        this.map.load('on', ()=> {

            this.addLineString();
            this.addPlaces();


        })
    }


}


// class MapboxWidget {
//     constructor({
//         accessToken,
//         waypoints,
//         coordinates,
//         styleUrl,
//         mapId,
//         mapZoom
//     }) {
//         mapboxgl.accessToken = accessToken;
//         this.waypoints = waypoints;
//         this.coordinates = coordinates;
//         this.styleUrl = styleUrl;
//         this.mapId = mapId;
//         this.mapZoom = mapZoom;
//         this.map = this.createMapInstance();
//     }

//     createMapInstance() {
//         return new mapboxgl.Map({
//             container: this.mapId,
//             style: this.styleUrl,
//             center: this.waypoints[0],
//             zoom: this.mapZoom || 15,
//         });
//     }

//     addRoutes() {
//         const featuresRoutes = this.coordinates.map(waypoint => ({
//             type: 'Feature',
//             properties: {
//                 color: '#33C9EB'
//             },
//             geometry: {
//                 type: 'LineString',
//                 coordinates: waypoint.map(coord => [parseFloat(coord.lon), parseFloat(coord.lat)])
//             }
//         }));

//         this.map.on('load', () => {
//             this.map.addSource('routes', {
//                 type: 'geojson',
//                 data: {
//                     type: 'FeatureCollection',
//                     features: featuresRoutes
//                 }
//             });

//             this.map.addLayer({
//                 id: 'routes',
//                 type: 'line',
//                 source: 'routes',
//                 paint: {
//                     'line-width': 15,
//                     'line-color': ['get', 'color']
//                 }
//             });
//         });
//     }

//     init() {
//         this.addRoutes();
//     }
// }

