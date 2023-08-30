<?php

use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'personal-data-sheet-form']); ?>
    <div class="row">
        <div class="col-md-5">
			<?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'name_extension')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'date_of_birth')->textInput() ?>
			<?= $form->field($model, 'place_of_birth')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'sex')->textInput() ?>
			<?= $form->field($model, 'civil_status')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'blood_type')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'gsis_id_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pagibig_id_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'philhealth_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'sss_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'tin_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'agency_employee_no')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'citizenship')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'citizenship_type')->textInput() ?>
			<?= $form->field($model, 'dual_citizenship_details')->textarea(['rows' => 6]) ?>
			
			<?= $form->field($model, 'ra_house_block_lot_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_street')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_subdivision_village')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_barangay')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_city_municipality')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_province')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ra_zip_code')->textInput(['maxlength' => true]) ?>
			
			<?= $form->field($model, 'pa_house_block_lot_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_street')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_subdivision_village')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_barangay')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_city_municipality')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_province')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pa_zip_code')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'telephone_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>


			<?= $form->field($model, 'spouse_surname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_first_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_middle_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_name_extension')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_occupation')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_employer')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'spouse_employer_address')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'spouse_employer_telephone_no')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'childrens')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'father_surname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'father_first_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'father_middle_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'father_name_extension')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'mother_surname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'mother_first_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'mother_middle_name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'mother_name_extension')->textInput(['maxlength' => true]) ?>


			<?= $form->field($model, 'signature')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'date')->textInput() ?>
			<?= $form->field($model, 'skills')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'recognitions')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'organizations')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'consanguinity_related')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'administrative_offense')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'charged_criminally')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'crime_convicted')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'service_separated')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'election_candidate')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'government_resigned')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'other_country_resident')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'indigenous_group')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'pwd')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'solo_parent')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'references')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'government_issued_id')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'government_id_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'government_id_place_of_issuance')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'right_thumbmark')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'person_administering_oath')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'father_id')->textInput() ?>
			<?= $form->field($model, 'mother_id')->textInput() ?>
			<?= $form->field($model, 'spouse_id')->textInput() ?>
			<?= ActiveForm::recordStatus([
                'model' => $model,
                'form' => $form,
            ]) ?>
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>