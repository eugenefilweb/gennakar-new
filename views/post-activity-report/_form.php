<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Barangay;
use app\models\File;
use app\models\HazardMap;
use app\models\PostActivityReport;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DateTimePicker;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
use app\widgets\InputList;
use app\widgets\OpenLayer;

$this->params['activeMenuLink'] = $model->activeMenuLink;

/* @var $this yii\web\View */
/* @var $model app\models\PostActivityReport */
/* @var $form app\widgets\ActiveForm */

$this->registerCss(<<< CSS
	#post-activity-report-form table .form-group {margin-bottom: 0;}
CSS);

$this->addJsFile('sortable/Sortable.min');

$watersheds = HazardMap::watershedJsonData();
$barangays = HazardMap::barangayJsonData();

$this->registerJs(<<< JS
	const watersheds = {$watersheds},
		barangays = {$barangays},
		WATERSHED = 3,
		BARANGAY = 1;

	$('#postactivityreport-watershed_id').on('change', function(e) {
		const watershedId = $(this).val();
		if (watershedId) {
			KTApp.block('.map-photo-container', {
				overlayColor: '#000000',
				message: 'Loading image',
				state: 'primary'
			});

			const selectedWatershed = watersheds.find(watershed => watershed.id == watershedId && watershed.type == WATERSHED);
			if (selectedWatershed) {
				$('.map-photo').attr('src', selectedWatershed.imageUrl);
				$('#postactivityreport-map').val(selectedWatershed.photo);
			}
			setTimeout(() => {
				KTApp.unblock('.map-photo-container');
			}, 1500);
		}
	});

	$('#postactivityreport-barangay_id').on('change', function(e) {
		const barangayId = $(this).val();
		if (barangayId) {
			KTApp.block('.map-photo-container', {
				overlayColor: '#000000',
				message: 'Loading image',
				state: 'primary'
			});

			const selectedBarangay = barangays.find(barangay => barangay.id == barangayId && barangay.type == BARANGAY);
			if (selectedBarangay) {
				$('.map-photo').attr('src', selectedBarangay.imageUrl);
				$('#postactivityreport-map').val(selectedBarangay.photo);
			}
			setTimeout(() => {
				KTApp.unblock('.map-photo-container');
			}, 1500);
		}
	});

	const coordinator = $('#coordinator-container input[name="coordinator"]'),
		office = $('#coordinator-container input[name="office"]'),
		addBtn = $('#coordinator-container .btn-add'),
		listContainer = $('#coordinator-container .list-container');

	const getTimestampInSeconds =  () => {
		return Math.floor(Date.now() / 1000)
	}
	const generateHtml = () => {
		let coordinatorValue = coordinator.val().trim(),
			officeValue = office.val().trim(),
			index = getTimestampInSeconds();

		if(coordinatorValue && officeValue) {
			let html = '\
				<div class="input-group mb-2">\
					<div class="input-group-prepend">\
						<button class="btn btn-secondary handle-sortable" type="button">\
							<i class="fas fa-arrows-alt"></i>\
						</button>\
					</div>\
					<input value="'+ coordinatorValue +'" type="text" name="PostActivityReport[coordinators]['+index+'][name]" class="form-control" placeholder="Enter Coordinator">\
					<input value="'+ officeValue +'" type="text" name="PostActivityReport[coordinators]['+index+'][office]" class="form-control" placeholder="Enter Office">\
					<div class="input-group-append">\
						<button class="btn btn-danger btn-icon btn-remove" type="button">\
							<i class="fa fa-trash"></i>\
						</button>\
					</div>\
				</div>\
			';

			listContainer.append(html);
			coordinator.val('').focus();
			office.val('');
		}
	};

	const enterEvent = (e) => {
		if(e.key == 'Enter') {
            e.preventDefault();
        	generateHtml();
        }
	}

	coordinator.on('keydown', enterEvent);
	office.on('keydown', enterEvent);

	addBtn.on('click', () => {
		generateHtml();
	});

	$(document).on('click', '#coordinator-container .btn-remove', function() {
		$(this).closest('.input-group').remove();
	});

	new Sortable(document.getElementById('coordinator-container-list'), {
        handle: '.handle-sortable', // handle's class
        animation: 150,
        ghostClass: 'bg-light-primary'
    });


    const isOneDay = () => {
        if($('#cb-oneday').is(':checked')) {
            $('input[name="PostActivityReport[date_end]"]').val($('input[name="PostActivityReport[date_started]"]').val());
            $('input[name="PostActivityReport[date_end]"]').attr('readonly', true);
        }
        else {
            $('input[name="PostActivityReport[date_end]"]').attr('readonly', false);
        }
    }
    isOneDay();

    $('#cb-oneday').on('change', function() {
        isOneDay()
    });

    $('#postactivityreport-date_started').on('change.datetimepicker', function (e) {
        isOneDay();
        if($('#cb-oneday').is(':checked') == false) {
            $('#date_end').datetimepicker('minDate', e.date);
        }
    });
    $('#postactivityreport-date_end').on('change.datetimepicker', function (e) {
        isOneDay();

        if($('#cb-oneday').is(':checked') == false) {
            $('#date_started').datetimepicker('maxDate', e.date);
        }
    });
JS);
?>

