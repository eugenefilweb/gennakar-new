<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Vehicle;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\ESignature;
use app\widgets\ImageGallery; 

$vehicle = $model->newVehicle;
?>

<div class="vehicles-container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                <?= $tabData['title'] ?>
            </h4>
        </div>
        <div>
            <?= Html::button('<i class="fa fa-plus-circle"></i> Add Vehicle', [
                'class' => 'btn btn-primary font-weight-bold btn-add-vehicle',
            ]) ?>
        </div>
    </div>
                
    <div class="my-10"></div>

    <?php $form = ActiveForm::begin() ?>
        <table class="table table-bordered" id="tbl-vehicles">
            <thead>
                <tr>
                    <th>#</th>
                    <th>plate no</th>
                    <th>driver</th>
                    <th>vehicle</th>
                    <th width="200">action</th>
                </tr>
            </thead>
            <tbody>
                <?= App::foreach($model->vehicles, fn ($vehicle, $key, $counter) => <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>{$vehicle->plate_no}</td>
                        <td>{$vehicle->driverName}</td>
                        <td>{$vehicle->class}</td>
                        <td>
                            <a data-id="{$vehicle->id}" href="#" class="btn btn-icon btn-sm btn-primary btn-update-vehicle">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{$vehicle->deleteUrl}?redirect=referrer" data-confirm="Are you sure?" data-method="post" class="btn btn-icon btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                HTML) ?>
            </tbody>
        </table>
        <div class="form-group mt-10">
            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            <?= Html::a('Previous', Url::current(['tab' => 'map-vicinity']), [
                'class' => 'btn btn-light-primary font-weight-bold btn-lg'
            ]) ?>
            <?= Html::submitButton('Next', [
                'class' => 'btn btn-success btn-lg font-weight-bold'
            ]) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>

