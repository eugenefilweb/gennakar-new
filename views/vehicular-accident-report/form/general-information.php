<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\models\File;
use app\models\HazardMap;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
?>

<h4 class="mb-10 font-weight-bold text-dark">
    <?= $tabData['title'] ?>
</h4>

<?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'control_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= DatePicker::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'date',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'main_cause',
                'data' => ArrayHelper::combine(App::params('var')['main_cause'])
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'preferred_by')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'noted_by')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'collision_type',
                'data' => ArrayHelper::combine(App::params('var')['collision_type'])
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'weather_condition',
                'data' => ArrayHelper::combine(App::params('var')['weather_condition'])
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'road_condition',
                'data' => ArrayHelper::combine(App::params('var')['road_condition'])
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'barangay',
                'data' => HazardMap::dropdown('name', 'name', ['type' => HazardMap::BARANGAY])
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'landmarks')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'road_type',
                'data' => ArrayHelper::combine(App::params('var')['road_type'])
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="my-5"></div>

    <div class="row">
        <div class="col-md-8">
            <p class="lead font-weight-bold text-muted">PHOTOS OF ACCIDENTS</p>
            <?= Dropzone::widget([
                'files' => $model->filePhotos,
                'tag' => 'Vehicle Accident Report',
                'model' => $model,
                'attribute' => 'photos',
                'maxFiles' => 4,
                'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
            ]) ?>
            <div class="mt-10"></div>
            <p class="lead font-weight-bold text-muted">OTHER DAMAGES</p>
            <?= Dropzone::widget([
                'files' => $model->fileOtherDamages,
                'tag' => 'Vehicle Accident Report',
                'model' => $model,
                'attribute' => 'other_damages',
                'maxFiles' => 4,
                'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
            ]) ?>
        </div>
        <div class="col-md-4 text-center">
            <p class="lead font-weight-bold text-muted">SKETCH</p>
            <?= Html::image($model->sketch, ['w' => 400], [
                'class' => 'img-thumbnail sketch-photo',
                'loading' => 'lazy',
            ] ) ?>
            <div class="my-2"></div>
            <?= ImageGallery::widget([
                'tag' => 'Vehicle Accident Report',
                'model' => $model,
                'attribute' => 'sketch',
                'ajaxSuccess' => "
                    if(s.status == 'success') {
                        $('.sketch-photo').attr('src', s.src);
                    }
                ",
            ]) ?> 
        </div>
    </div>

    <div class="form-group mt-10">
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg font-weight-bold'
        ]) ?>
    </div>
<?php ActiveForm::end() ?>