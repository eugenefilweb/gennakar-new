<?php

use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
?>

<h4 class="mb-10 font-weight-bold text-dark">
    <?= $current_step['title'] ?>
</h4>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'person_administering_oath')->textInput(['maxlength' => true]) ?>
			<section>
		        <h6 class="font-weight-bold"> Special Skills & Hobbies </h6>
		    	<?= $form->inputList('Skill or Hobby', 'PersonalDataSheet[skills][]', $model->skills) ?>
		    </section>

			<section class="mt-10">
		        <h6 class="font-weight-bold"> Recognitions </h6>
		    	<?= $form->inputList('Recognition', 'PersonalDataSheet[recognitions][]', $model->recognitions) ?>
		    </section>

		    <section class="mt-10">
		        <h6 class="font-weight-bold"> Organizations </h6>
		    	<?= $form->inputList('Organization', 'PersonalDataSheet[organizations][]', $model->organizations) ?>
		    </section>
    	</div>
	</div>
    <div class="form-group mt-5">
    	<?= Html::a('Back', Url::current(['step' => 'training-program']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>