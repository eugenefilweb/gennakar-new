<?php

use app\widgets\Dropzone;
?>

<?= Dropzone::widget([
    'tag' => $tag,
    'model' => $model,
    'attribute' => 'token',
    'success' => <<< JS
        $(document).find('.file-total-' + s.file.tag).html(s.total_by_tag);
    JS
    // 'acceptedFiles' => 
]) ?>