<?php $form = ActiveForm::begin(['id' => 'post-activity-report-form']); ?>
<div class="row">
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'MAIN INFORMATION',
			'stretch' => true
		]) ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'control_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= DataList::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'type_of_activity',
					'data' => $model->typeOfActivityList
				]) ?>
            </div>
        </div>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="row">
        	<div class="col-md-12">
        		<div class="checkbox-list mb-2">
					<label class="checkbox">
						<input type="checkbox" name="Checkboxes1" id="cb-oneday">
						<span></span>
						One day (1) Only
					</label>
				</div>
        	</div>
        </div>
        <div class="row datapicker-row">
            <div class="col-md-6">
                <?= DateTimePicker::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'date_started',
				]) ?>
            </div>
            <div class="col-md-6">
                <?= DateTimePicker::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'date_end',
				]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Location of the Activity') ?>
            </div>
            <div class="col-md-6">
                <?= App::ifElse($model->isSiad, BootstrapSelect::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'watershed_id',
					'data' => HazardMap::dropdown('id', 'name', ['type' => HazardMap::WATERSHED])
				]), BootstrapSelect::widget([
					'form' => $form,
					'model' => $model,
					'attribute' => 'barangay_id',
					'data' => HazardMap::dropdown('id', 'name', ['type' => HazardMap::BARANGAY])
				])) ?>
            </div>
        </div>

        <?php $this->endContent() ?>
    </div>
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'BENEFICIARY',
			'stretch' => true
		]) ?>
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td class="pl-0">Stakeholders</td>
						<td width="30%">
							<?= $form->field($model, 'beneficiary_stakeholder_male')->textInput([
								'placeholder' => 'Total Male'
							])->label(false) ?>
						</td>
						<td width="30%" class="pr-0">
							<?= $form->field($model, 'beneficiary_stakeholder_female')->textInput([
								'placeholder' => 'Total Female'
							])->label(false) ?>
						</td>
					</tr>

					<tr>
						<td class="pl-0">Local Government</td>
						<td>
							<?= $form->field($model, 'beneficiary_local_male')->textInput([
								'placeholder' => 'Total Male'
							])->label(false) ?>
						</td>
						<td class="pr-0">
							<?= $form->field($model, 'beneficiary_local_female')->textInput([
								'placeholder' => 'Total Female'
							])->label(false) ?>
						</td>
					</tr>
					<tr>
						<td class="pl-0">National Government</td>
						<td>
							<?= $form->field($model, 'beneficiary_national_male')->textInput([
								'placeholder' => 'Total Male'
							])->label(false) ?>
						</td>
						<td class="pr-0">
							<?= $form->field($model, 'beneficiary_national_female')->textInput([
								'placeholder' => 'Total Female'
							])->label(false) ?>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="pb-0 pl-0 pr-0">
							<p class="mt-10 font-weight-bold mb-0">Others: (Specify)</p>
						</td>
					</tr>
					<tr>
						<td class="pl-0">
							<?= $form->field($model, 'beneficiary_other_name')->textInput([
								'placeholder' => 'Description of Benificiary'
							])->label(false) ?>
						</td>
						<td>
							<?= $form->field($model, 'beneficiary_other_male')->textInput([
								'placeholder' => 'Total Male'
							])->label(false) ?>
						</td>
						<td class="pr-0">
							<?= $form->field($model, 'beneficiary_other_female')->textInput([
								'placeholder' => 'Total Female'
							])->label(false) ?>
						</td>
					</tr>
				</tbody>
			</table>
        <?php $this->endContent() ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'ACTIVITY ORGANIZERS',
			'stretch' => true
		]) ?>
			<label class="mb-0">In-charge of Activity</label>
	        <label class="text-muted form-text mt-0">
	        	Point-person or Lead organizer of the Activity
	        </label>
	        <?= $form->field($model, 'responsible_head')->textInput(['maxlength' => true])->label(false) ?>

	        <label class="mb-0">Coordinator/Facilitator(s)</label>
	        <label class="text-muted form-text mt-0">
	        	Person(s) who were involved in facilitating or coordinating the activity i.e. trainers, guest speakers, facilitators, resource persons, etc
	        </label>

	        <div id="coordinator-container">
				<div class="input-group">
					<input type="text" name="coordinator" class="form-control" placeholder="Enter Coordinator">
					<input type="text" name="office" class="form-control" placeholder="Enter Office">
					<div class="input-group-append">
						<button class="btn btn-success btn-add btn-icon" type="button">
							<i class="fa fa-plus-circle"></i>
						</button>
					</div>
				</div>
				<div class="list-container mt-2"  id="coordinator-container-list">
					<?= Html::foreach($model->coordinators, function($coordinator, $index) {
						$name = $coordinator['name'] ?? '';
						$office = $coordinator['office'] ?? '';
						return <<< HTML
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<button class="btn btn-secondary handle-sortable" type="button">
										<i class="fas fa-arrows-alt"></i>
									</button>
								</div>
								<input placeholder="Enter Coordinator" type="text" class="form-control" name="PostActivityReport[coordinators][{$index}][name]" value="{$name}">
								<input placeholder="Enter Office" type="text" class="form-control" name="PostActivityReport[coordinators][{$index}][office]" value="{$office}">
								<div class="input-group-append">
									<button class="btn btn-danger btn-icon btn-remove" type="button">
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</div>
						HTML;
					}) ?>
				</div>
			</div>


	        <div class="my-10"></div>
	        <label class="mb-0">Staff member(s)</label>
	        <label class="text-muted form-text mt-0">
	        	Personnel from the office that contributed to organizing the activity
	        </label>
	        <?= InputList::widget([
				'label' => 'Staff Members',
				'name' => 'PostActivityReport[staff_members][]',
				'data' => $model->staff_members,
			]) ?>

	        <div class="my-10"></div>
	        <label>Other(s)</label>
	        <?= InputList::widget([
				'label' => 'Other Members',
				'name' => 'PostActivityReport[other_members][]',
				'data' => $model->other_members,
			]) ?>
        <?php $this->endContent() ?>
    </div>
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'ACTIVITY',
			'stretch' => true
		]) ?>
        <?= $form->field($model, 'activity_brief')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'prepared_by')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'verified_by')->textInput(['maxlength' => true]) ?>
        <?php $this->endContent() ?>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'COMMENTS / REMARKS',
			'stretch' => true
		]) ?>
	        <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
	        <?= $form->field($model, 'comments_by')->textInput(['maxlength' => true]) ?>
	        <?= $form->field($model, 'in_charge_of_activity')->textInput(['maxlength' => true]) ?>
	        <?= $form->field($model, 'noted_by')->textInput([
	        	'maxlength' => true,
	        	'placeholder' => 'Municipal Mayor'
	        ]) ?>
	        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	        <?= $form->field($model, 'social_media_link')->textInput(['maxlength' => true]) ?>
        <?php $this->endContent() ?>
    </div>
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
	    	'title' => 'MAP PICTURE',
			'stretch' => true
		]) ?>
	        <div class="text-center map-photo-container">
	            <?= Html::image($model->map, ['w' => 500], [
					'class' => 'img-thumbnail map-photo',
					'loading' => 'lazy',
				] ) ?>

	            <div class="mt-5">
	                <?= ImageGallery::widget([
						'tag' => 'Post Activity Report',
						'widthSource' => 500,
						'model' => $model,
						'attribute' => 'map',
						'ajaxSuccess' => <<< JS
							if(s.status == 'success') {
								$('.map-photo').attr('src', s.src);
							}
						JS,
					]) ?>
	            </div>
	        </div>
        <?php $this->endContent() ?>
    </div>
