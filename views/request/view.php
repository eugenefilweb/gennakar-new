<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\search\RequestSearch;
use app\widgets\ActiveForm;
use app\widgets\Anchors;
use app\widgets\Detail;
use app\widgets\InputList;
/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Request: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new RequestSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false; 

$this->addJsFile('js/request');
$this->registerCss(<<< CSS
	#request-ambulance_dispatched {
	    display: flex;
    	gap: 1rem;
	}
CSS)
?>
<div class="request-view-page">
	<?= $model->statusToolbar ?>
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 

    <div class="my-2"></div>

    <div class="row">
    	<div class="col-md-8">
    		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		        'title' => 'General Details',
		        'toolbar' => "<div class='card-toolbar'> {$model->dispatchedAmbulanceButton} </div>"
		    ]) ?>

			    <p class="lead text-uppercase font-weight-bold">Patient Information</p>
			    <?= Detail::widget([
			    	'model' => $model,
			    ]) ?>

			    <div class="my-10"></div>
			    <p class="lead text-uppercase font-weight-bold">Other Details</p>
			    <?= Detail::widget([
			    	'model' => $model,
			    	'attributes' => [
			    		'driver:raw',
			    		'responders:ul',
			    		'patient_companions:ul',
			    	]
			    ]) ?>
		    <?php $this->endContent() ?>
    	</div>
    	<div class="col-md-4">
    		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		        'title' => 'History Logs'
		    ]) ?>
		    	<div class="timeline timeline-3">
		    		<div class="timeline-items app-overflow" style="max-height: 58vh; overflow: auto;">
				    	<?= Html::foreach($model->requestLogs, function($requestLog) {
							return <<< HTML
								<div class="timeline-item">
									<div class="timeline-media">
										<img alt="Pic" src="{$requestLog->userImageUrl}">
									</div>
									<div class="timeline-content">
										<div class="d-flex align-items-center justify-content-between mb-3">
											<div class="mr-2">
												<a href="#" class="text-dark-75 text-hover-primary font-weight-bold">
													{$requestLog->title}
												</a>
												<span class="text-muted ml-2">
													{$requestLog->timeSent}
												</span>
												<span style="position: absolute; right: 7px;">{$requestLog->statusBadge}</span>
											</div>
										</div>
										<p class="p-0">
											{$requestLog->description}
										</p>
									</div>
								</div>
							HTML;
				    	}) ?>
		    		</div>
		    	</div>
		    <?php $this->endContent() ?>
    	</div>
    </div>
</div>



<div class="modal fade" id="modal-change-status" tabindex="-1" role="dialog" aria-labelledby="modal-change-statusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-change-statusLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                	'id' => 'request-form',
                	'action' => ['request/update', 'id' => $model->id]
                ]); ?>
	                <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>
	                <div class="form-group field-request-responders">
	                    <label class="control-label"> Responders </label>
	                    <?= InputList::widget([
	                        'label' => 'Responder',
	                        'name' => 'Request[responders][]',
	                        'data' => $model->responders
	                    ]) ?>
	                </div>
	                <div class="form-group field-request-patient-companions">
	                    <label class="control-label"> Patient Companions </label>
	                    <?= InputList::widget([
	                        'label' => 'Responder',
	                        'name' => 'Request[patient_companions][]',
	                        'data' => $model->patient_companions
	                    ]) ?>
	                </div>
                	<?= $form->field($model, 'ambulance_dispatched')->radioList(App::keyMapParams('ambulance_dispatched_status'))->label('Ambulance Status') ?>
	                <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

	                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>

				    <div class="form-group">
                		<button type="submit" class="btn btn-success font-weight-bold">Save changes</button>
				        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
				    </div>
				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>