<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\ActiveForm;
use app\widgets\FilterColumn;
use yii\helpers\Inflector;
 

$this->title = 'Logs | Chart';
$this->params['breadcrumbs'][] = $this->title;
$this->params['wrapCard'] = false;
$this->params['searchModel'] = $searchModel;

$this->registerJs(<<< JS
    const createChart = (id , data, categories) => {
        const apexChart = "#" + id;
        var options = {
            series: [{
                name: "Activities",
                data
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {enabled: false}
            },
            dataLabels: {enabled: false},
            stroke: {curve: 'straight'},
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], 
                    opacity: 0.5
                },
            },
            xaxis: {
                categories,
            },
            colors: ['#3699FF']
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    }
    
    createChart('chart_1', {$totals}, {$models});

    $('input[type="checkbox"]').on('change', function() {
        $(this).closest('form').submit();
    });
JS);
?>
<div class="log-index-page">
    <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Chart',
        'toolbar' => Html::tag('div', FilterColumn::widget([
            'searchModel' => $searchModel,
            'searchModelOnly' => true
        ]), ['class' => 'card-toolbar'])
    ]) ?>
        <?php $form = ActiveForm::begin([
            'action' => $searchModel->searchAction,
            'method' => 'get',
        ]); ?>
            <div class="form-group">
                <div class="checkbox-inline row">
                    <?= App::foreach($allModels, function ($value, $key) use($searchModel) {
                        $isChecked = in_array($value, $searchModel->model_name ?: []);
                        $isChecked = ! $searchModel->model_name ?: $isChecked;

                        $input = Html::input('checkbox', 'model_name[]', $value, ['checked' => $isChecked]);
                        $label = Inflector::camel2words($value);
                        return <<< HTML
                            <div class="col-md-2">
                                <label class="checkbox">
                                    {$input}
                                    <span></span>{$label}
                                </label>
                            </div>
                        HTML;
                    }) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>

        <div id="chart_1"></div>
    <?php $this->endContent() ?>
</div>