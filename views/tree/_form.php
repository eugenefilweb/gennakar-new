<?php

use app\helpers\App;
use app\models\File;
use app\models\Tree;
use app\widgets\ActiveForm;
use app\widgets\DataList;
use app\widgets\DateTimePicker;
use app\widgets\Dropzone;
use app\widgets\OpenLayer;

/* @var $this yii\web\View */
/* @var $model app\models\Tree */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'tree-form']); ?>
    <div class="row">
        <div class="col-md-6">
        	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        		'title' => 'General Information',
        		'stretch' => true
        	]) ?>
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
				<?= DateTimePicker::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'date_encoded'
				]) ?>
	        	<div class="row">
	        		<div class="col-md-12">
						<?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>
	        		</div>
	        	</div>
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
					'clickCallback' => <<< JS
						$('#tree-latitude').val(lat);
						$('#tree-longitude').val(lon);
					JS
				]) ?>
			    <div class="row mt-5">
			    	<div class="col-md-6">
						<?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
			    	</div>
			    	<div class="col-md-6">
						<?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
			    	</div>
			    </div>
        	<?php $this->endContent() ?>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        		'title' => 'Upload Images',
        		'stretch' => true
        	]) ?>
	        	<div class="row">
                    <?= App::foreach(Tree::PHOTO_KEYS, function($label, $attribute) use($model) {
                    	$data = Dropzone::widget([
					    	'maxFiles' => 6,
					        'tag' => 'Tree',
					        'files' => $model->getImageFiles($attribute),
					        'model' => $model,
					        'attribute' => $attribute,
					        'acceptedFiles' => File::imageFileExtensions()
					    ]);
						return <<< HTML
							<div class="col-md-6">
								<p class="lead font-weight-bold">{$label}</p>
								{$data}
								<div class="mb-10"></div>
							</div>
						HTML;
                    }) ?>
	        	</div>
        	<?php $this->endContent() ?>
    	</div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>