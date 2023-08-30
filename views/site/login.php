<?php

/* @var $form app\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
use app\widgets\Alert;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$publishedUrl = App::publishedUrl();

$bgUrl = App::setting('bgUrl');

$this->registerCss(<<< CSS
    @media only screen and (max-width: 768px) {
        .login-content {
            padding: 0 !important;
            margin: 3rem !important;
        }
        .login-aside {
            display: none !important;
        }
    }
    .login-aside:before {
        background-image: url('{$bgUrl}');
        background-size: cover;
        content: "";
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        opacity: 0.5;
    }
CSS);

$this->registerJs(<<< JS
    let codeEl = $('#code'),
        modalEl = $('#modal-two-factor'),
        usernameEl = $('#loginform-username'),
        passwordEl = $('#loginform-password'),
        formEl = $('#kt_login_signin_form'),
        btnConfirmCodeEl = $('#btn-confirm-code'),
        btnLogin = $('#btn-login'),
        btnResendCode = $('#resend-code'),
        emailEl = $('#span-email'),
        verificationLink = '';

    const showLoading = (message = 'Please wait', el = '#kt_login') => {
        KTApp.block(el, {
            overlayColor: '#000000',
            message,
            state: 'primary'
        });
    }

    const errorCallback = (e) => {
        Swal.fire('Error', e.responseText, 'error');
        KTApp.unblock('#kt_login');
        KTApp.unblock('#modal-two-factor');
    }

    const confirmCodeHandler = () => {
        showLoading('Verifying...', '#modal-two-factor');

        $.ajax({
            url: verificationLink,
            data: {code: codeEl.val()},
            method: 'post',
            dataType: 'json',
            success: (s) => {
                switch (s.status) {
                    case 'success':
                        Swal.fire('Success', s.message, 'success');
                        location.href = s.link;
                        break;

                    case 'failed':
                        Swal.fire('Warning', s.errorSummary, 'warning');
                        break;
                    
                    default:
                        // code...
                        break;
                }
                
                KTApp.unblock('#modal-two-factor');
            },
            error: errorCallback
        })
    }

    const loginHandler = () => {
        modalEl.modal('hide');
        codeEl.val('');
        emailEl.html('');

        showLoading();

        $.ajax({
            url: formEl.attr('action'),
            data: formEl.serialize(),
            method: 'post',
            dataType: 'json',
            success: (s) => {
                switch (s.status) {
                    case 'success':
                        Swal.fire('Success', s.message, 'success');
                        location.href = s.link;
                        break;

                    case 'email_auth':
                        verificationLink = s.verificationLink;
                        emailEl.html(s.email);
                        modalEl.modal('show');
                        break;

                    case 'failed':
                        Swal.fire('Warning', s.errorSummary, 'warning');
                        break;
                    
                    default:
                        // code...
                        break;
                }
                
                KTApp.unblock('#kt_login');
            },
            error: errorCallback
        })
    }

    const keypressEnter = (e) => {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13') {
            loginHandler();
        }
    }

    modalEl.on('shown.bs.modal', () => codeEl.focus());
    btnConfirmCodeEl.click(confirmCodeHandler);
    btnLogin.click(loginHandler);
    usernameEl.keypress(keypressEnter);
    passwordEl.keypress(keypressEnter);
    btnResendCode.click(loginHandler);
JS);
?>
<div class="d-flex flex-column flex-root">
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #101010;">
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15" style="z-index: 9">
                <a href="<?= Url::to(['site/home']) ?>" class="text-center mb-15">
                    <img src="<?= App::baseUrl('default/nakar-logo.png') ?>" alt="logo" class="h-150px" />
                </a>
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg text-white">General Nakar Portal</h3>
            </div>
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"></div>
        </div>
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <div class="d-flex flex-column-fluid flex-center">
                <div class="login-form login-signin">
                    <?= Alert::widget() ?>
                    <?php $form = ActiveForm::begin([
                        'action' => ['site/secure-login'],
                        'id' => 'kt_login_signin_form',
                        'errorCssClass' => 'is-invalid',
                        'successCssClass' => 'is-valid',
                        'validationStateOn' => 'input',
                        'options' => [
                            'class' => 'form',
                            'novalidate' => 'novalidate'
                        ]
                    ]); ?>
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome</h3>
                            <!-- <span class="text-muted font-weight-bold font-size-h4">GAMIS Portal</span> -->
                            <!-- <span class="text-muted font-weight-bold font-size-h4">New Here?
                            <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span> -->
                        </div>
                        <?= $form->field($model, 'username', [
                            'template' => '
                                <label class="font-size-h6 font-weight-bolder text-dark">
                                    Username
                                </label>
                                {input}{error}
                            '
                        ])->textInput([
                            'autofocus' => true, 
                            'class' => 'form-control form-control-solid h-auto p-6 rounded-lg'
                        ]) ?>
                        <?= $form->field($model, 'password', [
                            'template' => '
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                    <a href="#" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
                                </div>
                                {input}{error}
                            '
                        ])->passwordInput([
                            'class' => 'form-control form-control-solid h-auto p-6 rounded-lg'
                        ]) ?>

                        <!-- <div class="checkbox-inline mb-5">
                            <label class="checkbox">
                            <input type="checkbox" name="LoginForm[rememberMe]" value="1">
                            <span></span>Remember Me</label>
                        </div> -->

                        <div class="pb-lg-0 pb-5">
                            <button type="button" id="btn-login" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="login-form login-signup">
                    <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto p-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto p-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto p-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto p-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label class="checkbox mb-0">
                                <input type="checkbox" name="agree" />
                                <span></span>
                            </label>
                            <div class="pl-2">I Agree the
                            <a href="#" class="ml-1">terms and conditions</a></div>
                        </div>
                        <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                        <button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                            <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="login-form login-forgot">
                    <?php $form = ActiveForm::begin([
                        'id' => 'kt_login_forgot_form',
                        'errorCssClass' => 'is-invalid',
                        'successCssClass' => 'is-valid',
                        'validationStateOn' => 'input',
                        'options' => [
                            'class' => 'form',
                            'novalidate' => 'novalidate'
                        ],
                        'action' => ['reset-password']
                    ]); ?>
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                        </div>
                        <?= $form->field($PSR, 'email')->textInput([
                            'class' => 'form-control form-control-solid h-auto p-6 rounded-lg font-size-h6',
                            'type' => 'email',
                            'placeholder' => 'Email',
                            'autocomplete' => 'off',
                        ])->label(false) ?>
                        <div class="form-group">
                            <div class="checkbox-list"> 
                                <label class="checkbox">
                                    <input type="checkbox" 
                                        value="1" 
                                        name="PasswordResetForm[hint]"> 
                                    <span></span>
                                    Show password hint instead.
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-wrap pb-lg-0">
                        <button type="submit" id="" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                            <button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-two-factor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Two Factor Authentication
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Please check your email 
                    "<span class="font-weight-bold" id="span-email"></span>"
                </p>
                <input type="text" id="code" class="form-control form-control-lg form-control-solid" placeholder="Enter Code">
            <!-- <div class="modal-footer"> -->
                <div class="align-items-md-center d-flex justify-content-between mt-6">
                    <div>
                        <p class="mb-0">Didn't receive code? <a href="#" id="resend-code">Resend</a></p>
                    </div>
                    <div>
                        <!-- <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary font-weight-bold" id="btn-confirm-code">Confirm</button>
                    </div>
                </div>
            <!-- </div> -->
            </div>
        </div>
    </div>
</div>