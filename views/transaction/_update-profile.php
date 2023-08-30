<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Barangay;
use app\models\CivilStatus;
use app\models\EducationalAttainment;
use app\models\File;
use app\models\Member;
use app\models\PwdType;
use app\models\Relation;
use app\models\Sex;
use app\widgets\ActiveForm;
use app\widgets\AnchorBack;
use app\widgets\Autocomplete;
use app\widgets\BootstrapSelect;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
use app\widgets\OpenLayer;
use app\widgets\Webcam;

$formModel = $model->transferToExistingHouseholdModel;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form app\widgets\ActiveForm */

// $this->registerJsFile((new Map())->getApi(), ['async' => true, 'defer' => true, 'position' => yii\web\View::POS_BEGIN]);

$this->registerCss(<<< CSS
    .member-fields-container .card {
        box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px -1px !important;
    }
    .member-fields-container .hide {
        display:none;
    }
    .member-fields-container .show {
        display:block;
    }
CSS);


$this->registerJs(<<< JS
    $('.btn-transfer').click(function() {
        if($(this).data('to') == 'new') {
            KTApp.block('.member-view-page', {
                overlayColor: '#000000',
                state: 'primary',
                message: 'Please wait...'
            });
            $.ajax({
                url: app.baseUrl + 'member/transfer-to-new-household',
                data: {member_id: {$model->id}},
                method: 'get',
                dataType: 'json',
                success: function(s) {
                    if (s.status == 'success') {
                        $('#modal-transfer-to-new-household .modal-body').html(s.form);
                        $('#modal-transfer-to-new-household').modal('show');
                    }
                    else {
                        Swal.fire('Error', s.errorSummary, 'error');
                    }
                    KTApp.unblock('.member-view-page');
                },
                error: function(e) {
                    Swal.fire('Error', e.responseText, 'error');
                    KTApp.unblock('.member-view-page');
                }
            });
        }
        else {
            $('#modal-search-household').modal('show');
        }
    });

    let pensioner = $('#member-pensioner'),
        pensionContainer = $('.pension-container'),
        btnSearchHousehold = $('.btn-search-household'),
        btnConfirmHousehold = $('.btn-confirm-household'),
        inputHouseholdId = $('#household_id'),
        inputHouseholdNo = $('#input-household-no'),
        memberHouseholdId = $('#member-household_id'),
        memberQrId = $('#member-qr_id'),
        modalSearchHousehold = $('#modal-search-household');

    pensioner.change(function() {
        if($(this).val() == 1) {
            pensionContainer.removeClass('hide').addClass('show');
        }
        else {
            pensionContainer.removeClass('show').addClass('hide');
        }
    });

    modalSearchHousehold.on('shown.bs.modal', function () {
        inputHouseholdNo.trigger('focus');
    })

    btnSearchHousehold.click(function() {
        modalSearchHousehold.modal('show');
    });

    btnConfirmHousehold.click(function() {
        memberHouseholdId.val(inputHouseholdId.val());
        $('#household_no_display').html($('#household_no').val());

        modalSearchHousehold.modal('hide');
    });

    $(document).on('click', '.btn-remove-file', function() {
        var self = this;
        Swal.fire({
            title: "Are you sure?",
            text: "You won\"t be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {

                KTApp.block('body', {
                    overlayColor: '#000000',
                    state: 'warning',
                    message: 'Please wait...'
                });
                $.ajax({
                    url: app.baseUrl + 'file/delete?token=' + $(self).data('token'),
                    method: 'post',
                    dataType: 'json',
                    success: function(s) {
                        if(s.status == 'success') {
                            $('#table-file').DataTable({
                                destroy: true,
                                pageLength: 5,
                                order: [[0, 'desc']]
                            }).row($(self).closest('tr')).remove().draw();
                            $(document).find('.file-hidden-input-' + $(self).data('token')).remove();
                            Swal.fire({
                                icon: "success",
                                title: "Deleted",
                                text: "Your file has been deleted.",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        else {
                            Swal.fire('Error', s.errors, 'error');
                        }
                        KTApp.unblock('body');
                    },
                    error: function(e) {
                        Swal.fire('Error', e.responseText, 'error');
                        KTApp.unblock('body');
                    },
                })
            }
        });
    });


    $(document).on('click', '.btn-edit-file', function() {
        let file = $(this);

        KTApp.block('.files-container', {
            state: 'warning', // a bootstrap color
            message: 'Please wait...',
        });

        $.ajax({
            url: app.baseUrl + 'file/view',
            method: 'get',
            data: {
                token: file.data('token'),
                template: '_form-ajax',
            },
            dataType: 'json',
            success: function(s) {
                if(s.status == 'success') {
                    $('#modal-edit-document .modal-body').html(s.form);
                    $('#modal-edit-document').modal('show');
                }
                else {
                    Swal.fire('Error', s.error, 'error');
                }
                KTApp.unblock('.files-container');
            },
            error: function(e) {
                Swal.fire('Error', e.responseText, 'error');
                KTApp.unblock('.files-container');
            }
        });
    });

    let addSkill = function() {
        let skill = $('#input-skill');
        if(skill.val()) {
            let html = '<div class="input-group mb-3">';
                html += '<input type="text" name="Member[skills][]" class="form-control" value="'+ skill.val() +'">';
                html += '<div class="input-group-append">';
                    html += '<button class="btn btn-danger btn-icon btn-remove-skill" type="button">';
                        html += '<i class="fa fa-trash"></i>';
                    html += '</button>';
                html += '</div>';
            html += '</div>';

            $('.skills-container').prepend(html);
            skill.val('');
        }
        else {
            Swal.fire('Warning', 'Please enter a skill!', 'warning');
        }
    }

    $('.btn-add-skill').click(function() {
        addSkill();
    });

    $('#input-skill').on('keydown', function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            addSkill();
        }
    });

    $(document).on('click', '.btn-remove-skill', function() {
        var self = this;
        Swal.fire({
            title: "Are you sure?",
            text: "You are going to remove skill",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                $(self).closest('.input-group').remove();
            } 
        });
    });
