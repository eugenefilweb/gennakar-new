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
        <?= Html::a('Add Education', Url::current(['template' => 'educational-background/create']), [
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
                <th>school</th>
                <th>period of attendance</th>
                <th>graduate</th>
                <th width="100" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="files-container">
            <?= App::foreach($model->educations, function ($education, $index, $counter)  {
                $buttons = implode(' ', [
                    Html::a(
                        '<i class="fa fa-eye"></i>', 
                        Url::current(['template' => 'educational-background/view', 'model_id' => $education->id]),
                        ['class' => 'btn btn-icon btn-light-primary']
                    ),
                    Html::a(
                        '<i class="fa fa-edit"></i>', 
                        Url::current(['template' => 'educational-background/update', 'model_id' => $education->id]),
                        ['class' => 'btn btn-icon btn-light-warning']
                    ),
                    Html::a(
                        '<i class="fa fa-trash"></i>', 
                        Url::toRoute(['pds-education/delete', 'id' => $education->id, 'redirect' => Url::current()]),
                        ['class' => 'btn btn-icon btn-light-danger', 'data-confirm' => 'Are you sure?', 'data-method' => 'post']
                    )
                ]);

                return <<< HTML
                    <tr>
                        <td>{$counter}</td>
                        <td>
                            <div>{$education->theValue('name')}</div>
                            <div>Level: {$education->theValue('level')}</div>
                            <div>Course: {$education->theValue('course')}</div>
                        </td>
                        <td>
                            <div>From: {$education->theValue('from')}</div>
                            <div>To: {$education->theValue('to')}</div>
                        </td>
                        <td>
                            <div>Year: {$education->theValue('year_graduated')}</div>
                            <div>Units: {$education->theValue('highest_level')}</div>
                            <div>Honor: {$education->theValue('academic_honor')}</div>
                        </td>
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
		<?= Html::a('Back', Url::current(['step' => 'family-background']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>


        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>
