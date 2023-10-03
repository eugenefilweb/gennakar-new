<?php

use app\widgets\Mapbox;
use app\widgets\Mapboxgl;
use \yii\data\Pagination;
use app\helpers\App;
use app\helpers\Html;
use app\models\Patrol;
use app\models\Role;
use app\models\User;
use app\widgets\ActiveForm;
use app\widgets\LinkPager;
use app\widgets\OpenLayer;
use app\widgets\SearchButton;

use yii\web\View;

$this->title = 'Patrols: Map';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel;
$this->params['activeMenuLink'] = '/patrol/map';
$this->params['wrapCard'] = false;

?>

<style>
  .popup .title {
    font-weight: bold;
    margin-right: .5rem;
  }
</style>

<div class="patrol-index-page">
  <div class="row">
    <div class="col-md-8">
      <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Map View',
        'toolbar' => '<div class="card-toolbar">
                    <span class="lead font-weight-bold">Patrols Found: ' . number_format($dataProvider->totalCount) . '</span>
                </div>',
        'stretch' => true
      ]) ?>

      <?= Mapboxgl::widget([
        'center' => [121.45,14.45],
        'coordinates' => $coordinates,
        'height' => '100%',
        'multipleDirections' => true
      ])?>

      <?php $this->endContent() ?>

    </div>
    <div class="col-md-4">
      <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Advanced Filter',
      ]) ?>
      <?php $form = ActiveForm::begin(['id' => 'patrol-form', 'method' => 'get', 'action' => ['patrol/map']]); ?>
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
            'attribute' => 'user_id',
            'data' => Patrol::userFilter()
          ]) ?>

          <?= $this->render('_map-advanced-filter', [
            'form' => $form,
            'searchModel' => $searchModel,
            'attribute' => 'status',
            'data' => [
              Patrol::VALIDATED => 'Validated',
              Patrol::FOR_VALIDATION => 'For Validation',
            ]
          ]) ?>

          <div class="checkbox-inline">
            <label class="checkbox">
              <input type="checkbox" <?= $searchModel->show_user_photo ? 'checked' : '' ?> name="show_user_photo"
                value="1">
              <span></span>Show Patroller Photo
            </label>
          </div>

          <label for="map_zoom_level" class="mt-3">Map Zoom Level</label>
          <div>
            <input type="range" id="map_zoom_level" name="map_zoom_level" min="1" max="20"
              value="<?= $searchModel->map_zoom_level ?>" step="1" style="width: -webkit-fill-available;">
          </div>

          <?php /*
          <div class="text-center">
            <?= LinkPager::widget([
              'options' => [
                'class' => 'mt-5 justify-content-center app-linkpager d-flex flex-wrap justify-content-center py-2'
              ],
              'pagination' => new Pagination(['totalCount' => $dataProvider->totalCount])
            ]) ?>
          </div>
          */ ?>

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
