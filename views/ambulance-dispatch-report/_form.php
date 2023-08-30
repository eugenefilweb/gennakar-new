<?php

use app\widgets\ActiveForm;
use app\helpers\Html;
use app\models\AmbulanceDispatchReport;
use app\models\File;
use app\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AmbulanceDispatchReport */
/* @var $form app\widgets\ActiveForm */
$this->params['wrapCard'] = false;

$this->addJsFile('sortable/Sortable.min');
$this->registerJs(<<< JS
    const name = $('#ert-container input[name="name"]');
    const role = $('#ert-container input[name="role"]');
    const addBtn = $('#ert-container .btn-add');
    const listContainer = $('#ert-container .list-container');

   
    const generateHtml = () => {
        const nameValue = name.val().trim();
        const roleValue = role.val().trim();
        const index = (new Date()).getTime();

        if(nameValue && roleValue) {
            const html = '\
                <div class="input-group mb-2">\
                    <div class="input-group-prepend">\
                        <button class="btn btn-secondary handle-sortable" type="button">\
                            <i class="fas fa-arrows-alt"></i>\
                        </button>\
                    </div>\
                    <input value="'+ nameValue +'" type="text" name="AmbulanceDispatchReport[ert_names]['+index+'][name]" class="form-control" placeholder="Enter Name">\
                    <input value="'+ roleValue +'" type="text" name="AmbulanceDispatchReport[ert_names]['+index+'][role]" class="form-control" placeholder="Enter Role" list="roles">\
                    <div class="input-group-append">\
                        <button class="btn btn-danger btn-icon btn-remove" type="button">\
                            <i class="fa fa-trash"></i>\
                        </button>\
                    </div>\
                </div>\
            ';

            listContainer.append(html);
            name.val('').focus();
            role.val('');
        }
    };

    const enterEvent = (e) => {
        if(e.key == 'Enter') {
            e.preventDefault();
            generateHtml();
        }
    }

    name.on('keydown', enterEvent);
    role.on('keydown', enterEvent);

    addBtn.on('click', () => {
        generateHtml();
    });

    $(document).on('click', '#ert-container .btn-remove', function() {
        $(this).closest('.input-group').remove();
    });

    new Sortable(document.getElementById('ert-container-list'), {
        handle: '.handle-sortable', // handle's class
        animation: 150,
        ghostClass: 'bg-light-primary'
    });
JS);
?>
<?php $form = ActiveForm::begin(['id' => 'ambulance-dispatch-report-form']); ?>
	
    <div class="row">
        <div class="col-md-6">
        	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Requesting Party Information',
			]) ?>
		    	<?= $form->datetimePicker($model, 'date_time') ?>
				<?= $form->field($model, 'requester_name')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'requester_contact')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'requester_relation')->textInput(['maxlength' => true]) ?>
			<?php $this->endContent() ?>
		</div>
        <div class="col-md-6">
        	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Patient Information',
			]) ?>
		    	<?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'patient_contact')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'patient_age')->textInput([
					'type' => 'number'
				]) ?>
				<?= $form->bootstrapSelect($model, 'patient_gender', [
					AmbulanceDispatchReport::MALE => 'Male',
					AmbulanceDispatchReport::FEMALE => 'Female',
				]) ?>
			<?php $this->endContent() ?>
		</div>
	</div>


    <div class="row">
        <div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Incident Information',
				'stretch' => true
			]) ?>
	        	<?= $form->field($model, 'incident_location')->textInput(['maxlength' => true]) ?>
				<?= $form->dataList($model, 'incident_nature', ArrayHelper::combine([
					'Medical Emergency',
					'Trauma',
					'Motor vehicle accident',
					'Fire-related Injury: Burns, smoke inhalation, etc.',
					'Drowning',
					'Drug Overdose',
					'Maternity/Pregnancy-related',
					'Psychiatric/Behavioral Emergency',
					'Animal Bite',
					'Hazardous Material Exposure',
				])) ?>
				<?= $form->bootstrapSelect($model, 'incident_level', ArrayHelper::combine([
					'Minor',
					'Moderate',
					'Critical',
				])) ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Dispatch Information'
			]) ?>
        		<?= $form->field($model, 'unit_id')->textInput(['maxlength' => true]) ?>
        		<div class="row">
        			<div class="col-md-6">
						<?= $form->datetimePicker($model, 'dispatched_time') ?>
        			</div>
        			<div class="col-md-6">
						<?= $form->datetimePicker($model, 'arrival_time') ?>
        			</div>
        		</div>
        		<div class="row">
        			<div class="col-md-6">
						<?= $form->datetimePicker($model, 'departure_time') ?>
        			</div>
        			<div class="col-md-6">
						<?= $form->datetimePicker($model, 'arrival_time_facility') ?>
        			</div>
        		</div>
				<?= $form->field($model, 'patient_condition')->textarea(['rows' => 4]) ?>
			<?php $this->endContent() ?>
    	</div>
	</div>

		

	<div class="row">
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Condition Upon Arrival',
			]) ?>
				<?= $form->field($model, 'heart_rate')->textInput(['maxlength' => true]) ?>
				<div class="row">
					<div class="col-md-6">
						<?= $form->field($model, 'blood_pressure')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="col-md-6">
						<?= $form->field($model, 'spo2')->textInput(['maxlength' => true]) ?>
					</div>
				</div>
				<?= $form->field($model, 'description_of_symptoms')->textarea(['rows' => 4]) ?>
				<?= $form->field($model, 'treatment_administered')->textarea(['rows' => 4]) ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Hospital/Facility Information',
				'stretch' => true
			]) ?>
				<?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'facility_contact')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'facility_receiver')->textInput(['maxlength' => true]) ?>
			<?php $this->endContent() ?>
		</div>
	</div>


	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'ERT Information'
	]) ?>
		<datalist id="roles">
			<option value="Driver">
			<option value="First Responder">
			<option value="Basic Life Support Trained ERT">
			<option value="Emergency Medical Technician (EMT) ">
			<option value="Paramedic">
			<option value="Advanced Life Support Trained ERT">
			<option value="Advanced Emergency Medical Technician (AEMT)">
			<option value="Incident Commander">
		</datalist>

        <div class="row">
            <div class="col-md-12">
                <div id="ert-container">
                    <div class="list-container mt-2"  id="ert-container-list">
                        <?= Html::foreach($model->ert_names, function($ert, $index) {
                            $name = $ert['name'] ?? '';
                            $role = $ert['role'] ?? '';

                            return <<< HTML
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary handle-sortable" type="button">
                                            <i class="fas fa-arrows-alt"></i>
                                        </button>
                                    </div>
                                    <input placeholder="Enter Name" type="text" class="form-control" name="AmbulanceDispatchReport[ert_names][{$index}][name]" value="{$name}">
                                    <input placeholder="Enter Role" type="text" class="form-control" name="AmbulanceDispatchReport[ert_names][{$index}][role]" value="{$role}" list="roles">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger btn-icon btn-remove" type="button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            HTML;
                        }) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" type="button">
                                <i class="far fa-edit"></i>
                            </button>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        <input list="roles" type="text" name="role" class="form-control" placeholder="Enter Role">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-add btn-icon" type="button">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php $this->endContent() ?>

	
	<div class="row">
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Vehicle Information',
				'stretch' => true
			]) ?>
		    	<?= $form->field($model, 'vehicle_id')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'vehicle_type')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'vehicle_mileage')->textInput(['maxlength' => true]) ?>
			<?php $this->endContent() ?>
		</div>

		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Other Information'
			]) ?>
				<?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>
				<?= $form->field($model, 'prepared_by')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'noted_by')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'mdrrmo')->textInput(['maxlength' => true]) ?>
			<?php $this->endContent() ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Photos'
			]) ?>
				<?= $form->dropzone($model, 'photos', 'Ambulance Dispatch Report', [
					'files' => $model->filePhotos,
					'acceptedFiles' => File::imageFileExtensions()
				]) ?>
			<?php $this->endContent() ?>
		</div>
		<div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'Attachments'
			]) ?>
			<?= $form->dropzone($model, 'attachments', 'Ambulance Dispatch Report', [
					'files' => $model->fileAttachments,
					'acceptedFiles' => File::documentFileExtensions()
				]) ?>
			<?php $this->endContent() ?>
		</div>
	</div>

    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>