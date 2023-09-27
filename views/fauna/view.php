<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Fauna;
use app\models\search\FaunaSearch;
use app\widgets\ActiveForm;
use app\widgets\Anchors;
use app\widgets\DataList;
use app\widgets\Detail;
use app\widgets\OpenLayer;


use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Fauna */

$this->title = 'Fauna: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => $model->indexLabel, 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => "Patrol: {$model->patrolTripId}", 'url' => $model->patrolViewUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new FaunaSearch();
$this->params['showCreateButton'] = true;
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = $model->activeMenuLink;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);


$this->registerJs(<<<JS
    $('.btn-validate').click(function() {
        KTApp.block('#fauna-form', {
            overlayColor: '#000000',
            state: 'primary',
            message: 'Validating...'
        })
        $('#fauna-form').submit();
    });
JS);


?>

<div class="fauna-view-page">
    <?= Anchors::widget([
        'names' => ['update', 'duplicate', 'delete', 'log'],
        'model' => $model
    ]) ?>
    <?= App::if($model->isNotValidated, Html::a('Validate', '#modal-validate', [
        'class' => 'btn btn-primary font-weight-bold',
        'data-toggle' => 'modal',
    ])) ?>
    <div class="my-3"></div>
    <div class="row">
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'General Information',
                'stretch' => true
            ]) ?>
            <?= Detail::widget([
                'model' => $model
            ]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map Coordinates',
                'stretch' => true
            ]) ?>
            <?php /*
                <?= OpenLayer::widget([
                'latitude' => $model->latitude,
                'longitude' => $model->longitude,
                ]) ?>

                */?>

            <div id="map" style="height: 40%;"></div>

            <?= Detail::widget([
                'model' => $model,
                'attributes' => [
                    'latitude:raw',
                    'longitude:raw',
                ]
            ]) ?>
            <?php $this->endContent() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Photos',
                'stretch' => true
            ]) ?>
            <!-- <table class="table table-bordered">
                    <tbody>
                        <?php //echo App::foreach(Fauna::PHOTO_KEYS, function($label, $attribute) use($model) {
                        // $data = App::foreach($model->photos[$attribute] ?? [], 
                        //     fn($token) => Html::tag('a', Html::image($token, ['w' => 200], [
                        //         'class' => 'img-fluid m-2 symbol img-thumbnail',
                        //         'style' => 'height: 150px'
                        //     ]), [
                        //         'href' => $token ? Url::toRoute(['file/viewer', 'token' => $token]):  Url::toRoute(['file/viewer', 'token' => App::setting('image')->image_holder]),
                        //         'target' => '_blank'
                        //     ])
                        // );
                        // return <<< HTML
                        //     <tr>
                        //         <th>{$label}</th>
                        //         <td> {$data} </td>
                        //     </tr>
                        // HTML;
                        // }) ?>
                    </tbody>
                </table> -->

            <?php if (count(array_filter($model->photos, 'is_array')) > 0) { ?>

                <?php $photos = array_merge([], ...array_values($model->photos)); //unpack categories as flat array values ?>

                <?php $data = App::foreach(
                    $photos ?? [],
                    fn($token) => Html::tag('a', Html::image($token, ['w' => 200], [
                        'class' => 'img-fluid m-2 symbol img-thumbnail',
                        'style' => 'height: 150px'
                    ]), [
                        'href' => $token ? Url::toRoute(['file/viewer', 'token' => $token]) : Url::toRoute(['file/viewer', 'token' => App::setting('image')->image_holder]),
                        'target' => '_blank'
                    ])
                ); ?>
                <?= $data ?>

            <?php } else { ?>

                <?php $data = App::foreach(
                    $model->photos ?? [],
                    fn($token) => Html::tag('a', Html::image($token, ['w' => 200], [
                        'class' => 'img-fluid m-2 symbol img-thumbnail',
                        'style' => 'height: 150px'
                    ]), [
                        'href' => $token ? Url::toRoute(['file/viewer', 'token' => $token]) : Url::toRoute(['file/viewer', 'token' => App::setting('image')->image_holder]),
                        'target' => '_blank'
                    ])
                ); ?>

                <?= $data ?>

            <?php } ?>


            <?php $this->endContent() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-validate" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validate Fauna Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success font-weight-bold btn-validate">
                    Validate
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

    const coordinates = [<?= json_encode($coordinates) ?>];

    const map1 = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [coordinates[0].longitude, coordinates[0].latitude],
        zoom: 10,
    });

    const createTreeMarkerElement = () => {
        const markerElement = document.createElement('div');
        markerElement.className = 'tree-marker';
        markerElement.innerHTML = `<?= Html::img("/assets/svg/hummingbird.svg", ['width' => 35, 'height' => 35]) ?>`

        return markerElement;
    }

    map1.on('load', () => {
        coordinates.map(coordinate => {
            const popupHtml = `<div class="m-1" style="background-color: #ffffff;">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100 mb-3 mt-2">

                            <?= App::foreach() ?>
                                <?= Html::tag('a', Html::image($coordinates['token'], ['w' => 200, 'h' => 200], [
                                    'style' => ['height: 100%; width: 100%;']
                                ]), [
                                    'href' => $coordinates['token'] ? Url::toRoute(['file/viewer', 'token' => $coordinates['token']]) : Url::toRoute(['file/viewer', 'token' => App::setting('image')->image_holder]),
                                    'target' => '_blank'
                                ]) ?>
                                
                            </div>
                            <h3 class="text-center">${coordinate.common_name.toUpperCase()}</h3>
                            <div>
                                <div>Longitude: ${coordinate.longitude}</div>
                                <div>Latitude: ${coordinate.latitude}</div>
                                ${coordinate.date_encoded ? `<div>Date: ${coordinate.date_encoded}</div>` : ""}
                            </div>
                        </div>`;

            const coordinateMarker = createTreeMarkerElement();
            new mapboxgl.Marker({ element: coordinateMarker })
                .setLngLat([coordinate.longitude ?? null, coordinate.latitude ?? null])
                .setPopup(
                    new mapboxgl.Popup().setHTML(popupHtml))
                .addTo(map1);
        })
    });

</script>