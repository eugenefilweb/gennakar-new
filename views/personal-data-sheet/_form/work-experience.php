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
        <?= Html::a('Add Work Experience', Url::current(['template' => 'work-experience/create']), [
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
                <th>company</th>
                <th>date</th>
                <th>salary</th>
                <th>status</th>
                <th width="100" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="files-container">
            <?= App::foreach($model->workExperiences, function ($workExperience, $index, $counter)  {
                $buttons = implode(' ', [
                    Html::a(
                        '<i class="fa fa-eye"></i>', 
                        Url::current(['template' => 'work-experience/view', 'model_id' => $workExperience->id]),
                        ['class' => 'btn btn-icon btn-light-primary']
                    ),
                    Html::a(
                        '<i class="fa fa-edit"></i>', 
                        Url::current(['template' => 'work-experience/update', 'model_id' => $workExperience->id]),
                        ['class' => 'btn btn-icon btn-light-warning']
                    ),
                    Html::a(
                        '<i class="fa fa-trash"></i>', 
                        Url::toRoute(['pds-work-experience/delete', 'id' => $workExperience->id, 'redirect' => Url::current()]),
                        ['class' => 'btn btn-icon btn-light-danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']
                    )
                ]);

                return <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>
                            <div>{$workExperience->company}</div>
                            <div>Position: {$workExperience->position}</div>
                            <div>Goverment: {$workExperience->governmentServiceLabel}</div>
                        </td>
                        <td>
                            <div>From: {$workExperience->theValue('from')}</div>
                            <div>To: {$workExperience->theValue('to')}</div>
                        </td>
                        <td>
                            <div>{$workExperience->theValue('salary')}</div>
                            <div>Pay Grade: {$workExperience->theValue('salary_increment')}</div>
                        </td>
                        <td> {$workExperience->theValue('appointment_status')} </td>
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
		<?= Html::a('Back', Url::current(['step' => 'civil-service']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>

        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>
