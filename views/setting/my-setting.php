<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\search\ThemeSearch;
use app\widgets\ActiveForm;
use app\widgets\ThemeView;

/* @var $this yii\web\View */
/* @var $model app\models\Ip */

$this->title = "My Settings";
$this->params['breadcrumbs'][] = 'My Settings';
$this->params['searchModel'] = new ThemeSearch();
?>
<div class="setting-my-setting-page">
	<?php $form = ActiveForm::begin(['id' => 'setting-my-setting-form']); ?>
		<div class="row">
			<div class="col-md-6">
				<h3 class="mb-5">SYSTEM NOTIFICATIONS</h3>
				<table>
					<tbody>
						<?= App::foreach($model->systemNotificationSettings, fn ($attr) => $this->render('_switcher', [
							'model' => $model,
							'attribute' => $attr
						])) ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<h3 class="mb-5">EMAIL NOTIFICATIONS</h3>
				<table>
					<tbody>
						<?= App::foreach($model->emailNotificationSettings, fn ($attr) => $this->render('_switcher', [
							'model' => $model,
							'attribute' => $attr
						])) ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="form-group mt-10">
			<?= ActiveForm::buttons() ?>
		</div>
	<?php ActiveForm::end(); ?>
	<div class="row">
		<?php # Html::foreach($themes, function($theme) {
			#return '<div class="col-md-3">
            	#'. ThemeView::widget(['theme' => $theme]) .'
            #</div>';
		#}) ?>
	</div>
</div>