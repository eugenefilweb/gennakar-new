<?php

use app\widgets\FilterColumn;
?>
<div class="text-right">
    <?= FilterColumn::widget([
        'searchModel' => $searchModel,
        'searchModelOnly' => true,
        'style' => 'text-align:right'
    ]) ?>
</div>
