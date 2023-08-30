<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Directory;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Directories';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['wrapCard'] = false; 
$this->params['headerButtons'] = Html::tag('div', implode(' ', [
    Directory::viewButton(),
    Directory::createButton()
]), ['class' => 'd-flex']);

$this->params['activeMenuLink'] = '/directory/card';
$classList = ['success', 'warning', 'primary', 'danger', 'dark', 'secondary'];

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
    $('.directory-card').click(function() {
        let url = $(this).data('url');
        window.location.href = url;
    });
JS);
?>
<div class="directory-index-page">
    <div class="row">
        <?= App::foreach($directories, function($directory, $index) use($classList) {
            $key = $index % 6;
            $class = $classList[$key] ?? 'success';
            $create_link = Url::toRoute(['directory/create', 'type' => $directory['type']]);
            $list_link = Url::toRoute(['directory/index', 'type' => $directory['type']]);
            $last_updated = App::formatter()->asAgo($directory['updated_at']);
            $total = number_format($directory['total']);
            $create_link = Html::a('<i class="fa fa-plus-circle"></i> ADD RECORD', $create_link, [
                'class' => "btn font-weight-bolder text-uppercase btn-outline-{$class} btn-lg float-right"
            ]);

            return <<< HTML
                <div class="col-md-4 mb-10">
                    <div data-toggle="tooltip" title="VIEW {$directory['type']}" class="card card-custom card-stretch bg-diagonal bg-diagonal-light-{$class} app-border directory-card" data-url="{$list_link}">
                        <div class="card-body">
                            <a href="{$list_link}" class="h4 text-dark text-hover-{$class}">
                                {$directory['type']}
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
                                    {$create_link}
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