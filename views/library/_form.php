<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\File;
use app\models\HazardMap;
use app\models\Library;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;

/* @var $this yii\web\View */
/* @var $model app\models\Library */
/* @var $form app\widgets\ActiveForm */
$this->addJsFile('js/library', [App::setting('system')->themeModel->description]); 
?>
<?php $form = ActiveForm::begin(['id' => 'library-form', 'options' => ['data-id' => $model->id]]); ?>
	
	<div class="row">
		<div class="col-md-8">
			<div class="row">
		        <div class="col-md-6">
		        	<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'family',
						'data' => Library::filter('family')
					]) ?>
		        </div>
		        <div class="col-md-6">
		        	<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'genus',
						'data' => Library::filter('genus')
					]) ?>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col-md-6">
		        	<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'species',
						'data' => Library::filter('species')
					]) ?>
		        </div>
		        <div class="col-md-6">
		        	<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'sub_species',
						'data' => Library::filter('sub_species')
					]) ?>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col-md-6">
					<?= $form->field($model, 'varieta_and_infra_var_name')->textInput(['maxlength' => true]) ?>
		        </div>
		        <div class="col-md-6">
					<?= $form->field($model, 'common_name')->textInput(['maxlength' => true]) ?>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col-md-6">
					<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'taxonomic_group',
						'data' => Library::filter('taxonomic_group')
					]) ?>

					<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'conservation_status',
						'data' => Library::filter('conservation_status')
					]) ?>

					<?= DataList::widget([
						'form' => $form,
						'model' => $model,
						'attribute' => 'residency_status',
						'data' => Library::filter('residency_status')
					]) ?>
		        </div>
		        <div class="col-md-6">
					<?= $form->field($model, 'distribution')->textarea(['rows' => 10]) ?>
		        </div>
		    </div>
		</div>

		<div class="col-md-4 text-center">
			<?= Html::image($model->photo, ['w' => 200], [
                'class' => 'img-thumbnail library-photo',
                'loading' => 'lazy',
            ] ) ?>
           	<div class="my-2"></div>

            <?= ImageGallery::widget([
            	'buttonTitle' => 'Choose Main Photo',
                'tag' => 'Library',
                'model' => $model,
                'attribute' => 'photo',
                'ajaxSuccess' => "
                    if(s.status == 'success') {
                        $('.library-photo').attr('src', s.src);
                    }
                ",
            ]) ?> 
            <div class="my-7">	</div>
            <?= $form->field($model, 'notes')->textarea(['rows' => 10]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<p class="lead font-weight-bold">Location</p>
			<div id="location-data" class="tree-demo"> </div>

			<textarea id="library-island_group" class="app-hidden" name="Library[island_group]"><?= json_encode($model->island_group) ?></textarea>
			<textarea id="library-region" class="app-hidden" name="Library[region]"><?= json_encode($model->region) ?></textarea>
      		<textarea id="library-province" class="app-hidden" name="Library[province]"><?= json_encode($model->province) ?></textarea>
      		<textarea id="library-municipality" class="app-hidden" name="Library[municipality]"><?= json_encode($model->municipality) ?></textarea>
      		<textarea id="library-brgy" class="app-hidden" name="Library[brgy]"><?= json_encode($model->brgy) ?></textarea>
      		<textarea id="library-location_data" class="app-hidden" name="Library[location_data]"><?= json_encode($model->location_data) ?></textarea>
		</div>
		<div class="col-md-4">
      		<div class="mt-5"></div>
    		<?= $form->field($model, 'specific_area')->textarea(['rows' => 10]) ?>
		</div>
	</div>

	<div class="row my-5 mb-10">
		<div class="col-md-12">
			<p class="lead font-weight-bold">Upload Images</p>
		    <?= Dropzone::widget([
		    	'maxFiles' => 9,
		        'tag' => 'Library',
		        'files' => $model->imageFiles,
		        'model' => $model,
		        'attribute' => 'gallery',
		        'acceptedFiles' => array_map(
		            function($val) { 
		                return ".{$val}"; 
		            }, File::EXTENSIONS['image']
		        )
		    ]) ?>
		</div>
	</div>
  
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>