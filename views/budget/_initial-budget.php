<?php

use app\helpers\Html;
use app\models\Budget;
use app\models\Transaction;
use app\widgets\ActiveForm;

$this->registerJs(<<< JS
    $('#form-budget').on('beforeSubmit', function(e) {
        e.preventDefault();
        let form = $(this);
        KTApp.block('#modal-entry .modal-body', {
            overlayColor: '#000',
            state: 'warning', // a bootstrap color
            message: 'Saving...',
        });
 
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            dataType: 'json',
            data: form.serialize(),
            success: function(s) {
                if(s.status == 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Inital Budget Recorded",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload();
                }
                else {
                    Swal.fire("Error", s.errorSummary, "error");
                }
                KTApp.unblock('#modal-entry .modal-body');
            },
            error: function(e) {
                Swal.fire("Error", e.responseText, "error");
                KTApp.unblock('#modal-entry .modal-body');
            }
        });
        return false;
    });
JS, \yii\web\View::POS_END);
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-budget',
    'enableAjaxValidation' => true,
    'validationUrl' => $validationUrl ?? ['budget/create', 'ajaxValidate' => true]
]); ?>
    <?= $form->field($model, 'year')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'remarks')->textarea(['rows' => 8]) ?>
    <div class="mt-10">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Cancel', ['class' => 'btn btn-light-danger', 'data-dismiss' => 'modal']) ?>
    </div>
<?php ActiveForm::end(); ?>
