
<!-- <script>

	mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
		const map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v12',
			center: [121.0772825, 14.336127],
			zoom: 13
		});

let waypoints1=[[121.0356339,14.5757805],[121.0357106,14.5757503],[121.0357937,14.5757234],[121.0358788,14.5757098],[121.0359599,14.5757066],[121.0360376,14.5757147],[121.0361093,14.5757285],[121.0361676,14.5757452],[121.0362425,14.5757742],[121.0363057,14.5757943],[121.0363796,14.5758169],[121.036431,14.5758342],[121.0364903,14.575852],[121.0365553,14.5758691],[121.0366267,14.5758869],[121.0367029,14.5759051],[121.0367844,14.575923],[121.0368713,14.5759398],[121.037053,14.5759763],[121.0371505,14.5759935],[121.0372463,14.5760116],[121.0373393,14.5760296],[121.0374296,14.5760471],[121.0375189,14.5760675],[121.0376049,14.5760877],[121.0376869,14.5761085],[121.0377663,14.5761274],[121.0378491,14.5761441],[121.0379271,14.5761602],[121.0380002,14.5761736],[121.0380715,14.5761878],[121.0381322,14.5762024],[121.0381904,14.5762142],[121.038247,14.5762251],[121.0382994,14.5762361],[121.038354,14.5762468],[121.0384129,14.5762579],[121.0384725,14.5762711],[121.0385325,14.5762851],[121.0385915,14.5763004],[121.0386403,14.5763139],[121.0387073,14.5763474],[121.0387388,14.5764469],[121.0387362,14.5765122],[121.0387382,14.576579],[121.0387403,14.5766472],[121.0387397,14.5767291],[121.0387401,14.5767895],[121.0387439,14.5768475],[121.0387466,14.5768933],[121.0387492,14.5769395],[121.0387588,14.5770162],[121.0387707,14.5770675],[121.03878,14.577141],[121.0387747,14.5772376],[121.0387641,14.5773057],[121.0387545,14.57737],[121.0387428,14.5774285],[121.0387308,14.5774808],[121.0387144,14.5775514],[121.038706,14.577599],[121.0387164,14.5776439],[121.0387843,14.5776792],[121.0388388,14.5776883],[121.0389002,14.577698],[121.0389623,14.5777107],[121.0390215,14.5777254],[121.0390752,14.577741],[121.0391584,14.5777785],[121.0391993,14.5778185],[121.0392776,14.5778638],[121.0393467,14.5778896],[121.0394133,14.5778945],[121.0395044,14.5778742],[121.0395613,14.5778516],[121.0396176,14.5778301],[121.0396795,14.5778091],[121.0397453,14.5777854],[121.0398079,14.5777643],[121.0398686,14.577744],[121.0399271,14.5777241],[121.0399858,14.5777031],[121.0400445,14.5776824],[121.0401005,14.5776628],[121.0401568,14.5776437],[121.0402129,14.5776262],[121.0402681,14.5776103],[121.0403225,14.5775933],[121.0403763,14.5775761],[121.0404283,14.5775595],[121.0404817,14.5775419],[121.0405378,14.577526],[121.0405945,14.5775121],[121.0406482,14.5774971],[121.0406984,14.5774828],[121.0407453,14.5774691],[121.040793,14.577454],[121.0408416,14.577437],[121.0408919,14.5774202],[121.0409398,14.5774036]];
let waypoints2=[[121.0651471,14.600898],[121.0654558,14.6009703],[121.0656084,14.6010058],[121.0657606,14.6010417],[121.0659134,14.6010778],[121.066065,14.6011131],[121.0662123,14.6011457],[121.0663469,14.6011776],[121.0664712,14.6012069],[121.0665892,14.6012349],[121.0666987,14.601261],[121.0668044,14.6012863],[121.0669092,14.6013114],[121.0670191,14.6013392],[121.067134,14.6013725],[121.0672528,14.6014067],[121.0673726,14.6014361],[121.0674928,14.6014634],[121.0676151,14.6014901],[121.0677371,14.6015187],[121.0678535,14.6015454],[121.0679672,14.6015715],[121.0680784,14.6015971],[121.0681844,14.601622],[121.0682839,14.6016462],[121.0683746,14.601667],[121.0684484,14.6016838],[121.0685045,14.6016965],[121.0685509,14.6017067],[121.0686426,14.6017261],[121.0687193,14.6017422],[121.0688013,14.6017623],[121.0688761,14.6017881],[121.0689175,14.6018151],[121.0689799,14.6018981],[121.0690043,14.6019507],[121.0690338,14.602022],[121.0690597,14.6020897],[121.0690765,14.6021334],[121.0691088,14.6022165],[121.0691303,14.6022727],[121.0691494,14.602325],[121.069169,14.6023822],[121.0691875,14.6024374],[121.0692196,14.6025255],[121.0692404,14.6025753],[121.0692612,14.6026296],[121.0692901,14.602704],[121.0693166,14.6027707],[121.0693432,14.6028343],[121.0693698,14.6029014],[121.0693976,14.6029697],[121.0694262,14.6030382],[121.0694528,14.6031099],[121.0694797,14.60318],[121.0695062,14.6032484],[121.0695322,14.6033168],[121.0695597,14.6033864],[121.0695872,14.6034577],[121.0696165,14.6035311],[121.069646,14.6036053],[121.0696746,14.6036816],[121.0697027,14.6037573],[121.06973,14.6038314],[121.0697602,14.6039041],[121.0697879,14.6039764],[121.0698164,14.6040503],[121.0698457,14.6041235],[121.0698721,14.6041964],[121.0698985,14.6042668],[121.0699245,14.6043351],[121.0699511,14.604404],[121.0699778,14.6044722],[121.0700024,14.6045351],[121.0700241,14.6045928],[121.0700443,14.6046495],[121.0700626,14.6047038],[121.0700774,14.604747],[121.0701036,14.6048134],[121.0701239,14.6048711],[121.0701433,14.6049451],[121.0701537,14.6050065],[121.0701628,14.6050715],[121.0701725,14.6051412],[121.0701814,14.6052154],[121.0701874,14.6052949],[121.0701957,14.6053761],[121.0702042,14.6054599],[121.0702156,14.6055493],[121.0702276,14.6056361],[121.0702384,14.6057247],[121.0702488,14.6058149],[121.0702585,14.6059065],[121.0702715,14.6059981],[121.070284,14.6060889],[121.0702961,14.60618],[121.0703073,14.606272],[121.0703171,14.6063632],[121.0703268,14.6064542],[121.0703362,14.6065394]];

 function extractProportionalItems1(items, numberOfItemsToExtract=25) {
    const extractedItems = [items[0]]; // Include the first item
    const extractedItemsIndex = [0];

    if (numberOfItemsToExtract > 2) {
      const step = (items.length - 1) / (numberOfItemsToExtract - 2);
      
      for (let i = 1; i < numberOfItemsToExtract - 1; i++) {
        const index = Math.floor(i * step);
        extractedItems.push(items[index]);
        extractedItemsIndex.push(index);
      }
    }

    extractedItems.push(items[items.length - 1]); // Include the last item
    extractedItemsIndex.push(items.length - 1); // Include the last item

    // console.log(extractedItemsIndex);

    return extractedItems;
  }

  // const numberOfItemsToExtract = 25;
  waypoints1 = extractProportionalItems1(waypoints1, numberOfItemsToExtract=25);

 function extractProportionalItems2(items, numberOfItemsToExtract=25) {
    const extractedItems = [items[0]]; // Include the first item
    const extractedItemsIndex = [0];

    if (numberOfItemsToExtract > 2) {
      const step = (items.length - 1) / (numberOfItemsToExtract - 2);
      
      for (let i = 1; i < numberOfItemsToExtract - 1; i++) {
        const index = Math.floor(i * step);
        extractedItems.push(items[index]);
        extractedItemsIndex.push(index);
      }
    }

    extractedItems.push(items[items.length - 1]); // Include the last item
    extractedItemsIndex.push(items.length - 1); // Include the last item

    // console.log(extractedItemsIndex);

    return extractedItems;
  }

  // const numberOfItemsToExtract2 = 25;
  waypoints2 = extractProportionalItems2(waypoints2, numberOfItemsToExtract=25);

  // console.log(waypoints);

  // const waypoints1Count = waypoints1.length;
  // const waypoints1Middle = Math.floor(waypoints1Count / 2);
  // waypoints1 = [waypoints1[0], waypoints1[waypoints1Middle-1], waypoints1[waypoints1Count - 1]];

  // const waypoints2Count = waypoints2.length;
  // const waypoints2Middle = Math.floor(waypoints2Count / 2);
  // waypoints2 = [waypoints2[0], waypoints2[waypoints2Middle-2], waypoints2[waypoints2Count - 2]];

		// Add the Mapbox Directions control
		const directions1 = new MapboxDirections({
			accessToken: mapboxgl.accessToken,
			unit: 'metric',                  // Choose the unit for distance ('imperial' or 'metric')
			profile: 'mapbox/driving',       // Choose the profile for directions (e.g., 'mapbox/driving', 'mapbox/cycling')
			alternatives: false,             // Show alternative routes (true/false)
			controls: { inputs: false, instructions: false }, // Configure control elements
			interactive: true,            // Enable user interaction with the map
		});

		// Add the Mapbox Directions control
		const directions2 = new MapboxDirections({
			accessToken: mapboxgl.accessToken,
			unit: 'metric',                  // Choose the unit for distance ('imperial' or 'metric')
			profile: 'mapbox/driving',       // Choose the profile for directions (e.g., 'mapbox/driving', 'mapbox/cycling')
			alternatives: false,             // Show alternative routes (true/false)
			controls: { inputs: false, instructions: false }, // Configure control elements
			interactive: true                // Enable user interaction with the map
		});

		map.addControl(directions1, 'top-left');
		// map.addControl(directions2, 'top-right');
    // map.scrollZoom.disable();

    function loadDirections1() {
      for (let i = 0; i < waypoints1.length; i++) {
        if (i === 0) {
          directions1.setOrigin(waypoints1[i]);
        } else if (i === waypoints1.length - 1) {
          directions1.setDestination(waypoints1[i]);
        } else {
          directions1.addWaypoint(i - 1, waypoints1[i]);
        }
      }
      // directions1.route();
    }

    function createWaypointMarkers1() {
      waypoints1.forEach((waypoint, index) => {
          const marker = new mapboxgl.Marker()
              .setLngLat(waypoint)
              .addTo(map);
      });
    }
    function createWaypointMarkers2() {
      waypoints2.forEach((waypoint, index) => {
          const marker = new mapboxgl.Marker()
              .setLngLat(waypoint)
              .addTo(map);
      });
    }

    function loadDirections2() {
      for (let i = 0; i < waypoints2.length; i++) {
        if (i === 0) {
          directions2.setOrigin(waypoints2[i]);
        } else if (i === waypoints2.length - 1) {
          directions2.setDestination(waypoints2[i]);
        } else {
          directions2.addWaypoint(i - 1, waypoints2[i]);
        }
      }
      // directions.route();
    }


    map.on('load',  function() {
      loadDirections1();
      // loadDirections2();
      createWaypointMarkers1();
      createWaypointMarkers2();
    });

</script> -->

