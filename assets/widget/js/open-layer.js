class OperLayerWidget {

    constructor({addMarkers, clearMarkersOnClick, widgetId, lat, lon, zoom, clickCallback, clickable, coordinates, description, withLine, withSearch, addStartMarker, addEndMarker, showCurrentLocation, multipleCoordinates}) {
        this.widgetId = widgetId;
        this.lat = lat;
        this.lon = lon;
        this.zoom = zoom;
        this.clickCallback = clickCallback;
        this.clickable = clickable;
        this.coordinates = coordinates;
        this.description = description;
        this.withLine = withLine;
        this.withSearch = withSearch;
        this.clearMarkersOnClick = clearMarkersOnClick;
        this.addMarkers = addMarkers;
        this.addStartMarker = addStartMarker;
        this.addEndMarker = addEndMarker;
        this.showCurrentLocation = showCurrentLocation;
        this.multipleCoordinates = multipleCoordinates;
    }

	addMarkerLayer = ({lat, lon, description, markerUrl}) => {
		let [_lat, _lon] = ol.proj.fromLonLat([lon, lat]);

		markerUrl = markerUrl ? markerUrl: app.mapMarkerUrl;

	    var markerGeometry = new ol.geom.Point([_lat, _lon]);

	    var description = description ? description: `
	    	<div> 
	    		<b>Waypoint Details </b> 
	    		<br><strong>Latitude</strong>: ${_lat}
	    		<br><strong>Longitude</strong>: ${_lon}
    		</div>
	    `;

	    var markerFeature = new ol.Feature({
			type: 'Point',
	        geometry: markerGeometry,
	        desc: description,
	    });

	    var markerStyle = new ol.style.Icon(({
	        src: markerUrl
	    }));

	    markerFeature.setStyle(new ol.style.Style({
	        image: markerStyle,
	    }));

	    var vectorSource = new ol.source.Vector({
	        features: [markerFeature]
	    });

	    var markerLayer = new ol.layer.Vector({
	        title: "RoutePoint",
	        visible: true,
	        source: vectorSource,
	        name: 'Marker',
	    });

	    return markerLayer;
	}

	addLineLayer = ({coordinate, start}) => {
		let {lat, lon} = this.convertCoordinate(coordinate);

		var line_feat1 = new ol.Feature({
			geometry: new ol.geom.LineString([
				start,
				[lat, lon]
			]),
			name: "My_Simple_LineString"
		});
		var veclay_line = new ol.layer.Vector({
			source: new ol.source.Vector({
				features: [line_feat1],
				wrapX: false
			}),
			style: new ol.style.Style({
				stroke: new ol.style.Stroke({
					color: "#f64e60",
					width: 4,
					lineDash: [7, 7, 7],
					// lineCap: "butt"
				})
			})
		});

		return veclay_line;
	}

	addSearch = () => {
		return new Geocoder('nominatim', {
			provider: 'osm',
			lang: 'en-US',
			placeholder: 'Search for ...',
			targetType: 'text-input',
			limit: 5,
			keepOpen: true
		});
	}

	addGeoLocation = (view, map) => {
		// GEOLOCATION
		const geolocation = new ol.Geolocation({
			trackingOptions: {
				enableHighAccuracy: true,
			},
			projection: view.getProjection(),
		});
		geolocation.setTracking(true);
		geolocation.on('error', function (error) {
			console.log('geolocation_error', error)
		});
		const accuracyFeature = new ol.Feature();
		geolocation.on('change:accuracyGeometry', function () {
			accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
		});
		const positionFeature = new ol.Feature();
		positionFeature.setStyle(
			new ol.style.Style({
				image: new ol.style.Circle({
					radius: 6,
					fill: new ol.style.Fill({
						color: '#3399CC',
					}),
					stroke: new ol.style.Stroke({
						color: '#fff',
						width: 2,
					}),
				}),
			})
		);
		geolocation.on('change:position', function () {
			const coordinates = geolocation.getPosition();
			positionFeature.setGeometry(coordinates ? new ol.geom.Point(coordinates) : null);
		});
		new ol.layer.Vector({
			map: map,
			source: new ol.source.Vector({
				features: [accuracyFeature, positionFeature],
			}),
		});
		// GEOLOCATION
	}

	convertCoordinate(coordinate) {
		let {lon, lat} = coordinate;
		let [_lat, _lon] = ol.proj.fromLonLat([lon, lat]);

		return {
			lat:_lat,
			lon:_lon,
		}
	}

	addStartingMarker = (map, coordinate) => {
		let {lon, lat} = this.convertCoordinate(coordinate);

		map.addLayer(this.addMarkerLayer({
			lat,
			lon,
			description: coordinate['description'],
			markerUrl: coordinate['mapStartMarkerUrl'] || app.mapStartMarkerUrl
		}));
	}

	addEndingMarker = (map, coordinate) => {
		let {lon, lat} = this.convertCoordinate(coordinate);

		map.addLayer(this.addMarkerLayer({
			lat,
			lon,
			description: coordinate['description'],
			markerUrl: coordinate['mapEndMarkerUrl'] || app.mapEndMarkerUrl
		}));
	}

	addStartingEndingMarker = (map, coordinates) => {
		if (this.addStartMarker) {
			this.addStartingMarker(map, coordinates[0]);
		}

		if (this.addEndMarker) {
			this.addEndingMarker(map, coordinates[coordinates.length - 1]);
		}
	}


	addCoordinates = (map, coordinates) => {
		this.addStartingEndingMarker(map, coordinates);

		var start = [];
		for(let index in coordinates) {
			var coordinate = coordinates[index];
			let {lon, lat} = this.convertCoordinate(coordinate);

			if (this.addMarkers) {
				map.addLayer(this.addMarkerLayer({
					lat,
					lon,
					description: coordinate['description']
				}));
			}

			// START DRAW LINE
			if (this.withLine) {
				if (start.length == 0) {
					start = [lat, lon];
				}
				map.addLayer(this.addLineLayer({start, coordinate}));
				start = [lat, lon];
			}
			// END DRAW LINE
		}
	}

	pointermove = (e, map, popup, content) => {
		var feature = map.forEachFeatureAtPixel(e.pixel, function (feat, layer) {
            return feat;
        });

        if (feature && feature.get('type') == 'Point') {
            var coordinate = e.coordinate;    //default projection is EPSG:3857 you may want to use ol.proj.transform

            content.innerHTML = feature.get('desc');
            popup.setPosition(coordinate);
        }
        else {
            popup.setPosition(undefined);
        }
	}

	click = (e, map) => {
		if (this.clickable) {
			if (this.clearMarkersOnClick) {
			    // clear the markers
			    map.getLayers().forEach(layer => {
			        if (layer && layer.get('name') === "Marker") {
			            map.removeLayer(layer);
			        }
			    });
			}
		    // Get the coordinate of the clicked point
		    // let {lat, lon} = this.convertProjectedToGeographic(map.getCoordinateFromPixel(e.pixel));
		    let [_lat, _lon] = map.getCoordinateFromPixel(e.pixel);
		    let [lon, lat] = ol.proj.toLonLat([_lat, _lon]);

		    let options = {lat, lon};
		    map.addLayer(this.addMarkerLayer(options));
		  
		    this.clickCallback(e, options);
		}
	}

    init() {
    	let self = this;
    	let {lat, lon} = this.convertCoordinate({lat: self.lat, lon: self.lon});

		// var coordinate = ol.proj.fromLonLat([self.lon, self.lat]);
		const view = new ol.View({
			center: [lat, lon],
			zoom: self.zoom,
		});
		var map = new ol.Map({
		    target: `open-layer-${self.widgetId}`,
		    layers: [
		        new ol.layer.Tile({
		            source: new ol.source.OSM()
		        }),
		    ],
			view,
		});

		if (self.showCurrentLocation) {
			self.addGeoLocation(view, map);
		}

		if (self.withSearch) {
			map.addControl(self.addSearch());
		}

		if (self.coordinates && self.coordinates.length) {
			self.addCoordinates(map, self.coordinates);
		}
		else if (self.multipleCoordinates && self.multipleCoordinates.length) {
			for(let index in self.multipleCoordinates) {
				self.addCoordinates(map, self.multipleCoordinates[index]);
			}
		}
		else {
			map.addLayer(self.addMarkerLayer({ lat:self.lat, lon:self.lon, description: self.description}));
		}

	    var popup = new ol.Overlay({
	        element: document.getElementById(`popup-${self.widgetId}`),
	        autoPan: true,
	        autoPanAnimation: {
	            duration: 250
	        }
	    });
	    map.addOverlay(popup);
	    
        var content = document.getElementById(`popup-content-${self.widgetId}`);
		map.on('pointermove', function(e) {
			self.pointermove(e, map, popup, content);
		});

		map.on('click', function(e) {
			self.click(e, map);
		});
    }
}

