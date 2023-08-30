<?php

use app\helpers\App;
use app\widgets\ActiveForm;

$controller_actions = App::component('access')->controllerActions;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss(<<< CSS
    .card-header {border-bottom: 0;}
    #card-header, #card-body {padding-left: 0; padding-top: 3px;}
CSS);

$this->registerJs(<<< JS
    $('#role-form li.nav-item').click(function() {
        let tab = $(this).data('tab');

        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        
        window.history.pushState({}, '', url);
    });
JS);

$tab = $tab ?? 'main';
?>
<?php $form = ActiveForm::begin(['id' => 'role-form']); ?>
    <div class="form-group">
        <?= ActiveForm::buttons() ?>
    </div>
    <div class="card-header card-header-tabs-line" id="card-header">
        <div class="card-toolbar">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                <li class="nav-item" data-tab="main">
                    <a class="nav-link <?= ($tab == 'main')? 'active': '' ?>" data-toggle="tab" href="#_main_form">
                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                        <span class="nav-text">Name</span>
                    </a>
                </li>
                <li class="nav-item" data-tab="role-access">
                    <a class="nav-link <?= ($tab == 'role-access')? 'active': '' ?>" data-toggle="tab" href="#_form_role_access">
                        <span class="nav-icon"><i class="flaticon2-user"></i></span>
                        <span class="nav-text">Role Access</span>
                    </a>
                </li>

                <li class="nav-item" data-tab="navigation">
                    <a class="nav-link <?= ($tab == 'navigation')? 'active': '' ?>" data-toggle="tab" href="#_form_navigation">
                        <span class="nav-icon"><i class="flaticon-grid-menu"></i></span>
                        <span class="nav-text">Navigation</span>
                    </a>
                </li>

                <li class="nav-item" data-tab="actions">
                    <a class="nav-link <?= ($tab == 'actions')? 'active': '' ?>" data-toggle="tab" href="#_form_actions">
                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                        <span class="nav-text">Module Access</span>
                    </a>
                </li>
            </ul>
        </div> 
    </div>
    <div class="card-body" id="card-body">
        <div class="tab-content">
            <div class="tab-pane fade <?= ($tab == 'main')? 'show active': '' ?>" id="_main_form" role="tabpanel" aria-labelledby="_main_form">
                <div class="row">
                    <div class="col-md-5">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <?= ActiveForm::recordStatus([
                            'model' => $model,
                            'form' => $form,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?= ($tab == 'role-access')? 'show active': '' ?>" id="_form_role_access" role="tabpanel" aria-labelledby="_form_role_access">
                <?= $this->render('_form_role_access', [
                    'model' => $model
                ]) ?>
            </div> 
            <div class="tab-pane fade <?= ($tab == 'navigation')? 'show active': '' ?>" id="_form_navigation" role="tabpanel" aria-labelledby="_form_navigation">
                <?= $this->render('_form_navigation', [
                    'controller_actions' => $controller_actions,
                    'model' => $model
                ]) ?>
            </div> 
            <div class="tab-pane fade <?= ($tab == 'actions')? 'show active': '' ?>" id="_form_actions" role="tabpanel" aria-labelledby="_form_actions">
                <?= $this->render('_form_actions', [
                    'controller_actions' => $controller_actions,
                    'model' => $model
                ]) ?>
            </div> 
        </div>
    </div>
    <div class="form-group">
        <?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>