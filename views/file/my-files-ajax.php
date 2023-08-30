<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\FileTagFilter;
use app\widgets\ListView;

$tagFilterBtn = FileTagFilter::widget(['activeTag' => App::get('tag')]);

$layout = Html::ifElse(
    $dataProvider->totalCount > 12, 
    <<< HTML
        <div class='col-md-6'>
            <p>{summary}</p>
        </div>
        <div class='col-md-6'>
            {$tagFilterBtn}
        </div>
        <div class='col-md-2 text-center' style='border-right: 1px dashed #ccc;'>
            {pager}
        </div>
        <div class='col-md-10'>
            <div class='row'>
                {items}
            </div>
        </div>
    HTML,
    <<< HTML
        <div class='col-md-6'>
            <p>{summary}</p>
        </div>
        <div class='col-md-6'>
            {$tagFilterBtn}
        </div>
        <div class='col-md-12'>
            <div class='row'>
                {items}
            </div>
        </div>
    HTML
);

?>
<div class="my-files-ajax-page">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => $layout,
        'itemView' => '_my-files',
        'options' => ['class' => 'row'],
        'emptyText' => <<< HTML
            <div class="row">
                <div class='col-md-6'>
                    <p class="mt-2">No Result Found.</p>
                </div>
                <div class='col-md-6'>
                    {$tagFilterBtn}
                </div>
            </div>
        HTML,
        'beforeItem' => function ($model, $key, $index, $widget) use ($dataProvider) {
            return "<div class='col-md-3'>";
        },
        'afterItem' => function ($model, $key, $index, $widget) {
            return '</div>';
        },
        'pager' => ['class' => 'app\widgets\LinkPager'],
        'emptyTextOptions' => ['class' => 'col-md-12']
    ]); ?>
</div>
