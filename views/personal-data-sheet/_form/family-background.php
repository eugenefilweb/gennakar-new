<?php

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;

$this->addJsFile('sortable/Sortable.min');

$this->registerJs(<<< JS
    const name = $('#children-container input[name="name"]');
    const birthdate = $('#children-container input[name="birthdate"]');
    const addBtn = $('#children-container .btn-add');
    const listContainer = $('#children-container .list-container');

   
    const generateHtml = () => {
        const nameValue = name.val().trim();
        const birthdateValue = birthdate.val().trim();
        const index = (new Date()).getTime();

        if(nameValue && birthdateValue) {
            const html = '\
                <div class="input-group mb-2">\
                    <div class="input-group-prepend">\
                        <button class="btn btn-secondary handle-sortable" type="button">\
                            <i class="fas fa-arrows-alt"></i>\
                        </button>\
                    </div>\
                    <input value="'+ nameValue +'" type="text" name="PersonalDataSheet[childrens]['+index+'][name]" class="form-control" placeholder="Enter Name">\
                    <input value="'+ birthdateValue +'" type="date" name="PersonalDataSheet[childrens]['+index+'][birthdate]" class="form-control" placeholder="Enter Birthdate">\
                    <div class="input-group-append">\
                        <button class="btn btn-danger btn-icon btn-remove" type="button">\
                            <i class="fa fa-trash"></i>\
                        </button>\
                    </div>\
                </div>\
            ';

            listContainer.append(html);
            name.val('').focus();
            birthdate.val('');
        }
    };

    const enterEvent = (e) => {
        if(e.key == 'Enter') {
            e.preventDefault();
            generateHtml();
        }
    }

    name.on('keydown', enterEvent);
    birthdate.on('keydown', enterEvent);

    addBtn.on('click', () => {
        generateHtml();
    });

    $(document).on('click', '#children-container .btn-remove', function() {
        $(this).closest('.input-group').remove();
    });

    new Sortable(document.getElementById('children-container-list'), {
        handle: '.handle-sortable', // handle's class
        animation: 150,
        ghostClass: 'bg-light-primary'
    });
JS);
?>

<h4 class="mb-10 font-weight-bold text-dark">
    <?= $current_step['title'] ?>
</h4>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <h6 class="font-weight-bold"> Spouse </h6>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_surname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_first_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_middle_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_name_extension')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_occupation')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_employer')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'spouse_employer_telephone_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6" id="children">
            <?= $form->field($model, 'spouse_employer_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <section class="mt-10">
        <h6 class="font-weight-bold"> Children </h6>
        <div class="row">
            <div class="col-md-12">
                <div id="children-container">
                    <div class="list-container mt-2"  id="children-container-list">
                        <?= Html::foreach($model->childrens, function($children, $index) {
                            $name = $children['name'] ?? '';
                            $birthdate = $children['birthdate'] ?? '';

                            return <<< HTML
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary handle-sortable" type="button">
                                            <i class="fas fa-arrows-alt"></i>
                                        </button>
                                    </div>
                                    <input placeholder="Enter Name" type="text" class="form-control" name="PersonalDataSheet[childrens][{$index}][name]" value="{$name}">
                                    <input placeholder="Enter Birthdate" type="date" class="form-control" name="PersonalDataSheet[childrens][{$index}][birthdate]" value="{$birthdate}">
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
                        <input type="date" name="birthdate" class="form-control" placeholder="Enter Birthdate">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-add btn-icon" type="button">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-10" id="father">
        <h6 class="font-weight-bold"> Father </h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'father_surname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'father_first_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'father_middle_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6" id="mother">
                <?= $form->field($model, 'father_name_extension')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <h6 class="font-weight-bold"> Mother </h6>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'mother_surname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'mother_first_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'mother_middle_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </section>
    <div class="form-group mt-5">
		<?= Html::a('Back', Url::current(['step' => 'personal-information']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>