<?php

use app\helpers\Html;
use app\models\search\PersonalDataSheetSearch;
use app\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */

$this->title = 'Personal Data Sheet | Password';
$this->params['breadcrumbs'][] = ['label' => 'Personal Data Sheets', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PersonalDataSheetSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
?>

<div class="row">
	<div class="col-md-6">
		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'Personal Data Sheet Security'
		]) ?>
			<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($formModel, 'password')->passwordInput([
					'class' => 'form-control form-control-lg',
					'placeholder' => 'Enter your Password'
				]) ?>

				<?= $form->field($formModel, 'expiration')->radioList(
					[
						60 => '1 Minute',
						5 * 60 => '5 Minutes',
						10 * 60 => '10 Minutes',
						30 * 60 => '30 Minutes',
						60 * 60 => '1 Hour',
					], [
						'class' => 'radio-list',
						'item' => function($index, $label, $name, $checked, $value) {
							$input = Html::input('radio', $name, $value, ['checked' => $checked]);
							return <<< HTML
								<label class="radio">
									{$input}
									<span></span>{$label}
								</label>
							HTML;
                        }
					]
				) ?>

			    <div class="form-group">
			    	<?= Html::submitButton('Confirm Password', [
			    		'class' => 'btn btn-success font-weight-bold'
			    	]) ?>
			    </div>
			<?php ActiveForm::end(); ?>
		<?php $this->endContent() ?>
	</div>
</div>