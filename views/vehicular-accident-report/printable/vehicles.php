<?php

use app\helpers\App;
?>

<?= App::foreach($model->vehicles, 
    fn ($vehicle, $index, $counter) => $this->render('_vehicle', [
        'vehicle' => $vehicle,
        'index' => $index,
        'counter' => $counter,
    ])
) ?>