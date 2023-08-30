<?php

use app\models\search\DashboardSearch;
use app\widgets\WeatherApi;

$this->title = 'Weather Monitoring';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page">
	<div class="row">
		<div class="col-md-12">
			<div id="openweathermap-widget-11"></div>

			<script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script><script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 11,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-11',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-15"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 15,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-15',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-12"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 12,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-12',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-13"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 13,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-13',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-16"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 16,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-16',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-18"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 18,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-18',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-14"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 14,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-14',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
		<div class="col-md-12">
			<div id="openweathermap-widget-17"></div>
			<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 17,cityid: '1713024',appid: '5aa4da851b3c5bd5dc8b945666c3f2e7',units: 'metric',containerid: 'openweathermap-widget-17',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>
		</div>
	</div>
</div>
