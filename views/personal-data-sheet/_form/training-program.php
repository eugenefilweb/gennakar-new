<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;

$this->registerJs(<<< JS
    $('#datatable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']]
    });
JS);
?>

<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="mb-10 font-weight-bold text-dark"> <?= $current_step['title'] ?> </h4>
    </div>
    <div>
        <?= Html::a('Add Training Program', Url::current(['template' => 'training-program/create']), [
            'class' => 'btn btn-primary font-weight-bold',
        ]) ?>
    </div>
</div>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
	<table class="table table-bordered table-head-solid" id="datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>title</th>
                <th>date</th>
                <th>hours</th>
                <th>conducted</th>
                <th width="100" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="files-container">
            <?= App::foreach($model->trainingPrograms, function ($trainingProgram, $index, $counter)  {
                $buttons = implode(' ', [
                    Html::a(
                        '<i class="fa fa-eye"></i>', 
                        Url::current(['template' => 'training-program/view', 'model_id' => $trainingProgram->id]),
                        ['class' => 'btn btn-icon btn-light-primary']
                    ),
                    Html::a(
                        '<i class="fa fa-edit"></i>', 
                        Url::current(['template' => 'training-program/update', 'model_id' => $trainingProgram->id]),
                        ['class' => 'btn btn-icon btn-light-warning']
                    ),
                    Html::a(
                        '<i class="fa fa-trash"></i>', 
                        Url::toRoute(['pds-training-program/delete', 'id' => $trainingProgram->id, 'redirect' => Url::current()]),
                        ['class' => 'btn btn-icon btn-light-danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']
                    )
                ]);

                return <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>
                            <div>{$trainingProgram->title}</div>
                            <div>Type: {$trainingProgram->theValue('type')}</div>
                        </td>
                        <td>
                            <div>From: {$trainingProgram->theValue('from')}</div>
                            <div>To: {$trainingProgram->theValue('to')}</div>
                        </td>
                        <td>{$trainingProgram->theValue('no_of_hours')}</td>
                        <td>{$trainingProgram->theValue('conducted')}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                {$buttons}
                            </div>
                        </td>
                    </tr>
                HTML;
            }) ?>
        </tbody>
    </table>

    <div class="form-group mt-5">
		<?= Html::a('Back', Url::current(['step' => 'organization']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>

        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>
