<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\form\setting\SystemSettingForm;


$this->title = 'Organizational Chart';
$this->params['breadcrumbs'][] = $this->title;

$this->addCssFile('orgchart/custom');

$this->addJsFile('orgchart/orgchart');
$this->addJsFile('orgchart/custom');

$this->registerJs(<<< JS
	initOrgChart({
		xml: '{$model->organizational_chart}',
		template: '{$model->organizational_chart_template}',
		subscribe: '{$model->organizational_chart_subscribe}',
	});
JS);

$this->params['headerButtons'] = Html::tag('div', implode(' ', [
	Html::tag('label', 'Select Template: ', ['style' => 'white-space: nowrap;', 'class' => 'font-weight-bolder mr-2']),
	Html::tag('select', App::foreach(SystemSettingForm::ORG_CHART_TEMPLATE, fn ($t) => Html::tag('option', $t, ['selected' => $model->organizational_chart_template == $t])), [
		'id' => 'select-template',
		'class' => 'form-control kt-selectpicker'
	])
]), ['class' => 'd-flex align-items-baseline'])
?>
<div id="tree"></div>