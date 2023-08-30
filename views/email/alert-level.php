<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\User;
use app\widgets\ActiveForm;
use app\widgets\FilterColumn;
use app\widgets\Grid;
use yii\grid\GridView;

$this->title = 'Alert Level: Emails';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/email/alert-level';
$this->params['wrapCard'] = false;

$this->registerJs(<<< JS
    $('.btn-view-email').click(function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        KTApp.blockPage({
            overlayColor: '#000000',
            message: 'Loading...',
            state: 'primary'
        });

        $.ajax({
            url: href,
            method: 'get',
            dataType: 'json',
            success: (s) => {
                $('#modal-email-view .modal-body').html(s.detailView);
                $('#modal-email-view').modal('show');
                KTApp.unblockPage();
            },
            error: (e) => {
                console.log('e', e);
                KTApp.unblockPage();
            }
        });
    });
JS);
?>

<div class="email-index-page">
    <div class="row">
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Send Email',
                'stretch' => true
            ]) ?>
                <?php $form = ActiveForm::begin(['id' => 'email-form']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                            <?= $form->bootstrapSelect($model, 'to', 
                                User::dropdown('email', 'email', ['<>', 'id', App::identity('id')]), [
                                    'multiple' => true,
                                    'prompt' => false,
                                    'options' => [
                                        'class' => 'kt-selectpicker form-control',
                                        'tabindex' => 'null',
                                        'placeholder' => 'Choose recepients',
                                        'data-actions-box' => 'true'
                                    ]
                                ]
                            ) ?>

                            <?= $form->tinymce($model, 'content', [
                                'height' => '45vh'
                            ]) ?>
                        </div>
                    </div>

                    <?= Html::submitButton('Send', [
                        'class' => 'mt-5 btn btn-success font-weight-bolder btn-lg'
                    ]) ?>
                <?php ActiveForm::end(); ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Email History',
            ]) ?>
                <?= FilterColumn::widget([
                    'searchModelOnly' => true,
                    'searchModel' => $searchModel
                ]) ?>
                <div class="table-responsive">
                    <?= Grid::widget([
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'withActionColumn' => false,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'subject',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return implode('', [
                                        Html::tag('div', $model->subject),
                                        Html::tag('div', $model->createdAt),
                                    ]);
                                }
                            ],
                            'to',
                            [
                                'attribute' => 'id',
                                'format' => 'raw',
                                'label' => 'Action',
                                'value' => function($model) {
                                    return Html::a('View', ['email/view', 'id' => $model->id], [
                                        'class' => 'btn-view-email btn btn-light-primary font-weight-bolder btn-sm'
                                    ]);
                                }
                            ]
                        ],
                    ]); ?>
                </div>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-email-view" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Email Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>