<?php

use app\helpers\App;
?>

<?= App::foreach($model->vehicles, 
    function ($vehicle, $v_index, $v_counter) {
        return App::if($vehicle->passengerModels, function($passengers) use ($v_index, $v_counter) {
            return App::foreach($passengers, function ($passenger, $index, $counter) use($v_index, $v_counter) {
                return $this->render('_passenger', [
                    'passenger' => $passenger,
                    'index' => $index,
                    'counter' => $counter,
                    'v_index' => $v_index,
                    'v_counter' => $v_counter,
                ]);
            });
        });
    }
) ?>