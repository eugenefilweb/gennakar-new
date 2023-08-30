<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\HazardMap;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HazardMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hazard Maps';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['wrapCard'] = false; 
$this->params['headerButtons'] = HazardMap::createButton();

$this->params['activeMenuLink'] = '/hazard-map/card';
$this->registerCss(<<< CSS
    .app-border:hover {
        cursor: pointer;
        box-shadow: rgb(0 0 0 / 30%) 0px 1px 20px 0 !important;
    }
    .bg-diagonal-light-success:hover {outline: 3px solid #1BC5BD !important;}
    .bg-diagonal-light-primary:hover {outline: 3px solid #3699FF !important;}
    .bg-diagonal-light-info:hover {outline: 3px solid #3699FF !important;}
    .bg-diagonal-light-secondary:hover {outline: 3px solid #E4E6EF !important;}
    .bg-diagonal-light-danger:hover {outline: 3px solid #F64E60 !important;}
    .bg-diagonal-light-warning:hover {outline: 3px solid #FFA800 !important;}
CSS);
$this->registerjs(<<< JS
    $('.hazard-map-card').click(function() {
        let url = $(this).data('url');
        window.location.href = url;
    });
JS);
?>
<div class="hazard-map-index-page">
    <div class="row">
        <?= App::foreach($hazardMaps, function($hazardMap, $index) {
            $create_link = Url::toRoute(['hazard-map/create', 'type' => $hazardMap['type']]);
            $list_link = HazardMap::getRoute($hazardMap['type']);
            $last_updated = App::formatter()->asAgo($hazardMap['updated_at']);
            $total = number_format($hazardMap['total']);
            $class = HazardMap::getTypeParam($hazardMap['type'], 'class');
            $type = HazardMap::getTypeParam($hazardMap['type'], 'label');
            $create_btn = Html::a('<i class="fa fa-plus-circle"></i> ADD RECORD', $create_link, [
                'class' => "btn font-weight-bolder text-uppercase btn-outline-{$class} btn-lg float-right"
            ]);
            return <<< HTML
                <div class="col-md-4 mb-10">
                    <div data-toggle="tooltip" title="View {$type} Maps" class="card card-custom card-stretch bg-diagonal bg-diagonal-light-{$class} app-border hazard-map-card" data-url="{$list_link}">
                        <div class="card-body">
                            <a href="{$list_link}" class="h4 text-dark text-hover-{$class}">
                                {$type}
                            </a>
                            <div class="d-flex my-5 justify-content-between align-items-center">
                                <div class="">
                                    <div class="text-dark-50 mt-3" style="font-size: 14px;">
                                        <div>
                                            <p class="lead font-weight-bold display-3 text-{$class}">
                                                {$total}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    {$create_btn}
                                </div>
                            </div>

                            <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
                                <em>Last Updated: {$last_updated}</em>
                            </div>
                        </div>
                    </div>
                </div>
            HTML;
        }) ?>
    </div>
</div>