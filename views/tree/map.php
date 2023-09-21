<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Tree;
use app\models\search\TreeSearch;
use app\widgets\ActiveForm;
use app\widgets\Filter;
use app\widgets\LinkPager;
use app\widgets\OpenLayer;
use app\widgets\SearchButton;
use \yii\data\Pagination;
use yii\web\View;

$this->title = 'Trees: Map';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel;
$this->params['showCreateButton'] = true;
$this->params['activeMenuLink'] = '/tree/map';
$this->params['wrapCard'] = false;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);


?>



<div class="tree-map-index-page">
    <div class="row">
        <div class="col-md-8">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map View',
                'toolbar' => '<div class="card-toolbar">
                    <span class="lead font-weight-bold">Trees Found: ' . number_format($total) . '</span>
                    ' . Html::popupCenter('Print Report', Url::toRoute(['tree/print-map-report?']) . http_build_query(App::queryParams()), [
                                'class' => 'btn btn-success font-weight-bold ml-10'
                            ]) . '
                </div>',
                'stretch' => true
            ]) ?>

            <?php /*
            <?= OpenLayer::widget([
            'coordinates' => $coordinates,
            'zoom' => $searchModel->map_zoom_level,
            ]) ?>

            */?>

            <div id="map" style="height: 100%;"></div>

            <?php $this->endContent() ?>
        </div>
        <div class="col-md-4">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Advanced Filter',
            ]) ?>
            <?php $form = ActiveForm::begin(['id' => 'tree-form', 'method' => 'get', 'action' => ['tree/map']]); ?>
            <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 60vh">
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-filter">
                    <?= App::foreach($searchModel->advancedFilterAttributes, fn($attribute) => $this->render('_map-advanced-filter', [
                        'form' => $form,
                        'searchModel' => $searchModel,
                        'attribute' => $attribute
                    ])) ?>

                    <?= $this->render('_map-advanced-filter', [
                        'form' => $form,
                        'searchModel' => $searchModel,
                        'attribute' => 'status',
                        'data' => [
                            Tree::VALIDATED => 'Validated',
                            Tree::NOT_VALIDATED => 'Not Validated',
                        ]
                    ]) ?>

                    <label for="map_zoom_level" class="mt-3">Map Zoom Level</label>
                    <div>
                        <input type="range" id="map_zoom_level" name="map_zoom_level" min="1" max="20"
                            value="<?= $searchModel->map_zoom_level ?>" step="1" style="width: -webkit-fill-available;">
                    </div>

                    <?= LinkPager::widget([
                        'options' => [
                            'class' => 'mt-5 justify-content-center app-linkpager d-flex flex-wrap justify-content-center py-2'
                        ],
                        'pagination' => new Pagination(['totalCount' => $dataProvider->totalCount])
                    ]) ?>
                </div>
            </div>
            <div class="mt-5">
                <?= SearchButton::widget() ?>
            </div>
            <?php ActiveForm::end(); ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>

<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

    const waypoints = <?= json_encode($coordinates) ?>;

    const map1 = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [121.3578111,14.87946389],
        zoom: <?= json_encode($searchModel->map_zoom_level ?: 9) ?>,
    });

    const createTreeMarkerElement = () => {
        const markerElement = document.createElement('div');
        markerElement.className = 'tree-marker';
        markerElement.innerHTML = `<?= Html::img("/assets/svg/park-alt1.svg", ['width' => 35, 'height' => 35]) ?>`

        return markerElement;
    }

    map1.on('load', () => {

        waypoints.map(tree => {
            const popupHtml = `<div class="m-1" style="background-color: #ffffff;">
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 mb-3 mt-2">
                                    <img src=${tree.photo_url ? tree.photo_url : "/assets/svg/tree.jpg"} style="width:100%; height:100%;">
                                </div>
                                <h3 class="text-center">${tree.common_name.toUpperCase()}</h3>
                                <div>
                                    <div>Longitude: ${tree.longitude}</div>
                                    <div>Latitude: ${tree.latitude}</div>
                                    ${tree.date_encoded ? `<div>Date: ${tree.date_encoded}</div>` : ""}
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <a href=${`/tree/${tree.id}`} class="see-more-link pointer text-primary" target="_blank" id="see-more-link" onmouseover="color='lighten(primary, 80%)';">
                                    See more...
                                    </a>
                                </div>
                            </div>`

            const treeMarker = createTreeMarkerElement();
            new mapboxgl.Marker({ element: treeMarker })
                .setLngLat([tree.longitude ?? null, tree.latitude ?? null])
                .setPopup(
                    new mapboxgl.Popup().setHTML(popupHtml))
                .addTo(map1);
        })

    });

</script>

