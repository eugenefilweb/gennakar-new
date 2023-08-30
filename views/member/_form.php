<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\CivilStatus;
use app\models\EducationalAttainment;
use app\models\File;
use app\models\PwdType;
use app\models\Relation;
use app\models\Sex;
use app\models\form\setting\SystemSettingForm;
use app\widgets\ActiveForm;
use app\widgets\AnchorBack;
use app\widgets\Autocomplete;
use app\widgets\BootstrapSelect;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
use app\widgets\Map;
use app\widgets\Webcam;

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
                        let tableId = $(self).closest('table').attr('id');

                        if(s.status == 'success') {
                            $('#' + tableId).DataTable({
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
?>

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
                        'placeholder' => 'Type Household No or Family Member',
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
                            dataType: 'json',
                            success: function(s) {
                                if (s.status == 'success') {
                                    $('#household-container').html(s.html);
                                    $('#household_id').val(s.model.id);
                                    $('#household_no').val(s.model.no);
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

                <p class="mt-3">Household not found? <?= Html::a('Create New here', ['household/create'], [
                    'target' => '_blank'
                ]) ?></p>


                <div id="household-container" class="mt-10">
                    <?= Html::ifElse($model->isNewRecord, <<< HTML
                        <div class="text-center">
                            <h3>Search Household</h3>
                        </div>
                    HTML, function() use($model) {
                        return $this->render('/member/create/household', [
                            'model' => $model->household
                        ]);
                    }) ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::a('Close', '#', [
                    'class' => 'btn btn-light-primary btn-lg font-weight-bold btn-close-modal',
                    'data-dismiss' => 'modal'
                ]) ?>
                <button type="button" class="btn btn-success btn-lg font-weight-bold btn-confirm-household">Confirm Household</button>
            </div>
        </div>
    </div>
</div>


<?php $form = ActiveForm::begin([
    'id' => 'member-form'
]); ?>
    <div class="member-fields-container">

        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Household & QR Code'
                ]); ?>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="household_id" class="app-hidden" value="<?= $model->household_id ?>">
                            <input type="text" id="household_no" class="app-hidden" value="<?= $model->householdNo ?>">
                            <p class="lead font-weight-bold">
                                Household No: <span id="household_no_display"><?= $model->householdNo ?></span> 
                                <a title="Find Household" data-toggle="tooltip" href="#" class="btn btn-facebook btn-search-household font-weight-bold">
                                    <i class="fa fa-search"></i>
                                    Find Household
                                </a>
                            </p>
                            
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
                    <?= BootstrapSelect::widget([
                        'form' => $form,
                        'model' => $model,
                        'attribute' => 'educational_attainment',
                        'data' => EducationalAttainment::dropdown(),
                    ]) ?>
                    <div class="row">
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
                        <div class="col-md-6">
                            <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>
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
                        'attribute' => 'solo_member',
                        'data' => App::keyMapParams('solo_member'),
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
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Upload Identification Cards'
                ]); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= Dropzone::widget([
                                'tag' => 'Member',
                                'model' => $model,
                                'attribute' => 'id_cards',
                                'inputName' => 'hidden',
                                'success' => <<< JS
                                    this.removeFile(file);
                                    $('#id-cards-table').DataTable({
                                        destroy: true,
                                        pageLength: 5,
                                        order: [[0, 'desc']]
                                    }).row.add($(s.row)).draw();
                                    $('.document-container-holder').prepend('<input class="app-hidden file-hidden-input-'+ s.file.token +'" type="text" name="Member[id_cards][]" value="'+ s.file.token +'">'); 
                                JS,
                                'acceptedFiles' => array_map(
                                    function($val) { 
                                        return ".{$val}"; 
                                    }, File::EXTENSIONS['image']
                                )
                            ]) ?>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <div class="id-container-holder"></div>
                            <?= Webcam::widget([
                                'tag' => 'Member',
                                'withInput' => false,
                                'model' => $model,
                                'attribute' => 'id_cards[]',
                                'ajaxSuccess' => <<< JS
                                    $('#id-cards-table').DataTable({
                                        destroy: true,
                                        pageLength: 5,
                                        order: [[0, 'desc']]
                                    }).row.add($(s.row)).draw();
                                    $('.id-container-holder').prepend('<input class="app-hidden file-hidden-input-'+ s.file.token +'" type="text" name="Member[id_cards][]" value="'+ s.file.token +'">'); 
                                JS
                            ]) ?>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <?php $this->beginContent('@app/views/file/_row-header.php', [
                                'tableId' => 'id-cards-table'
                            ]); ?>
                                <?= Html::foreach($model->identificationCards, function($file) {
                                    return $this->render('/file/_row', [
                                        'model' => $file
                                    ]) . Html::input('text', 'Member[id_cards][]', $file->token,
                                        ['class' => "app-hidden file-hidden-input-{$file->token}"]
                                    );
                                }) ?>
                            <?php $this->endContent(); ?>
                        </div>
                    </div>
                <?php $this->endContent(); ?>
            </div>
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Upload Other Documents',
                    'toolbar' => '<div class="card-toolbar">' . (new SystemSettingForm())->dataPrivacyDownloadButton . '</div>'
                ]); ?>
                    <div class="row">
                        <div class="col-md-12">
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
                    <div class="row mt-10">
                        <div class="col-md-12">
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
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12">
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