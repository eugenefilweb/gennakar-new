<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Passenger;
use app\models\Vehicle;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\ESignature;

$passenger = $model->newPassenger;
?>

<div class="passengers-container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                <?= $tabData['title'] ?>
            </h4>
        </div>
        <div>
            <?= Html::button('<i class="fa fa-plus-circle"></i> Add Passenger', [
                'class' => 'btn btn-primary font-weight-bold btn-add-passenger',
            ]) ?>
        </div>
    </div>
                
    <div class="my-10"></div>

    <?php $form = ActiveForm::begin() ?>
        <table class="table table-bordered" id="tbl-passengers">
            <thead>
                <tr>
                    <th>#</th>
                    <th>vehicle</th>
                    <th>name</th>
                    <th>age</th>
                    <th width="200">action</th>
                </tr>
            </thead>
            <tbody>
                <?= App::foreach($model->passengers, fn ($passenger, $key, $counter) => <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>{$passenger->driverPlateNo}</td>
                        <td>{$passenger->name}</td>
                        <td>{$passenger->age}</td>
                        <td>
                            <a data-id="{$passenger->id}" href="#" class="btn btn-icon btn-sm btn-primary btn-update-passenger">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{$passenger->deleteUrl}?redirect=referrer" data-confirm="Are you sure?" data-method="post" class="btn btn-icon btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                HTML) ?>
            </tbody>
        </table>
        <div class="form-group mt-10">
            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            <?= Html::a('Previous', Url::current(['tab' => 'vehicles']), [
                'class' => 'btn btn-light-primary font-weight-bold btn-lg'
            ]) ?>
            <?= Html::submitButton('Next', [
                'class' => 'btn btn-success btn-lg font-weight-bold'
            ]) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>


<?php $formPassenger = ActiveForm::begin([
    'id' => 'passenger-form', 
    'options' => [
        'style' => 'display: none;',
        'create-url' => Url::toRoute(['passenger/create', 'redirect' => 'referrer']),
    ],
    'action' => ['passenger/create', 'redirect' => 'referrer']
]); ?>
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                Add Passenger
            </h4>
        </div>
        <div>
            <button type="button" class="btn btn-light-primary font-weight-bolder btn-cancel-add-passenger">Cancel</button>
        </div>
    </div>
    <div class="my-5"></div>
    <div class="row">
        <div class="col-md-4">
            <?= BootstrapSelect::widget([
                'prompt' => false,
                'form' => $formPassenger,
                'model' => $passenger,
                'attribute' => 'vehicle_id',
                'label' => 'Vehicle',
                'data' => Vehicle::dropdown('id', 'driver_firstname', [
                    'vehicular_accident_report_id' => $model->id
                ])
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'last_name')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'first_name')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'middle_name')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'suffix_name')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= BootstrapSelect::widget([
                'form' => $formPassenger,
                'model' => $passenger,
                'attribute' => 'sex',
                'data' => App::keyMapParams('gender')
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'age')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?= $formPassenger->field($passenger, 'address')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>

    <div class="my-5"></div>
    <p class="lead text-muted text-uppercase font-weight-bold">CONTACT DETAILS</p>
    <div class="row">
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'email')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'contact_no')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'alternate_contact_no')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
    </div>

    <div class="my-5"></div>
    <p class="lead text-muted text-uppercase font-weight-bold">HEALTH DETAILS</p>
    <div class="row">
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'health_condition')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= DataList::widget([
                'form' => $formPassenger,
                'model' => $passenger,
                'attribute' => 'medical_complaint',
                'data' => ArrayHelper::combine(App::params('var')['medical_complaints'])
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= BootstrapSelect::widget([
                'prompt' => false,
                'form' => $formPassenger,
                'model' => $passenger,
                'attribute' => 'condition',
                'data' => [
                    Passenger::FATAL => 'Fatal',
                    Passenger::NON_FATAL => 'Non Fatal',
                ]
            ]) ?>
        </div>
    </div>

    <div class="my-5"></div>
    <p class="lead text-muted text-uppercase font-weight-bold">REMARKS</p>
    <div class="row">
        <div class="col-md-12">
            <?= $formPassenger->field($passenger, 'observation')->textarea([
                'rows' => 8
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'preferred_by')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formPassenger->field($passenger, 'noted_by')->textInput([
                'maxlength' => true
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= DatePicker::widget([
                'form' => $formPassenger,
                'model' => $passenger,
                'attribute' => 'date',
            ]) ?>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <section>
        <p class="mt-5 lead text-muted text-uppercase font-weight-bold">STATEMENT DETAILS</p>
        <div class="row">
            <div class="col-md-12">
                <?= $formPassenger->field($passenger, 'statement')->textarea(['rows' => 8]) ?>
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
                    'model' => $passenger,
                    'form' => $formPassenger,
                    'attribute' => 'signature',
                    // 'clearJs' => <<< JS
                    //     $('.signature').attr('src', '{$passenger->signature}');
                    // JS,
                ]) ?>
            </div>
            <div class="col-lg-6 text-center">
                <?= Html::img($passenger->signature ?: Url::image(App::setting('image')->image_holder, ['w' => 200]), [
                    'class' => 'img-fluid symbol signature img-thumbnail',
                    'style' => 'max-width:100%;max-height:auto'
                ]) ?>
            </div>
        </div>
    </section>

    <?= $formPassenger->field($passenger, 'vehicular_accident_report_id')
        ->hiddenInput()
        ->label(false) ?>
    <div class="form-group mt-10">
        <button type="submit" class="btn btn-success font-weight-bold"> Save </button>
        <button type="button" class="btn btn-light-primary font-weight-bold btn-cancel-add-passenger">Cancel</button>
    </div>
<?php ActiveForm::end(); ?>