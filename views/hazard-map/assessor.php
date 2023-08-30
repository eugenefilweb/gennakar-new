<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\MapboxHelper;
use app\helpers\Url;
use app\widgets\Mapbox;

$this->title = "Map Visualization | Assessor";
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/hazard-map/assessor';

$this->registerCss(<<< CSS
    label { user-select: none; }
    .color-box {
        width: 20px; 
        height: 20px;
        border-radius: 4px;
    }
CSS);
?>
<div class="hazard-map-index-page">
   <div class="row">
       <div class="col-md-8">
           <?= Mapbox::widget([
                'styleUrl' => Url::to('default/geojson/assessor/style.json', true),
                'height' => '68vh',
                'zoom' => 10,
                'lnglat' => [121.46775688713933, 14.844231191150755],
                'initLoadScript' => <<< JS
                    $('input[name="filter"]').change(function() {
                        const isChecked = $(this).is(':checked');
                        const layerName = $(this).val();
                        const zoom = $(this).data('zoom');
                        if (isChecked) {
                            obj.map.setZoom(zoom);
                            obj.map.setLayoutProperty(layerName, 'visibility', 'visible');
                        }
                        else {
                            obj.map.setLayoutProperty(layerName, 'visibility', 'none');
                        }
                    });

                    $('input[type="range"]').on('input', function() {
                        const opacity = $(this).val();
                        $(this).closest('td').find('span').html('('+opacity+')');
                    });

                    $('input[type="range"]').change(function() {
                        const opacity = $(this).val();
                        const layerName = $(this).closest('tr').data('layer');
                        obj.map.setPaintProperty(layerName, 'fill-opacity', parseFloat(opacity/100));
                    });
                JS
           ]) ?>
       </div>
       <div class="col-md-4" >
            <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 68vh">
                <ul class="nav nav-tabs nav-tabs-line">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#boundaries">
                            Boundaries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#typhoon">
                            Typhoon
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#soil">
                            Soil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#land-cover">
                            Land Cover
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reina">
                            REINA-EIL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#center">
                            Center
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="boundaries" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['boundaries'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                    <div class="tab-pane fade" id="typhoon" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['typhoon'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                    <div class="tab-pane fade" id="soil" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['soil'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                    <div class="tab-pane fade" id="land-cover" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['land_cover'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                    <div class="tab-pane fade" id="reina" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['eil'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                    <div class="tab-pane fade" id="center" role="tabpanel">
                        <?= App::foreach(App::params('mapbox')['layers']['assessor']['center'], fn ($value, $key) => $this->render('_assessor-mapbox-filter', [
                            'title' => ucwords($key),
                            'data' => $value
                        ]) . Html::tag('hr')) ?>
                    </div>
                </div>
            </div>
       </div>
   </div>
</div>