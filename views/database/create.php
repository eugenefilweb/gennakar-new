<?php

use app\models\search\DatabaseSearch;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Database */

$this->title = 'Create Database Entry: ' . $model->prioritySectorLabel;
$this->params['breadcrumbs'][] = ['label' => 'Databases', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['breadcrumbs'][] = $model->prioritySectorLabel;
$this->params['searchModel'] = new DatabaseSearch();
$this->params['activeMenuLink'] = '/database';
$this->params['wrapCard'] = false;

$this->registerJs(<<< JS
	$("body").on('change','#database-priority_sector', function(evt) {
		var priority_sector = $(this).val();

		KTApp.block('#kt_content', {
			overlayColor: '#000000',
			type: 'v1',
			state: 'success',
			size: 'lg',
			message: 'Loading..'
		});

		$('body').find('#database-create-page-load')
			.load("{$model->createUrl}"+"?priority_sector="+priority_sector, function() {
				KTApp.unblock('#kt_content');
			}
		);
	});
JS, View::POS_END);
?>

<div id="database-create-page-load" class="database-create-page">
	<?= $this->render($form, [
		'model' => $model,
	]) ?>
</div>