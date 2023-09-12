<?php

use app\helpers\App;

$this->addCssFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');
$this->addJsFile('mapbox/api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl');

$this->registerWidgetCssFile('mapbox');
$this->registerWidgetJsFile('mapbox-gl');

$this->registerJs(<<< JS
    (new MapboxWidget({
    	widgetId: 'mapbox-{$widgetId}',
    	accessToken: '{$access_token}',
			
    })).init();
JS);

?>

<div id="mapbox-<?= $widgetId ?>" style="height: <?= $height ?>">test</div>

<?php /*
<div class="">
    <div id="mapbox-<?= $widgetId ?>" style="height: <?= $height ?>"></div>
    <?= App::if($enableDrawing == 'true', <<< HTML
	    <div class="calculation-box"> 
	    	<div id="calculated-area">
	    		Calculate Area by drawing
	    	</div>
	    </div>
	HTML) ?>
</div>