</div>
<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
	'title' => 'PHOTOS',
]) ?>
	<div class="row">
		<div class="col-md-6">
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'files' => $model->photo1File ? [$model->photo1File]: [],
		        'maxFiles' => 1,
		        'model' => $model,
		        'attribute' => 'photo1',
		        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
		    ]) ?>
		</div>
		<div class="col-md-6">
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'files' => $model->photo2File ? [$model->photo2File]: [],
		        'maxFiles' => 1,
		        'model' => $model,
		        'attribute' => 'photo2',
		        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
		    ]) ?>
		</div>
	</div>
	<div class="my-5"></div>
	<div class="row">
		<div class="col-md-6">
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'files' => $model->photo3File ? [$model->photo3File]: [],
		        'maxFiles' => 1,
		        'model' => $model,
		        'attribute' => 'photo3',
		        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
		    ]) ?>
		</div>
		<div class="col-md-6">
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'files' => $model->photo4File ? [$model->photo4File]: [],
		        'maxFiles' => 1,
		        'model' => $model,
		        'attribute' => 'photo4',
		        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
		    ]) ?>
		</div>
	</div>
<?php $this->endContent() ?>

<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
	'title' => 'Map Vicinity Coordinates',
]) ?>
	<?= OpenLayer::widget([
		'zoom' => 16,
        'latitude' => $model->latitude,
        'longitude' => $model->longitude,
        'clickCallback' => <<< JS
            $('#postactivityreport-latitude').val(lat);
            $('#postactivityreport-longitude').val(lon);
        JS
    ]) ?>
    <div class="row mt-10">
        <div class="col-md-6">
            <?= $form->field($model, 'latitude')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'longitude')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>

    <div class="row mt-10">
		<div class="col-md-6">
			<label>Additional Photos</label>
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'title' => 'Upload Additional Photos',
		        'files' => $model->additionalPhotos,
		        'model' => $model,
		        'attribute' => 'additional_photos',
		        'acceptedFiles' => File::imageFileExtensions()
		    ]) ?>
		</div>
		<div class="col-md-6">
			<label>Additional File Documents</label>
			<?= Dropzone::widget([
		        'tag' => 'Post Activity Report',
		        'title' => 'Upload Additional File Documents',
		        'files' => $model->additionalFiles,
		        'model' => $model,
		        'attribute' => 'additional_files',
		        'acceptedFiles' => File::documentFileExtensions()
		    ]) ?>
		</div>
	</div>
<?php $this->endContent() ?>

<div class="form-group">
    <?= ActiveForm::buttons() ?>
</div>
<?php ActiveForm::end(); ?>