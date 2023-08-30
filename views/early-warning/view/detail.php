<?php

use app\widgets\Detail;
?>
<h4 class="mb-10 font-weight-bold text-dark">
    General Information
</h4>
<?= Detail::widget(['model' => $model]) ?>