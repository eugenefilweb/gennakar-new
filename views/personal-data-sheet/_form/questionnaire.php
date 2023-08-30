<?php

use app\helpers\Html;
use app\helpers\Url;
use app\models\PersonalDataSheet;
use app\widgets\ActiveForm;

$questionnaire = PersonalDataSheet::QUESTIONNAIRE;
?>
<h4 class="mb-10 font-weight-bold text-dark">
    <?= $current_step['title'] ?>
</h4>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

	<section>
		<h6><?= $model->getAttributeLabel('consanguinity_related') ?></h6>
		<?= Html::tag('p', $questionnaire['consanguinity_related'][0]) ?>
		
		<?= Html::tag('p', $questionnaire['consanguinity_related'][1]) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[consanguinity_related][answer][a]',
			'value' => $model->consanguinity_related['answer']['a'] ?? 'no'
		]) ?>
		<?= Html::tag('p', $questionnaire['consanguinity_related'][2]) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[consanguinity_related][answer][b]',
			'value' => $model->consanguinity_related['answer']['b'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[consanguinity_related][yes_details]',
				$model->consanguinity_related['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('administrative_offense') ?></h6>
		<?= Html::tag('p', $questionnaire['administrative_offense']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[administrative_offense][answer]',
			'value' => $model->administrative_offense['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[administrative_offense][yes_details]',
				$model->administrative_offense['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('charged_criminally') ?></h6>
		<?= Html::tag('p', $questionnaire['charged_criminally']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[charged_criminally][answer]',
			'value' => $model->charged_criminally['answer'] ?? 'no'
		]) ?>
		<label>If Yes, give details:</label>

		<div class="row">
			<div class="col-md-6">
				<label>Date Filed:</label>
				<?= Html::input(
					'date',
					'PersonalDataSheet[charged_criminally][date_filed]',
					$model->charged_criminally['date_filed'] ?? '', 
					['class' => 'form-control']
				) ?>
			</div>
			<div class="col-md-6">
				<label>Status of Case/s:</label>
				<?= Html::input(
					'text',
					'PersonalDataSheet[charged_criminally][status]',
					$model->charged_criminally['status'] ?? '', 
					['class' => 'form-control']
				) ?>
			</div>
		</div>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('crime_convicted') ?></h6>
		<?= Html::tag('p', $questionnaire['crime_convicted']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[crime_convicted][answer]',
			'value' => $model->crime_convicted['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[crime_convicted][yes_details]',
				$model->crime_convicted['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('service_separated') ?></h6>
		<?= Html::tag('p', $questionnaire['service_separated']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[service_separated][answer]',
			'value' => $model->service_separated['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[service_separated][yes_details]',
				$model->service_separated['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('election_candidate') ?></h6>
		<?= Html::tag('p', $questionnaire['election_candidate']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[election_candidate][answer]',
			'value' => $model->election_candidate['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[election_candidate][yes_details]',
				$model->election_candidate['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('government_resigned') ?></h6>
		<?= Html::tag('p', $questionnaire['government_resigned']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[government_resigned][answer]',
			'value' => $model->government_resigned['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details:</label>
			<?= Html::textarea(
				'PersonalDataSheet[government_resigned][yes_details]',
				$model->government_resigned['yes_details'] ?? '', 
				[
					'rows' => 4,
					'class' => 'form-control'
				]
			) ?>
		</p>
	</section>

	<section class="mt-10">
		<h6><?= $model->getAttributeLabel('other_country_resident') ?></h6>
		<?= Html::tag('p', $questionnaire['other_country_resident']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[other_country_resident][answer]',
			'value' => $model->other_country_resident['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, give details (country):</label>
			<?= Html::input(
				'text', 
				'PersonalDataSheet[other_country_resident][yes_details]',
				$model->other_country_resident['yes_details'] ?? '', 
				['class' => 'form-control']
			) ?>
		</p>
	</section>


	<section class="mt-10">
		<h6>Other Information</h6>
		<?= Html::tag('p', $questionnaire['other_information']) ?>
		<?= Html::tag('p', $questionnaire['indigenous_group']) ?>
		
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[indigenous_group][answer]',
			'value' => $model->indigenous_group['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, please specify:</label>
			<?= Html::input(
				'text', 
				'PersonalDataSheet[indigenous_group][name]',
				$model->indigenous_group['name'] ?? '', 
				['class' => 'form-control']
			) ?>
		</p>
		<?= Html::tag('p', $questionnaire['pwd']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[pwd][answer]',
			'value' => $model->pwd['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, please specify ID No:</label>
			<?= Html::input(
				'text', 
				'PersonalDataSheet[pwd][id_no]',
				$model->pwd['id_no'] ?? '', 
				['class' => 'form-control']
			) ?>
		</p>
		<?= Html::tag('p', $questionnaire['solo_parent']) ?>
		<?= $this->render('_questionnaire-yes-no', [
			'name' => 'PersonalDataSheet[solo_parent][answer]',
			'value' => $model->solo_parent['answer'] ?? 'no'
		]) ?>
		<p>
			<label>If Yes, please specify ID No:</label>
			<?= Html::input(
				'text', 
				'PersonalDataSheet[solo_parent][id_no]',
				$model->solo_parent['id_no'] ?? '', 
				['class' => 'form-control']
			) ?>
		</p>
	</section>

    <div class="form-group mt-5">
    	<?= Html::a('Back', Url::current(['step' => 'other']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>
        <?= Html::submitButton('Next', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>