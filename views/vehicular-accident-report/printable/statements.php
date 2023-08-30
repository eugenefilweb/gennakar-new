<?php

use app\helpers\App;

$responderStatements = $model->responderStatements;
$totalResponderStatements = $responderStatements ? count($responderStatements): 0;

$witnessStatements = $model->witnessStatements;
$totalWitnessStatements = $witnessStatements ? count($witnessStatements): 0;
?>

<?= App::foreach($model->vehiclesWithStatements, 
    fn ($vehicle, $index, $counter) => $this->render('_statement-driver', [
        'vehicle' => $vehicle,
        'index' => $index,
        'counter' => $counter,
    ])
) ?>

<?= App::foreach($model->passengersWithStatements, 
    fn ($passenger, $index, $counter) => $this->render('_statement-passenger', [
        'passenger' => $passenger,
        'index' => $index,
        'counter' => $counter,
    ])
) ?>

<?= App::foreach($responderStatements, 
    fn ($statement, $index, $counter) => $this->render('_statement-responder', [
        'statement' => $statement,
        'index' => $index,
        'counter' => $counter,
        'totalResponderStatements' => $totalResponderStatements,
        'totalWitnessStatements' => $totalWitnessStatements
    ])
) ?>

<?= App::foreach($witnessStatements, 
    fn ($statement, $index, $counter) => $this->render('_statement-witness', [
        'statement' => $statement,
        'index' => $index,
        'counter' => $counter,
        'totalWitnessStatements' => $totalWitnessStatements
    ])
) ?>