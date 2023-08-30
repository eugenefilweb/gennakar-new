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
        <?= Html::a('Add Voluntary Work', Url::current(['template' => 'organization/create']), [
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
                <th>name</th>
                <th>date</th>
                <th>no of hours</th>
                <th>position</th>
                <th width="100" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="files-container">
            <?= App::foreach($model->voluntaryWorks, function ($organization, $index, $counter)  {
                $buttons = implode(' ', [
                    Html::a(
                        '<i class="fa fa-eye"></i>', 
                        Url::current(['template' => 'organization/view', 'model_id' => $organization->id]),
                        ['class' => 'btn btn-icon btn-light-primary']
                    ),
                    Html::a(
                        '<i class="fa fa-edit"></i>', 
                        Url::current(['template' => 'organization/update', 'model_id' => $organization->id]),
                        ['class' => 'btn btn-icon btn-light-warning']
                    ),
                    Html::a(
                        '<i class="fa fa-trash"></i>', 
                        Url::toRoute(['pds-organization/delete', 'id' => $organization->id, 'redirect' => Url::current()]),
                        ['class' => 'btn btn-icon btn-light-danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']
                    )
                ]);

                return <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>
                            <div>{$organization->name}</div>
                            <div>Address: {$organization->address}</div>
                        </td>
                        <td>
                            <div>From: {$organization->theValue('from')}</div>
                            <div>To: {$organization->theValue('to')}</div>
                        </td>
                        <td>{$organization->theValue('no_of_hours')}</td>
                        <td>{$organization->theValue('position')}</td>
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
		<?= Html::a('Back', Url::current(['step' => 'work-experience']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>

        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>
