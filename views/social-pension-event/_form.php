<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Household */
/* @var $form app\widgets\ActiveForm */
$this->registerCss(<<< CSS
    .wizard-step[data-wizard-state="current"] .wizard-icon {background-color: #3699FF !important;}
    .wizard-step[data-wizard-state="current"] .wizard-check {display: none !important;}
    .wizard-step[data-wizard-state="current"] .wizard-number {display: block !important;}
    .wizard-step[data-wizard-state="completed"] .wizard-icon {background-color: #1BC5BD !important;}
    .wizard-step[data-wizard-state="completed"] .wizard-check {display: block !important;}
    .wizard-step[data-wizard-state="completed"] .wizard-number {display: none !important;}
    .wizard-step[data-wizard-state="completed"] .svg-icon svg g [fill] {fill: #fff;}
CSS);

$tabData = $model::STEP_FORM[ArrayHelper::map($model::STEP_FORM, 'slug', 'id')[$tab]]

?>
<div class="wizard wizard-2 row" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
    
    <div class="col-md-3">
        <div data-sticky="true" data-margin-top="100">
            <div class="wizard-nav flex-lg-shrink-0 w-lg-300px w-xl-375px px-8 py-12 px-lg-10">
                <?= Html::foreach($model->stepForm, function($step, $key) use($tabData) {
                    $class = ($tabData['id'] == $key)? 'current': (($tabData['id'] > $key)? 'completed': 'pending');
                    $url = App::get('token')? 
                        Url::to([App::actionID(), 'token' => App::get('token'), 'tab' => $step['slug']]): 
                        Url::to([App::actionID(), 'tab' => $step['slug']]);
                    return <<< HTML
                        <div class="wizard-steps">
                            <a href="{$url}">
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="{$class}">
                                    <div class="wizard-icon">
                                        <span class="wizard-number">{$step['id']}</span>
                                        <span class="wizard-check">
                                            <span class="svg-icon svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002)"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">{$step['title']}</h3>
                                        <div class="wizard-desc">{$step['description']}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    HTML;
                }) ?>
                
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="wizard-body py-12 px-8">
            <div class="row">
                <div class="col">
                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                        <?= $this->render('form/' . $tab, [
                            'model' => $model,
                            'tabData' => $tabData,
                            'tab' => $tab,
                        ]) ?>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
