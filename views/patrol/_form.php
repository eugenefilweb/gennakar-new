<?php

use app\helpers\App;
use app\models\HazardMap;
use app\models\User;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DatePicker;
use app\widgets\OpenLayer;

/* @var $this yii\web\View */
/* @var $model app\models\Patrol */
/* @var $form app\widgets\ActiveForm */
$this->params['wrapCard'] = false;

$this->registerCss(<<< CSS
	#patrol-form .table-responsive {
		max-height: 65vh;
	}
CSS);
$this->registerJs(<<< JS
	$(document).on('click', '.btn-delete-coordinate', function() {
		$(this).closest('tr').remove();
	})
	$(document).on('click', '.btn-delete-all-coordinate', function() {
		$('#coordinates').html('');
	})
JS);
?>
<?php $form = ActiveForm::begin(['id' => 'patrol-form']); ?>
	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'General Information'
	]) ?>
	    <div class="row">
	        <div class="col-md-4">
	        	<?= BootstrapSelect::widget([
	        		'model' => $model,
	        		'form' => $form,
	        		'attribute' => 'user_id',
	        		'data' => User::dropdown('id', 'username')
	        	]) ?>
				<?php # $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
	        </div>
	        <div class="col-md-4">
	        	<?= BootstrapSelect::widget([
	        		'model' => $model,
	        		'form' => $form,
	        		'attribute' => 'watershed',
					'data' => HazardMap::dropdown('name', 'name', ['type' => HazardMap::WATERSHED])
	        	]) ?>
	        </div>
	        <div class="col-md-4">
	        	<?= DatePicker::widget([
	        		'model' => $model,
	        		'form' => $form,
	        		'attribute' => 'date',
				]) ?>
	        </div>
	    </div>
	<?php $this->endContent() ?>

	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'Map Trail'
	]) ?>
	    <div class="row">
	    	<div class="col-md-7">
	    		<?= OpenLayer::widget([
	    			'zoom' => 13,
	    			'addMarkers' => false,
	    			// 'clearMarkersOnClick' => false,
                    'coordinates' => $model->formattedCoordinates,
                    'withLine' => true,
                    'addStartMarker' => true,
                    'addEndMarker' => true,
					'clearMarkersOnClick' => false,
					'clickCallback' => <<< JS
						const timestamp = new Date().getTime();

						$('#coordinates').append('<tr>\
							<td>\
								<input class="form-control" type="hidden" name="Patrol[coordinates]['+ timestamp +'][timestamp]" value="'+ timestamp +'">\
								<input class="form-control" type="text" name="Patrol[coordinates]['+ timestamp +'][lat]" value="'+ lat +'">\
							</td>\
							<td>\
								<input class="form-control" type="text" name="Patrol[coordinates]['+ timestamp +'][lon]" value="'+ lon +'">\
							</td>\
							<td class="text-center">\
								<button type="button" class="btn-delete-coordinate btn btn-icon btn-sm btn-danger"><i class="fa fa-trash"></i></button>\
							</td>\
						</tr>');
					JS
				]) ?>
	    	</div>
	    	<div class="col-md-5">
	    		<div class="table-responsive">
				    <table class="table table-bordered"> 
				    	<thead>
				    		<tr>
				    			<th>latitude</th>
				    			<th>longitude</th>
				    			<th class="text-center">
									<button type="button" class="btn-delete-all-coordinate btn btn-icon btn-sm btn-danger"><i class="fa fa-trash"></i></button>
								</th>
				    		</tr>
				    	</thead>
				    	<tbody id="coordinates">
							<?= App::foreach($model->coordinates, fn ($coordinate, $key, $counter) => <<< HTML
								<tr>
									<td>
										<input class="form-control" type="hidden" name="Patrol[coordinates][{$key}][timestamp]" value="{$coordinate['timestamp']}">
										<input class="form-control" type="text" name="Patrol[coordinates][{$key}][lat]" value="{$coordinate['lat']}">
									</td>
									<td>
										<input class="form-control" type="text" name="Patrol[coordinates][{$key}][lon]" value="{$coordinate['lon']}">
									</td>
									<td class="text-center">
										<button type="button" class="btn-delete-coordinate btn btn-icon btn-sm btn-danger"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							HTML) ?>
				    	</tbody>
				    </table>
				</div>
	    	</div>
	    </div>
	<?php $this->endContent() ?>


    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>