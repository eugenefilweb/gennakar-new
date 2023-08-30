<?php

use app\helpers\Html;
use app\widgets\ActiveForm;

$this->registerJs(<<< JS
    $('.btn-send-code').click(function() {
        KTApp.block('#user-form-change-password', {
            overlayColor: '#000000',
            message: 'Sending code...',
            state: 'primary'
        });

        $.ajax({
            url: app.baseUrl + 'user/send-change-password-code',
            method: 'post',
            data: {token: '{$user->password_reset_token}'},
            dataType: 'json',
            success: (s) => {
                if (s.status == 'success') {
                    Swal.fire('Success', s.message, 'success');
                }
                else {
                    Swal.fire('Error', s.errorSummary, 'error');
                }
                KTApp.unblock('#user-form-change-password');
            },
            error: (e) => {
                Swal.fire('Error', e.responseText, 'error');
                KTApp.unblock('#user-form-change-password');
            }
        })
    });
JS);

$this->params['wrapCard'] = false;
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => 'Change Password Form',
        ]) ?>
            <?php $form = ActiveForm::begin(['id' => 'user-form-change-password']); ?>
                <?= $form->field($model, 'code', [
                    'template' => <<< HTML
                        {label}
                        <div class="input-group">
                            {input}
                            <div class="input-group-append">
                                <a href="#!" class="btn btn-secondary btn-send-code" title="Send Verification code to {$user->email}" data-toggle="tooltip">
                                    Send Code <i class="fab fa-telegram-plane"></i>
                                </a>
                            </div>
                        </div>
                        {error}
                    HTML
                ])->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'old_password')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password_hint')->textInput(['maxlength' => true]) ?>
                <div class="form-group">
                    <?= ActiveForm::buttons() ?>
                </div>
            <?php ActiveForm::end(); ?>
        <?php $this->endContent() ?>
    </div>

    <div class="col-md-6">
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => 'Google Authenticator',
            'stretch' => true
        ]) ?>
            <div class="text-center">
                <?= Html::img($user->qRCodeurl, [
                    'class' => 'img-thumbnail symbol'
                ]) ?>
                <p class="lead font-weight-bold mt-10">Scan These QR Code to add to Google Authenticator</p>
            </div>
        <?php $this->endContent() ?>
    </div>
</div>