<?php $formVehicle = ActiveForm::begin([
    'id' => 'vehicle-form', 
    'options' => [
        'style' => 'display: none;',
        'create-url' => Url::toRoute(['vehicle/create', 'redirect' => 'referrer']),
    ],
    'action' => ['vehicle/create', 'redirect' => 'referrer']
]); ?>

    <section>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0 font-weight-bold text-dark">
                    Add Vehicle
                </h4>
            </div>
            <div>
                <button type="button" class="btn btn-light-primary font-weight-bolder btn-cancel-add-vehicle">Cancel</button>
            </div>
        </div>
        <div class="my-5"></div>
        <p class="lead text-muted text-uppercase font-weight-bold">DRIVER DETAILS</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_lastname')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_firstname')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_middlename')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_suffix')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-8">
                <?= $formVehicle->field($vehicle, 'driver_address')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
        </div>
        <p class="text-uppercase font-weight-bold">CONTACT DETAILS</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_email')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_contact_no')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'driver_alt_contact_no')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
        </div>
        
        
        <div class="dropdown-divider"></div>
        <p class="mt-5 text-uppercase font-weight-bold">LICENSE</p>
        <div class="row">
            <div class="col-md-6 text-center">
                <div>
                    <label class="control-label">
                        <?= $vehicle->getAttributeLabel('driver_license_front') ?>
                    </label>
                </div>
                <?= Html::image($vehicle->driver_license_front, ['w' => 200], [
                    'class' => 'img-thumbnail driver_license_front',
                    'loading' => 'lazy',
                ] ) ?>
                <div class="my-3"></div>
                <?= ImageGallery::widget([
                    'fixedSize' => false,
                    'buttonTitle' => 'Choose Photo',
                    'tag' => 'Driver License',
                    'model' => $vehicle,
                    'attribute' => 'driver_license_front',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.driver_license_front').attr('src', s.src);
                        }                                    
                    ",
                ]) ?> 
            </div>
            <div class="col-md-6 text-center">
                <div>
                    <label class="control-label">
                        <?= $vehicle->getAttributeLabel('driver_license_back') ?>
                    </label>
                </div>
                <?= Html::image($vehicle->driver_license_back, ['w' => 200], [
                    'class' => 'img-thumbnail driver_license_back',
                    'loading' => 'lazy',
                ] ) ?>
                <div class="my-3"></div>
                <?= ImageGallery::widget([
                    'fixedSize' => false,
                    'buttonTitle' => 'Choose Photo',
                    'tag' => 'Driver License',
                    'model' => $vehicle,
                    'attribute' => 'driver_license_back',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.driver_license_back').attr('src', s.src);
                        }                                    
                    ",
                ]) ?> 
            </div>
        </div>
    </section>

    <div class="dropdown-divider"></div>
    <section>
        <p class="mt-5 lead text-muted text-uppercase font-weight-bold">VEHICLE DETAILS</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'plate_no')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>

            <div class="col-md-4">
                <?= DataList::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'type',
                    'data' => ArrayHelper::combine(App::params('var')['type'])
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'class')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'make')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'model')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'year')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'color')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'type_of_cargo')->textInput() ?>
            </div>
        </div>

        <div class="dropdown-divider"></div>
        <p class="mt-5 text-uppercase font-weight-bold">INSURANCE</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'insurance_company')->textInput([
                    'maxlength' => true
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= DataList::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'insurance_type',
                    'data' => ArrayHelper::combine(App::params('var')['insurance_type'])
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= BootstrapSelect::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'insurance_status',
                    'data' => App::params('var')['insurance_status']
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= DatePicker::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'coverage_start_date',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= DatePicker::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'coverage_end_date',
                    'endDate' => ''
                ]) ?>
            </div>
        </div>

        <div class="dropdown-divider"></div>
        <p class="mt-5 text-uppercase font-weight-bold">OFFICIAL RECEIPT (OR)</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'or_no')->textInput([
                    'maxlength' => true
                ]) ?>
                <?= DatePicker::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'or_no_date_issued',
                ]) ?>
            </div>
            <div class="col-md-4 text-center">
                <?= Html::image($vehicle->or_photo, ['w' => 200], [
                    'class' => 'img-thumbnail or_photo',
                    'loading' => 'lazy',
                ] ) ?>
                <div class="my-3"></div>
                <?= ImageGallery::widget([
                    'buttonTitle' => 'Choose Photo',
                    'tag' => 'Official Receipt',
                    'model' => $vehicle,
                    'attribute' => 'or_photo',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.or_photo').attr('src', s.src);
                        }
                    ",
                ]) ?> 
            </div>
        </div>

        <div class="dropdown-divider"></div>
        <p class="mt-5 text-uppercase font-weight-bold">CERTIFICATE OF REGISTRATION (CR)</p>
        <div class="row">
            <div class="col-md-4">
                <?= $formVehicle->field($vehicle, 'cr_no')->textInput([
                    'maxlength' => true
                ]) ?>
                <?= DatePicker::widget([
                    'form' => $formVehicle,
                    'model' => $vehicle,
                    'attribute' => 'cr_no_date_issued',
                ]) ?>
            </div>
            <div class="col-md-4 text-center">
                <?= Html::image($vehicle->cr_photo, ['w' => 200], [
                    'class' => 'img-thumbnail cr_photo',
                    'loading' => 'lazy',
                ] ) ?>
                <div class="my-3"></div>
                <?= ImageGallery::widget([
                    'buttonTitle' => 'Choose Photo',
                    'tag' => 'Certificate of Registration',
                    'model' => $vehicle,
                    'attribute' => 'cr_photo',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.cr_photo').attr('src', s.src);
                        }                                    
                    ",
                ]) ?> 
            </div>
        </div>
    </section>

    <div class="dropdown-divider"></div>
    <section>
        <p class="mt-5 lead text-muted text-uppercase font-weight-bold">COMMERCIAL VEHICLE / COMPANY</p>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Is Commercial</label>
                    <div class="radio-inline">
                        <label class="radio">
                            <input class="is_commercial" value="<?= Vehicle::COMMERCIAL ?>" type="radio" name="Vehicle[is_commercial]" <?= $vehicle->isCommercial? 'checked': '' ?>>
                            <span></span>Yes
                        </label>
                        <label class="radio">
                            <input class="is_commercial" value="<?= Vehicle::NOT_COMMERCIAL ?>" type="radio" name="Vehicle[is_commercial]" <?= !$vehicle->isCommercial? 'checked': '' ?>>
                            <span></span>No
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $formVehicle->field($vehicle, 'company_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $formVehicle->field($vehicle, 'company_contact_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $formVehicle->field($vehicle, 'company_address')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <div class="dropdown-divider"></div>
    <section>
        <p class="mt-5 lead text-muted text-uppercase font-weight-bold">STATEMENT DETAILS</p>
        <div class="row">
            <div class="col-md-12">
                <?= $formVehicle->field($vehicle, 'statement')->textarea(['rows' => 8]) ?>
            </div>
        </div>
    </section>

    <div class="dropdown-divider"></div>
    <section>
        <p class="mt-5 lead text-muted text-uppercase font-weight-bold">SIGNATURE</p>
        <div class="row">
            <div class="col-lg-6 text-center">
                <?= ESignature::widget([
                    'width' => 400,
                    'height' => 240,
                    'uploadSuccess' => <<< JS
                        $('.signature').attr('src', toDataURL);
                    JS,
                    'model' => $vehicle,
                    'form' => $formVehicle,
                    'attribute' => 'signature',
                    // 'clearJs' => <<< JS
                    //     $('.signature').attr('src', '{$vehicle->signature}');
                    // JS,
                ]) ?>
            </div>
            <div class="col-lg-6 text-center">
                <?= Html::img($vehicle->signature ?: Url::image(App::setting('image')->image_holder, ['w' => 200]), [
                    'class' => 'img-fluid symbol signature img-thumbnail',
                    'style' => 'max-width:100%;max-height:auto'
                ]) ?>
            </div>
        </div>
    </section>

    <?= $formVehicle->field($vehicle, 'vehicular_accident_report_id')
        ->hiddenInput()
        ->label(false) ?>
    <div class="form-group mt-10">
        <button type="submit" class="btn btn-success font-weight-bold"> Save </button>
        <button type="button" class="btn btn-light-primary font-weight-bold btn-cancel-add-vehicle">Cancel</button>
    </div>
<?php ActiveForm::end(); ?>