JS);

$transferBtn = Html::if($model->canTransferToExistingHousehold || $model->canTransferToNewHousehold, function() use($model) {
    $existing = $model->canTransferToExistingHousehold ? Html::a('Existing Household', '#', [
        'class' => 'dropdown-item btn-transfer',
        'data-to' => 'existing'
    ]): '';

    $new = $model->canTransferToNewHousehold ? Html::a('New Household', '#', [
        'class' => 'dropdown-item btn-transfer',
        'data-to' => 'new'
    ]): '';

    return <<< HTML
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-facebook font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Transfer to:
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                {$new}
                {$existing}
            </div>
        </div>
    HTML;
});
?>

<?php $form = ActiveForm::begin([
    'id' => 'member-form'
]); ?>
    <div class="member-fields-container">

        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => "Household Information | {$model->householdNo}",
                    'toolbar' => <<< HTML
                        <div class="card-toolbar">
                            {$transferBtn}
                        </div>
                    HTML
                ]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="household-transfer_date">Transfer Date</label>
                        <?= $form->field($household, 'transfer_date', [
                            'options' => [
                                'class' => 'input-group date', 
                                'id' => 'kt_datetimepicker',
                                'data-target-input' => 'nearest'
                            ],
                            'template' => <<< HTML
                                {input}
                                <div class="input-group-append" data-target="#kt_datetimepicker" data-toggle="datetimepicker">
                                    <span class="input-group-text">
                                        <i class="ki ki-calendar"></i>
                                    </span>
                                </div>
                                {error}
                            HTML
                        ])->textInput([
                            'class' => 'form-control datetimepicker-input',
                            'placeholder' => 'Select date & time',
                            'data-target' => '#kt_datetimepicker'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= BootstrapSelect::widget([
                            'form' => $form,
                            'model' => $household,
                            'prompt' => false,
                            'attribute' => 'barangay_id',
                            'data' => Barangay::dropdown('no', 'name', [
                                'municipality_id' => App::setting('address')->municipality_id
                            ])
                        ]) ?>
                        <?= $this->render('/household/_form/_add-new-btn', [
                            'url' => ['barangay/create'],
                            'title' => 'Barangay'
                        ]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($household, 'purok_no')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($household, 'blk_no')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($household, 'lot_no')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($household, 'street')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($household, 'zone_no')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($household, 'sitio')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($household, 'landmark')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <?= $form->field($household, 'latitude')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col">
                        <?= $form->field($household, 'longitude')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col">
                        <?= $form->field($household, 'altitude')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <?= OpenLayer::widget([
                    'longitude' => $household->longitude,
                    'latitude' => $household->latitude,
                    'clickCallback' => <<< JS
                        $('#household-latitude').val(lat);
                        $('#household-longitude').val(lon);
                    JS
                ]) ?>

                <div class="row">
                    <div class="col-md-12">
                        <p class="lead font-weight-bold mt-5">UPLOAD PHOTO OF RESIDENCE</p>
                        <?= Dropzone::widget([
                            'tag' => 'Household',
                            'files' => $household->imageFiles,
                            'model' => $household,
                            'attribute' => 'files',
                            'acceptedFiles' => array_map(
                                function($val) { 
                                    return ".{$val}"; 
                                }, File::EXTENSIONS['image']
                            )
                        ]) ?>
                    </div>
                </div>
                    
                <?php $this->endContent(); ?>
            </div>
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Primary Information'
                ]); ?>
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= BootstrapSelect::widget([
                                'form' => $form,
                                'model' => $model,
                                'attribute' => 'sex',
                                'data' => Sex::dropdown(),
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= BootstrapSelect::widget([
                                'form' => $form,
                                'model' => $model,
                                'attribute' => 'civil_status',
                                'data' => CivilStatus::dropdown(),
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= BootstrapSelect::widget([
                                'form' => $form,
                                'model' => $model,
                                'attribute' => 'educational_attainment',
                                'data' => EducationalAttainment::dropdown(),
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'birth_date', [
                                'template' => "
                                    {label} <span class='text-muted'>(mm/dd/yyyy)</span>
                                    {input}
                                    {error}
                                "    
                            ])->textInput([
                                'datepicker' => 'true',
                                'autocomplete' => 'off'
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" id="household_id" class="app-hidden" value="<?= $model->household_id ?>">
                            <input type="text" id="household_no" class="app-hidden" value="<?= $model->householdNo ?>">
                            <?= $form->field($model, 'household_id')->textInput([
                                'maxlength' => true,
                                'readonly' => true,
                                'class' => 'app-hidden'
                            ])->label(false) ?>                            

                            <div data-trigger="hover" data-toggle="popover" title="Family Head" data-html="true" data-content="Setting this as <span class='label label-inline font-weight-bold label-light-primary'>family head</span> will overwrite the existing <code>family head</code>.">
                                <?= BootstrapSelect::widget([
                                    'form' => $form,
                                    'model' => $model,
                                    'prompt' => false,
                                    'attribute' => 'head',
                                    'data' => App::keyMapParams('family_head'),
                                ]) ?>
                            </div>

                            <?= Html::if(!$model->isNewRecord, 
                                BootstrapSelect::widget([
                                    'form' => $form,
                                    'model' => $model,
                                    'prompt' => false,
                                    'attribute' => 'relation',
                                    'label' => 'Relation to Family head',
                                    'data' => Relation::dropdown(),
                                ])
                            ) ?>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <?= Html::image($model->photo, ['w' => 200], [
                                    'class' => 'user-photo img-thumbnail'
                                ]) ?>
                                <div class="mt-4"></div>
                                <?= ImageGallery::widget([
                                    'tag' => 'Member',
                                    'buttonTitle' => 'Choose Profile Photo',
                                    'model' => $model,
                                    'attribute' => 'photo',
                                    'ajaxSuccess' => "
                                        if(s.status == 'success') {
                                            $('.user-photo').attr('src', s.src + '');
                                        }
                                    ",
                                ]) ?> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead font-weight-bold mt-5">UPLOAD IDENTIFICATION CARDS</p>
                            <?= Dropzone::widget([
                                'tag' => 'Member',
                                'files' => $model->identificationCards,
                                'model' => $model,
                                'attribute' => 'id_cards',
                                'acceptedFiles' => array_map(
                                    function($val) { 
                                        return ".{$val}"; 
                                    }, File::EXTENSIONS['image']
                                )
                            ]) ?>
                        </div>
                    </div>
                        
                <?php $this->endContent(); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Contact Information'
                ]); ?>
                    <?= $form->field($model, 'email')->textInput([
                        'maxlength' => true
                    ]) ?>
                    <?= $form->field($model, 'contact_no')
                        ->textInput(['maxlength' => true])
                        ->label('Mobile Number') ?>
                    <?= $form->field($model, 'telephone_no')->textInput([
                        'maxlength' => true
                    ]) ?>
                <?php $this->endContent(); ?>
            </div>

            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Occupation'
                ]); ?>
                    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'income')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'source_of_income')->textInput([
                        'maxlength' => true,
                        'list' => 'source_of_incomes'
                    ]) ?>
            
                    <datalist id="source_of_incomes">
                        <?= Html::foreach(App::keyMapParams('source_of_incomes'), function($s) {
                            return "<option value='{$s}'>";
                        }) ?>
                    </datalist>
                <?php $this->endContent(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Pension'
                ]); ?>

                <?= BootstrapSelect::widget([
                    'form' => $form,
                    'model' => $model,
                    'prompt' => false,
                    'attribute' => 'pensioner',
                    'data' => App::keyMapParams('pensioners'),
                ]) ?>
                <div class="pension-container <?= ($model->isPensioner)? '': 'hide' ?>">
                    <?= $form->field($model, 'pensioner_from')->textInput([
                        'maxlength' => true,
                        'list' => 'pensioner_from',
                    ]) ?>
                    <datalist id="pensioner_from">
                        <?= Html::foreach(App::keyMapParams('pensioner_from'), function($s) {
                            return "<option value='{$s}'>";
                        }) ?>
                    </datalist>

                    <?= $form->field($model, 'pension_amount')->textInput(['maxlength' => true]) ?>
                </div>


                <?php $this->endContent(); ?>
            </div>

            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'PWD'
                ]); ?>

                <div class="row">
                    <div class="col">
                        <?= BootstrapSelect::widget([
                            'form' => $form,
                            'model' => $model,
                            'prompt' => false,
                            'attribute' => 'pwd',
                            'data' => App::keyMapParams('pwd'),
                            'prompt' => 'Select'
                        ]) ?>
                    </div>
                    <div class="col">
                        <?= BootstrapSelect::widget([
                            'form' => $form,
                            'model' => $model,
                            'prompt' => false,
                            'attribute' => 'pwd_type',
                            'data' => PwdType::dropdown('value', 'label'),
                            'prompt' => 'Select'
                        ]) ?>

                    </div>
                </div>
                <?php $this->endContent(); ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Skills'
                ]); ?>
                    <label class="control-label"> Skills </label>
                    <div class="skills-container">
                        <?= Html::foreach($model->skills, function($skill) use($model) {
                            $input = Html::activeInput('text', $model, 'skills[]', [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Skill',
                                'value' => $skill
                            ]);

                            return <<< HTML
                                <div class="input-group mb-3">
                                    {$input}
                                    <div class="input-group-append">
                                        <button class="btn btn-danger btn-icon btn-remove-skill" type="button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            HTML;
                        }) ?>

                        <div class="input-group">
                            <?= Html::activeInput('text', $model, 'skills[]', [
                                'class' => 'form-control',
                                'id' => 'input-skill',
                                'placeholder' => 'Enter Skill'
                            ]) ?>
                            <div class="input-group-append">
                                <button class="btn btn-success btn-icon btn-add-skill" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php $this->endContent(); ?>
            </div>
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Others'
                ]); ?>
                    <?= BootstrapSelect::widget([
                        'form' => $form,
                        'model' => $model,
                        'prompt' => false,
                        'attribute' => 'solo_parent',
                        'data' => App::keyMapParams('solo_parent'),
                        'prompt' => 'Select'
                    ]) ?>
                    <?= BootstrapSelect::widget([
                        'form' => $form,
                        'model' => $model,
                        'prompt' => false,
                        'attribute' => 'living_status',
                        'data' => App::keyMapParams('living_status'),
                    ]) ?>
                    <?= BootstrapSelect::widget([
                        'form' => $form,
                        'model' => $model,
                        'prompt' => false,
                        'attribute' => 'fourPs',
                        'data' => App::keyMapParams('fourPs'),
                    ]) ?>

                    <?= BootstrapSelect::widget([
                        'form' => $form,
                        'model' => $model,
                        'prompt' => false,
                        'attribute' => 'voter',
                        'data' => App::keyMapParams('voters'),
                    ]) ?>
                <?php $this->endContent(); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Upload Documents'
                ]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="document-container-holder"></div>
                                    <?= Webcam::widget([
                                        'tag' => 'Member',
                                        'withInput' => false,
                                        'model' => $model,
                                        'attribute' => 'documents[]',
                                        'ajaxSuccess' => <<< JS
                                            $('#table-file').DataTable({
                                                destroy: true,
                                                pageLength: 5,
                                                order: [[0, 'desc']]
                                            }).row.add($(s.row)).draw();
                                            $('.document-container-holder').prepend('<input class="app-hidden file-hidden-input-'+ s.file.token +'" type="text" name="Member[documents][]" value="'+ s.file.token +'">'); 
                                        JS
                                    ]) ?>
                                </div>
                                <div class="col">
                                   <?= Dropzone::widget([
                                        'tag' => 'Member',
                                        'model' => $model,
                                        'attribute' => 'documents',
                                        'inputName' => 'hidden',
                                        'success' => <<< JS
                                            this.removeFile(file);
                                            $('#table-file').DataTable({
                                                destroy: true,
                                                pageLength: 5,
                                                order: [[0, 'desc']]
                                            }).row.add($(s.row)).draw();
                                            $('.document-container-holder').prepend('<input class="app-hidden file-hidden-input-'+ s.file.token +'" type="text" name="Member[documents][]" value="'+ s.file.token +'">'); 
                                        JS,
                                    ]) ?>
                                </div>
                            </div> 
                        </div>
                        <div class="col">
                            <?php $this->beginContent('@app/views/file/_row-header.php'); ?>
                                <?= Html::foreach($model->imageFiles, function($file) {
                                    return $this->render('/file/_row', [
                                        'model' => $file
                                    ]) . Html::input('text', 'Member[documents][]', $file->token,
                                        ['class' => "app-hidden file-hidden-input-{$file->token}"]
                                    );
                                }) ?>
                            <?php $this->endContent(); ?>
                        </div>
                    </div>
                <?php $this->endContent(); ?>
            </div>
        </div>
    </div> 
	<div class="form-group">
        <?= ActiveForm::buttons('lg') ?>
	</div>
