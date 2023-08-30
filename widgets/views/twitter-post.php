<?php

use app\helpers\Html;

$this->registerJsFile('https://platform.twitter.com/widgets.js', ['async' => true]);
?>


<?= Html::a($title, $link, $linkOptions) ?>