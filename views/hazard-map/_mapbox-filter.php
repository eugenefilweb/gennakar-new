<?php

use app\helpers\App;
use app\helpers\Html;
?>
<div class="form-group">
    <div class="d-flex justify-content-between">
        <label class="lead font-weight-bold text-uppercase">
            <?= $label ?>
        </label>
    </div>
    <table width="100%">
        <tbody>
            <?= App::foreach($data, fn ($layer) => $this->render('_mapbox-filter-row', ['layer' => $layer])) ?>
        </tbody>
    </table>
</div>