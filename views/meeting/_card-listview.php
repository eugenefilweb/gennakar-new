<?php

use app\widgets\ListView;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'accordion accordion-toggle-arrow',
        'id' => 'minutes-accordion',
    ],
    'viewParams' => ['attribute' => $attribute],
    'layout' => <<< HTML
        <div class="d-flex justify-content-between align-items-center">
            <div>{summary}</div>
            <div>{pager}</div>
        </div>
        <div class="my-2">
            {items}
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div>{summary}</div>
            <div>{pager}</div>
        </div>
    HTML,
    'itemView' => '_card',
]); ?>