<?php

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;

$this->addJsFile('sortable/Sortable.min');

$this->registerJs(<<< JS
    const name = $('#reference-container input[name="name"]');
    const address = $('#reference-container input[name="address"]');
    const telNo = $('#reference-container input[name="tel_no"]');
    const addBtn = $('#reference-container .btn-add');
    const listContainer = $('#reference-container .list-container');

   
    const generateHtml = () => {
        const nameValue = name.val().trim();
        const addressValue = address.val().trim();
        const telNoValue = telNo.val().trim();
        const index = (new Date()).getTime();

        if(nameValue && addressValue && telNoValue) {
            const html = '\
                <div class="input-group mb-2">\
                    <div class="input-group-prepend">\
                        <button class="btn btn-secondary handle-sortable" type="button">\
                            <i class="fas fa-arrows-alt"></i>\
                        </button>\
                    </div>\
                    <input value="'+ nameValue +'" type="text" name="PersonalDataSheet[references]['+index+'][name]" class="form-control" placeholder="Enter Name">\
                    <input value="'+ addressValue +'" type="text" name="PersonalDataSheet[references]['+index+'][address]" class="form-control" placeholder="Enter Address">\
                    <input value="'+ telNoValue +'" type="text" name="PersonalDataSheet[references]['+index+'][tel_no]" class="form-control" placeholder="Enter Telephone No">\
                    <div class="input-group-append">\
                        <button class="btn btn-danger btn-icon btn-remove" type="button">\
                            <i class="fa fa-trash"></i>\
                        </button>\
                    </div>\
                </div>\
            ';

            listContainer.append(html);
            name.val('').focus();
            address.val('');
            telNo.val('');
        }
    };

    const enterEvent = (e) => {
        if(e.key == 'Enter') {
            e.preventDefault();
            generateHtml();
        }
    }

    name.on('keydown', enterEvent);
    address.on('keydown', enterEvent);
    telNo.on('keydown', enterEvent);

    addBtn.on('click', () => {
        generateHtml();
    });

    $(document).on('click', '#reference-container .btn-remove', function() {
        $(this).closest('.input-group').remove();
    });

    new Sortable(document.getElementById('reference-container-list'), {
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
    <div id="reference-container">
        <div class="list-container mt-2"  id="reference-container-list">
            <?= Html::foreach($model->references, function($reference, $index) {
                $name = $reference['name'] ?? '';
                $address = $reference['address'] ?? '';
                $tel_no = $reference['tel_no'] ?? '';

                return <<< HTML
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary handle-sortable" type="button">
                                <i class="fas fa-arrows-alt"></i>
                            </button>
                        </div>
                        <input placeholder="Enter Name" type="text" class="form-control" name="PersonalDataSheet[references][{$index}][name]" value="{$name}">
                        <input placeholder="Enter Address" type="text" class="form-control" name="PersonalDataSheet[references][{$index}][address]" value="{$address}">
                        <input placeholder="Enter Telephone No" type="text" class="form-control" name="PersonalDataSheet[references][{$index}][tel_no]" value="{$tel_no}">
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
            <input type="text" name="address" class="form-control" placeholder="Enter Address">
            <input type="text" name="tel_no" class="form-control" placeholder="Enter Telephone No">
            <div class="input-group-append">
                <button class="btn btn-success btn-add btn-icon" type="button">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
    </div>
	
    <div class="form-group mt-5">
        <?= Html::a('Back', Url::current(['step' => 'questionnaire']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>

        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>