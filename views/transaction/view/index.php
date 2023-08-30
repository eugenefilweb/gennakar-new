<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\Anchors;
use app\widgets\AppIcon;
use app\widgets\Timeline;
use app\widgets\TransactionInstructions;
use app\widgets\Value;

$this->registerCss(<<< CSS
    .eligibility-notice {
        background: #fff;
        padding: 10px;
    }
    .eligibility-notice .mb-9 {
        margin-bottom: 0px !important;
    }
    .budget-notice {
        background: white;
        padding: 18px 10px;
        border-radius: 2px;
        border-left: 3px solid #3699ff;
    }
    .app-iconbox {
        box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px 0 !important;
    }

    .app-iconbox .card-body {
        padding: 0rem 0.25rem !important;
    }
CSS);

$this->registerJs(<<< JS
    $('.toggle-tooltip').tooltip();
JS);


$budget = App::setting('budget');

$this->params['headerButtons'] = implode(" ", [
    TransactionInstructions::widget(['transaction' => $model]),
    $model->actionButton,
    $model->statusAction,
    Anchors::widget([
        'names' => ['update', 'delete', 'log'], 
        'model' => $model
    ])
]);
?>

<div class="row">
    <div class="col-md-4">
        
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => "Transaction Process",
            'toolbar' => <<< HTML
                <div class="card-toolbar">
                    <div class="text-left">
                        {$model->statusBadge}
                        <br>{$model->secondaryLabel}
                    </div>
                </div>
            HTML
        ]); ?>
            <ul class="navi navi-hover navi-active">
                <?= Html::foreach($model->viewTabs, function($viewTab, $keyTab) use($tab) {
                    $class = $keyTab == $tab ? 'active': '';
                    $url = Url::current(['tab' => $keyTab]);

                    return <<< HTML
                        <li class="navi-item" data-key="{$keyTab}">
                            <a class="navi-link {$class}" href="{$url}">
                                <span class="symbol symbol-50 mr-3">
                                    <span class="symbol-label">
                                        {$viewTab['icon']}
                                    </span>
                                </span>
                                <div class="navi-text">
                                    <span class="d-block font-weight-bold">
                                        {$viewTab['label']}
                                    </span>
                                    <span class="text-muted">
                                        {$viewTab['description']}
                                    </span>
                                </div>
                                {$viewTab['status']}
                            </a>
                        </li>
                    HTML;
                }) ?>
            </ul>
        <?php $this->endContent(); ?>

    </div>
    <div class="col-md-8">
        <?= Html::if(App::identity()->can('index', 'budget') && !$model->isSeniorCitizenIdApplication, function() use($model, $budget) {
            $moneyIcon = AppIcon::widget(['icon' => 'money']);

            return <<< HTML
                <div class="row mb-5">
                    <div class="col">
                        <div class="wave wave-animate-slower app-iconbox card card-custom card-stretch">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6 icon-content">
                                        <div class="svg-icon svg-icon-success svg-icon-4x">
                                            {$moneyIcon}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark text-hover-success font-weight-bold font-size-h4 mb-3">Budget 
                                            <span class="text-success">
                                                ({$budget->getTotalAmount(true)})
                                            </span>
                                        </a>
                                        <div class="text-dark-75">
                                            Total budget reserved for assistance as of this year ({$budget->year}).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="wave wave-animate-slower app-iconbox card card-custom card-stretch">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6 icon-content">
                                        <div class="svg-icon svg-icon-primary svg-icon-4x">
                                            {$moneyIcon}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Usable 
                                            <span class="text-primary">
                                                ({$budget->getTotalUsable(true)})
                                            </span>
                                        </a>
                                        <div class="text-dark-75">
                                            Total budget usable expressed in pesos to date ({$budget->year}).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="wave wave-animate-slower app-iconbox card card-custom card-stretch">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-5">
                                    <div class="mr-6 icon-content">
                                        <div class="svg-icon svg-icon-warning svg-icon-4x">
                                            {$moneyIcon}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark text-hover-warning font-weight-bold font-size-h4 mb-3">Disbursed 
                                            <span class="text-warning">
                                                ({$budget->getTotalDisbursed(true)})
                                            </span>
                                        </a>
                                        <div class="text-dark-75">
                                            Total amount disbursed for AICS(or program/project) ({$budget->year}).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            HTML;
        }) ?>
        
        <div class="<?= !$model->isSeniorCitizenIdApplication ? '': '' ?>">
            <?= $content ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-transaction-logs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-transaction-logsLabel">Transaction Logs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= Timeline::widget(['model' => $model]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>