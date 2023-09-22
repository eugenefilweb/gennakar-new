<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Tree;
use app\models\search\TreeSearch;
use app\widgets\ActiveForm;
use app\widgets\Anchors;
use app\widgets\DataList;
use app\widgets\Detail;
use app\widgets\OpenLayer;

use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Tree */

$this->title = 'Tree: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => $model->indexLabel, 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => "Patrol: {$model->patrolTripId}", 'url' => $model->patrolViewUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new TreeSearch();
$this->params['showCreateButton'] = true;
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = $model->activeMenuLink;

$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css', ['position' => View::POS_HEAD]);
$this->registerJsFile('https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js', ['position' => View::POS_HEAD]);

$this->registerJs(<<<JS
    $('.btn-validate').click(function() {
        KTApp.block('#tree-form', {
            overlayColor: '#000000',
            state: 'primary',
            message: 'Validating...'
        })
        $('#tree-form').submit();
    });
JS);

?>
<div class="tree-view-page">
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

            <?php
            /*
            <?= OpenLayer::widget([
                'latitude' => $model->latitude,
                'longitude' => $model->longitude,
            ]) ?>
            */
            ?>

            <div id="map" style="height: 72%;"></div>

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
            <table class="table table-bordered">
                <tbody>

                    <?php /*
                   <?= App::foreach(Tree::PHOTO_KEYS, function($label, $attribute) use($model) {
                       $data = App::foreach($model->photos[$attribute] ?? [], 
                           fn($token) => Html::tag('a', Html::image($token, ['w' => 200], [
                               'class' => 'img-fluid m-2 symbol img-thumbnail',
                               'style' => 'height: 150px'
                           ]), [
                               'href' => $token ? Url::toRoute(['file/viewer', 'token' => $token]):  Url::toRoute(['file/viewer', 'token' => App::setting('image')->image_holder]),
                               'target' => '_blank'
                           ])
                       );
                       return <<< HTML
                           <tr>
                               <th>{$label}</th>
                               <td> {$data} </td>
                           </tr>
                       HTML;
                   }) ?>
                   */?>

                </tbody>
            </table>

            <?php $this->endContent() ?>
        </div>
    </div>

</div>

<div class="modal fade" id="modal-validate" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validate Tree Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'tree-form', 'action' => ['tree/validate', 'id' => $model->id]]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'common_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'kingdom',
                            'data' => Tree::filter('kingdom')
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'family',
                            'data' => Tree::filter('family')
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'genus',
                            'data' => Tree::filter('genus')
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'species',
                            'data' => Tree::filter('species')
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'sub_species',
                            'data' => Tree::filter('sub_species')
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'varieta_and_infra_var_name',
                            'data' => Tree::filter('varieta_and_infra_var_name')
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DataList::widget([
                            'form' => $form,
                            'model' => $model,
                            'attribute' => 'taxonomic_group',
                            'data' => Tree::filter('taxonomic_group')
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                        <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
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

<div class="row">
    <div class="col-md-12">

        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => 'Photos',
            'stretch' => true
        ]) ?>

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

<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';

    const waypoints = [<?= json_encode($tree) ?>];

    const map1 = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [waypoints[0].longitude, waypoints[0].latitude],
        zoom: 10,
    });

    const createTreeMarkerElement = () => {
        const markerElement = document.createElement('div');
        markerElement.className = 'tree-marker';
        markerElement.innerHTML = `<?= Html::img("/assets/svg/park-alt1.svg", ['width' => 35, 'height' => 35]) ?>`

        return markerElement;
    }

    map1.on('load', () => {
        waypoints.map(tree => {
            const tokenParam = tree['token'] ? 'token=' + tree['token'] : 'token=' + App.setting('image').image_holder;
            const href = `file/viewer?${tokenParam}`;
            const baseUrl = 'file/viewer';

            const popupHtml = `<div class="m-1" style="background-color: #ffffff;">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100 mb-3 mt-2">
                                <a href="file/viewer" target="_blank">
                                    <img src="${tree['photo_url'] || '/assets/svg/tree.jpg'}" style="width: 100%; height: 100%;">
                                </a>
                            </div>
                            <h3 class="text-center">${tree.common_name.toUpperCase()}</h3>
                            <div>
                                <div>Longitude: ${tree.longitude}</div>
                                <div>Latitude: ${tree.latitude}</div>
                                ${tree.date_encoded ? `<div>Date: ${tree.date_encoded}</div>` : ""}
                            </div>
                        </div>`;

            const treeMarker = createTreeMarkerElement();
            new mapboxgl.Marker({ element: treeMarker })
                .setLngLat([tree.longitude ?? null, tree.latitude ?? null])
                .setPopup(
                    new mapboxgl.Popup().setHTML(popupHtml))
                .addTo(map1);
        })
    });

</script>