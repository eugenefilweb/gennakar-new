<?php

use app\helpers\App;
?>

<p class="lead font-weight-bold"><?= $title ?></p>
<div class="accordion accordion-solid accordion-toggle-plus" id="accordion-parent">
    <?= App::foreach($data, function ($result) {
        $filter = $this->render('_mapbox-filter-row', [
            'layer' => $result,
            'align' => 'middle',
            'label' => 'Activate'
        ]);
        $show = $result['visible'] ? 'show': '';
        return <<< HTML
            <div class="card">
                <div class="card-header" id="headingOne3">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#boundaries-{$result['id']}">
                        {$result['label']}
                    </div>
                </div>
                <div id="boundaries-{$result['id']}" class="collapse {$show}">
                    <div class="card-body">
                        <table width="100%">
                            <tbody>
                                {$filter}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        HTML;
    }) ?>
</div>