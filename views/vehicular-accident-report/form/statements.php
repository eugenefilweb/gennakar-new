<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DatePicker;
use app\widgets\ESignature;

$statement = $model->newStatement;
?>

<div class="statements-container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                <?= $tabData['title'] ?>
            </h4>
        </div>
        <div>
            <?= Html::button('<i class="fa fa-plus-circle"></i> Add Statement', [
                'class' => 'btn btn-primary font-weight-bold btn-add-statement',
            ]) ?>
        </div>
    </div>

    <div class="my-10"></div>
    <?php $form = ActiveForm::begin() ?>
        <table class="table table-bordered" id="tbl-statements">
            <thead>
                <tr>
                    <th>#</th>
                    <th>type</th>
                    <th>name</th>
                    <th>date</th>
                    <th width="200">action</th>
                </tr>
            </thead>
            <tbody>
                <?= App::foreach($model->statements, fn ($statement, $key, $counter) => <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>{$statement->typeLabel}</td>
                        <td>{$statement->name}</td>
                        <td>{$statement->date}</td>
                        <td>
                            <a data-id="{$statement->id}" href="#" class="btn btn-icon btn-sm btn-primary btn-update-statement">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{$statement->deleteUrl}?redirect=referrer" data-confirm="Are you sure?" data-method="post" class="btn btn-icon btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                HTML) ?>
            </tbody>
        </table>
        <div class="form-group mt-10">
            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

            <?= Html::a('Previous', Url::current(['tab' => 'passengers']), [
                'class' => 'btn btn-light-primary font-weight-bold btn-lg'
            ]) ?>
            <?= Html::submitButton('Next', [
                'class' => 'btn btn-success btn-lg font-weight-bold'
            ]) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>

<?php $formStatement = ActiveForm::begin([
    'id' => 'statement-form', 
    'options' => [
        'style' => 'display: none;',
        'create-url' => Url::toRoute(['statement/create', 'redirect' => 'referrer']),
    ],
    'action' => ['statement/create', 'redirect' => 'referrer']
]); ?>
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4 class="mb-0 font-weight-bold text-dark">
                Add Statement
            </h4>
        </div>
        <div>
            <button type="button" class="btn btn-light-primary font-weight-bolder btn-cancel-add-statement">Cancel</button>
        </div>
    </div>
    <div class="my-5"></div>

    <div class="row">
        <div class="col-md-4">
            <?= DatePicker::widget([
                'form' => $formStatement,
                'model' => $statement,
                'attribute' => 'date'
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= BootstrapSelect::widget([
                'prompt' => false,
                'form' => $formStatement,
                'model' => $statement,
                'attribute' => 'type',
                'data' => App::params('var')['statement_types']
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $formStatement->field($statement, 'name')->textInput([
                'maxlength' => true
            ])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $formStatement->field($statement, 'position')->textInput([
                'maxlength' => true
            ])?>
        </div>
        <div class="col-md-4">
            <?= $formStatement->field($statement, 'address')->textInput([
                'maxlength' => true
            ])?>
        </div>
        <div class="col-md-4">
            <?= $formStatement->field($statement, 'contact_info')->textInput([
                'maxlength' => true
            ])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $formStatement->field($statement, 'statement')->textarea([
                'rows' => 8
            ])?>
        </div>
    </div>


    <div class="dropdown-divider"></div>
    <p class="mt-5 lead text-muted text-uppercase font-weight-bold">SIGNATURE</p>
    <div class="row">
        <div class="col-lg-6 text-center">
            <?= ESignature::widget([
                'width' => 400,
                'height' => 240,
                'uploadSuccess' => <<< JS
                    $('.signature').attr('src', toDataURL);
                JS,
                'model' => $statement,
                'form' => $formStatement,
                'attribute' => 'signature',
                // 'clearJs' => <<< JS
                //     $('.signature').attr('src', '{$statement->signature}');
                // JS,
            ]) ?>
        </div>
        <div class="col-lg-6 text-center">
            <?= Html::img($statement->signature ?: Url::image(App::setting('image')->image_holder, ['w' => 200]), [
                'class' => 'img-fluid symbol signature img-thumbnail',
                'style' => 'max-width:100%;max-height:auto'
            ]) ?>
        </div>
    </div>

    <?= $formStatement->field($statement, 'vehicular_accident_report_id')
        ->hiddenInput()
        ->label(false) ?>
    <div class="form-group mt-10">
        <button type="submit" class="btn btn-success font-weight-bold"> Save </button>
        <button type="button" class="btn btn-light-primary font-weight-bold btn-cancel-add-statement">Cancel</button>
    </div>
<?php ActiveForm::end() ?>
