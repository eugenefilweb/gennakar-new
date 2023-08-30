<?php

use app\helpers\App;

?>
<?= App::foreach($dataProvider->models, fn ($model) => $this->render('print-report', ['model' => $model]) . '<div class="mt-10"></div>') ?>