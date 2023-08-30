<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\Mapbox;

$this->title = "Map Visualization";
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/hazard-map/mapbox';

$this->registerCss(<<< CSS
    label { user-select: none; }
    .color-box {
        width: 20px; 
        height: 20px;
        border-radius: 4px;
    }

    input[type="range"] {
      -webkit-appearance: none;
      width: 100%;
      height: 20px;
      border-radius: 4px;
    }
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
          width: 15px;
          height: 15px;
          background: #fff;
          border-radius: 50%;
          cursor: pointer;
    }

CSS);
?>
<div class="hazard-map-index-page">
   <div class="row">
       <div class="col-md-8">
           <?= Mapbox::widget([
                'height' => '85vh',
                'initLoadScript' => <<< JS
                    $('input[name="filter"]').change(function() {
                        const isChecked = $(this).is(':checked');
                        const layerName = $(this).val();
                        
                        if (isChecked) {
                            obj.map.setLayoutProperty(layerName, 'visibility', 'visible');
                        }
                        else {
                            obj.map.setLayoutProperty(layerName, 'visibility', 'none');
                        }
                    });

                    // $('input[type="color"]').change(function() {
                    //     const color = $(this).val();

                    //     const layerName = $(this).closest('tr').data('layer');

                    //     obj.map.setPaintProperty(layerName, 'fill-color', color);
                    // });

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
       <div class="col-md-4">

            <?= $this->render('_mapbox-filter', [
                'label' => 'Flood Hazard',
                'data' => App::params('mapbox')['layers']['flood']
            ]) ?>
            <hr>
            <?= $this->render('_mapbox-filter', [
                'label' => 'Storm Surge',
                'data' => App::params('mapbox')['layers']['storm_surge']
            ]) ?>
            <hr>
            <?= $this->render('_mapbox-filter', [
                'label' => 'Landslide',
                'data' => App::params('mapbox')['layers']['landslide']
            ]) ?>
            <hr>
            <?= $this->render('_mapbox-filter', [
                'label' => 'Boundaries',
                'data' => App::params('mapbox')['layers']['boundaries']
            ]) ?>
            <hr>

       </div>
   </div>
</div>