<?php ActiveForm::end(); ?>

<div class="modal fade" id="modal-edit-document" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-document">Rename File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-transfer-to-new-household" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-transfer-to-new-householdLabel">
                    Transfer to new Household : <?= $model->fullname ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
                <button type="button" class="btn btn-primary font-weight-bold">Save</button>
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-search-household" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search Household</h5>
                <button type="button" class="close btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" data-scroll="true" style="height: 100vh">
                <?= Autocomplete::widget([
                    'input' => Html::input('text', 'keywords', '', [
                        'class' => 'form-control form-control-lg',
                        'id' => 'input-household-no',
                        'placeholder' => 'Type Household No',
                        'autofocus' => true
                    ]),
                    'submitOnclickJs' => <<< JS
                        let modalContainer = '#modal-search-household .modal-body';
                        KTApp.block(modalContainer, {
                            overlayColor: '#000000',
                            state: 'warning',
                            message: 'Please wait...'
                        });
                        $.ajax({
                            url: app.baseUrl + 'member/find-household-no',
                            data: {keywords: inp.value, html: true},
                            method: 'get',
                            cache: false,
                            dataType: 'json',
                            success: function(s) {
                                if (s.status == 'success') {
                                    $('#household-container').html(s.html);
                                    $('#transfertoexistinghouseholdform-household_id').val(s.model.id);
                                }
                                else {
                                    Swal.fire("Error", s.error, "error");
                                }
                                KTApp.unblock(modalContainer);
                            },
                            error: function(e) {
                                Swal.fire("Error", e.responseText, "error");
                                KTApp.unblock(modalContainer);
                            }
                        });
                    JS,
                    'url' => Url::to(['member/find-household-no'])
                ]) ?>

                <div id="household-container" class="my-10">
                    <div class="text-center">
                        <h3>Search Household</h3>
                        <p class="lead">
                            Household Details will go here.
                        </p>
                    </div>
                </div>
                <?php $form = ActiveForm::begin([
                    'action' => ['member/transfer-to-existing-household', 'member_id' => $model->id]
                ]);  ?>

                    <?= $form->field($formModel, 'head')->radioList([
                        Member::FAMILY_HEAD_YES => 'Head',
                        Member::FAMILY_HEAD_NO => 'Member',
                    ])->label('Family Position') ?>

                    <?= $form->field($formModel, 'member_id')->hiddenInput()->label(false) ?>
                    <?= $form->field($formModel, 'household_id')->hiddenInput()->label(false) ?>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-lg font-weight-bold btn-confirm-household">Confirm Household</button>
                        <?= Html::a('Cancel', '#', [
                            'class' => 'btn btn-light-danger btn-lg font-weight-bold btn-close-modal',
                            'data-dismiss' => 'modal'
                        ]) ?>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>