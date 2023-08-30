<?php

use app\helpers\App;
?>

<?= App::foreach($model->vehicles, fn ($vehicle, $index, $counter) => $this->render('_attachments-driver-license', [
    'vehicle' => $vehicle,
    'index' => $index,
    'counter' => $counter,
])) ?>