<?php

use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\PersonalDataSheet;
use app\widgets\ActiveForm;
use app\widgets\Checkbox;
use app\widgets\ESignature;
use app\widgets\ImageGallery;

$this->registerJs(<<< JS
    const elements = [
        'house_block_lot_no',
        'street',
        'subdivision_village',
        'barangay',
        'city_municipality',
        'province',
        'zip_code',
    ];

    elements.forEach(function(e) {
        const ra = $(['#personaldatasheet-ra', e].join('_'));
        const pa = $(['#personaldatasheet-pa', e].join('_'));

        ra.on('input', function() {
            const isChecked = $('#same_as_residential_address').is(':checked');
            if (isChecked) {
                pa.val($(this).val());
            }
        });
    });

    $('#same_as_residential_address').change(function() {
        const isChecked = $(this).is(':checked');

        elements.forEach(function(e) {
            const ra = $(['#personaldatasheet-ra', e].join('_'));
            const pa = $(['#personaldatasheet-pa', e].join('_'));
            
            if (isChecked) {
                pa.val(ra.val());
                pa.prop('readonly', true);
            }
            else {
                pa.prop('readonly', false);
            }
        });
    });
JS);
?>

<h4 class="mb-10 font-weight-bold text-dark">
    <?= $current_step['title'] ?>
</h4>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    
    <section>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->dataList($model, 'name_extension', PersonalDataSheet::filter('name_extension')) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->bootstrapSelect($model, 'sex', [
                    PersonalDataSheet::MALE => 'Male',
                    PersonalDataSheet::FEMALE => 'Female',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->dataList($model, 'civil_status', ArrayHelper::combine([
                    'Single',
                    'Engage',
                    'Married',
                    'Divorced',
                    'Separated',
                    'Widow',
                ])) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->datePicker($model, 'date_of_birth') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'place_of_birth')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="government-id">
                <?= $form->field($model, 'blood_type')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold">Government ID's</h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'gsis_id_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'pagibig_id_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'philhealth_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sss_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'tin_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'agency_employee_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'government_issued_id')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'government_id_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="citizenship">
                <?= $form->field($model, 'government_id_place_of_issuance')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold">Citizenship</h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->radioList($model, 'citizenship', [
                    PersonalDataSheet::FILIPINO  => 'Filipino',
                    PersonalDataSheet::DUAL_CITIZENSHIP  => 'Dual Citizenship',
                ], [
                    'unselect' => null,
                    'separator' => Html::tag('span', '', ['class' => 'mx-3'])
                ]) ?>


            </div>
            <div class="col-md-6">
                <?= $form->radioList($model, 'citizenship_type', [
                    PersonalDataSheet::BIRTH  => 'By birth',
                    PersonalDataSheet::NATURALIZATION  => 'By naturalization',
                ], [
                    'unselect' => null,
                    'separator' => Html::tag('span', '', ['class' => 'mx-3'])
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="residential-address">
                <?= $form->dataList($model, 'dual_citizenship_country', PersonalDataSheet::filter('dual_citizenship_country')) ?>

                <?= $form->field($model, 'dual_citizenship_details')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold"> Residential Address </h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ra_house_block_lot_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'ra_street')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ra_subdivision_village')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'ra_barangay')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ra_city_municipality')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'ra_province')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="permanent-address">
                <?= $form->field($model, 'ra_zip_code')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <div class="d-flex justify-content-between">
            <div>
                <h6 class="font-weight-bold"> Permanent Address </h6>
            </div>
            <div>
                <?= Checkbox::widget([
                    'data' => ['Same as Residential Address'],
                    'options' => ['id' => 'same_as_residential_address']
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'pa_house_block_lot_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'pa_street')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'pa_subdivision_village')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'pa_barangay')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'pa_city_municipality')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'pa_province')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="contact-details">
                <?= $form->field($model, 'pa_zip_code')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold"> Contact Details </h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'telephone_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="photo">
                <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold"> Photo</h6>
        <div class="row">
            <div class="col-md-6" id="right-thumbmark">
                <?= Html::image($model->photo, ['w'=>200], [
                    'class' => 'img-thumbnail',
                    'loading' => 'lazy',
                    'data-id' => 'photo'
                ] ) ?>
                <div class="my-2"></div>
                <?= $form->imageGallery($model, 'photo', 'Personal Data Sheet', [
                    'buttonTitle' => 'Select Photo',
                    'finalCropWidth' => 126 * 2,
                    'finalCropHeight' => 164 * 2,
                ]) ?> 
            </div>
        </div>
    </section>
    <section class="mt-10">
        <h6 class="font-weight-bold"> Right Thumbmark </h6>
         <?= Html::image($model->right_thumbmark, ['w'=>200], [
            'class' => 'img-thumbnail',
            'loading' => 'lazy',
            'data-id' => 'right_thumbmark'
        ] ) ?>
        <div class="my-2" id="e-signature"></div>
        <?= $form->imageGallery($model, 'right_thumbmark', 'Personal Data Sheet', [
            'buttonTitle' => 'Select Thumbmark',
        ]) ?>
    </section>
    <section class="mt-10">
        <h6 class="font-weight-bold"> E-Signature </h6>
        <div class="row">
            <div class="col-md-6 text-center">
                <?= ESignature::widget([
                    'width' => 400,
                    'height' => 240,
                    'uploadSuccess' => <<< JS
                        $('.signature').attr('src', toDataURL);
                    JS,
                    'model' => $model,
                    'form' => $form,
                    'attribute' => 'signature',
                ]) ?>
            </div>
            <div class="col-md-6 text-center">
                <img src="<?= $model->signature ?>" class="img-fluid img-thumbnail symbol">
            </div>
        </div>
    </section>

    
    <div class="form-group mt-5">
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>