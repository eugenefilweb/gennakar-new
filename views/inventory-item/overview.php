<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\AppIcon;
use app\widgets\DateRange;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DirectorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventory';
$this->params['breadcrumbs'][] = $this->title;
$this->params['wrapCard'] = false;
$this->params['searchModel'] = $searchModel;
$this->params['headerButtons'] = Html::tag('div', implode(' ', [
	Html::tag('p', 'Date:', ['class' => 'font-weight-bolder mr-2']),
	DateRange::widget([
		'model' => $searchModel,
		'withLabel' => false,
		'onchange' => <<< JS
			const startDate = start.format('YYYY-MM-DD');
			const endDate = end.format('YYYY-MM-DD');

			const url = new URL(location.href);
			url.searchParams.set('date_range', [startDate, endDate].join(' - '));
			window.location.href = url.href;
		JS
	]),
	($inventories ? Html::popupCenter('Print Report', Url::toRoute(['print-report', 'date_range' => $searchModel->date_range]), ['class' => 'btn btn-light-primary font-weight-bolder ml-2']): ''),
	Html::a('Add New Item', ['create'], ['class' => 'btn btn-success font-weight-bolder ml-2'])
]), ['class' => 'd-flex align-items-end']);

$this->params['activeMenuLink'] = '/inventory-item/overview';
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
    .subheader {background: #fff;}
CSS);
$this->registerjs(<<< JS
    $('.inventory-item-card').click(function() {
        let url = $(this).data('url');
        window.location.href = url;
    });
JS);
?>
<div class="inventory-item-index-page">

	<?= App::if(!$inventories, Html::tag('div', AppIcon::widget(['icon' => 'no-data-found']), [
		'class' => 'm-auto',
		'style' => 'max-width: 50rem'
	])) ?>
	<div class="row">
		<?= App::foreach($inventories, function ($inventory, $index) use ($classList, $searchModel) {
			$key = $index % 6;
			$class = $classList[$key] ?? 'success';
			$create_link = Url::toRoute(['inventory-item/create', 'category' => $inventory['category']]);
			$list_link = Url::toRoute(['inventory-item/index', 'category' => $inventory['category'], 'date_range' => $searchModel->date_range]);
			$last_updated = App::formatter()->asAgo($inventory['updated_at']);
			$total = number_format($inventory['total']);
			$create_link = Html::a('<i class="fa fa-plus-circle"></i> ADD ITEM', $create_link, [
				'class' => "btn font-weight-bolder text-uppercase btn-outline-{$class} btn-lg float-right"
			]);
			return <<< HTML
				<div class="col-md-4 mt-5">
					<div data-toggle="tooltip" title="VIEW {$inventory['category']}" class="card card-custom card-stretch bg-diagonal bg-diagonal-light-{$class} app-border inventory-item-card" data-url="{$list_link}">
						<div class="card-body">
							<a href="{$list_link}" class="h4 text-dark text-hover-{$class}">
								{$inventory['category']}
							</a>
							<div class="d-flex my-5 justify-content-between align-items-center">
								<div class="">
									<div class="text-dark-50 mt-3" style="font-size: 14px;">
										<div>
											<p class="lead font-weight-bold display-3 text-{$class}"> {$total} </p>
										</div>
									</div>
								</div>
								<div class=""> {$create_link} </div>
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