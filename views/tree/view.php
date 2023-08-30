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

$this->registerJs(<<< JS
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
                <?= OpenLayer::widget([
                    'latitude' => $model->latitude,
                    'longitude' => $model->longitude,
                ]) ?>
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
                    </tbody>
                </table>
                
            <?php $this->endContent() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-validate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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